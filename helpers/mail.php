<?php
require_once __DIR__.'/lending.php';
require_once __DIR__.'/../vendor/phpmailer/src/Exception.php';
require_once __DIR__.'/../vendor/phpmailer/src/PHPMailer.php';
require_once __DIR__.'/../vendor/phpmailer/src/SMTP.php';

class UWTrackedSMTP extends \PHPMailer\PHPMailer\SMTP {
    public $dataAttempted=false;
    public function data($msg_data) { $this->dataAttempted=true; return parent::data($msg_data); }
}
function lender_mail_config() {
    $configuredFile = getenv('UW_MAIL_CONFIG');
    // Apply defaults first, then local/host config, and the explicitly
    // configured file last so UW_MAIL_CONFIG always has highest priority.
    $privateFiles = array_filter([
        __DIR__ . '/../config/mail.local.php',
        dirname(__DIR__, 2) . '/uw-mail.private.php',
        $configuredFile ?: null,
    ]);
    $config = [];

    // Merge available sources instead of stopping at the first file, allowing
    // partial configs to inherit defaults while preserving explicit priority.
    foreach ($privateFiles as $file) {
        if (is_file($file)) {
            $loaded = require $file;
            if (is_array($loaded)) {
                $config = array_replace($config, $loaded);
            }
        }
    }

    $defaults = [
        'host' => 'smtp.gmail.com',
        'port' => 587,
        'encryption' => 'tls',
        'username' => 'ayettacore@gmail.com',
        'password' => '',
        'from' => '',
        'from_name' => 'Utang Wise',
    ];

    $envPassword = getenv('UW_SMTP_PASSWORD');
    if ($envPassword !== false && $envPassword !== '') {
        $config['password'] = $envPassword;
    }

    $config = array_replace($defaults, $config);
    $config['username'] = trim((string)$config['username']);
    // Google displays App Passwords in groups. Ignore copied whitespace.
    $config['password'] = preg_replace('/\s+/', '', (string)$config['password']);
    $config['from'] = trim((string)($config['from'] ?: $config['username']));

    return $config;
}

function lender_mail_failure_reason(Throwable $error) {
    $message = strtolower($error->getMessage());

    if (strpos($message, 'authenticat') !== false || preg_match('/\b(534|535)\b/', $message)) {
        return 'Gmail rejected SMTP login. Use a newly generated App Password for the configured Gmail username; pasted spaces are removed automatically.';
    }

    if (strpos($message, 'connect') !== false || strpos($message, 'timed out') !== false || strpos($message, 'getaddrinfo') !== false) {
        return 'Could not connect to smtp.gmail.com:587. Check DNS and whether the host allows outbound SMTP on port 587.';
    }

    if (strpos($message, 'certificate') !== false || strpos($message, 'tls') !== false || strpos($message, 'ssl') !== false) {
        return 'The secure SMTP connection failed. Check the server clock and OpenSSL/TLS support.';
    }

    // Keep the actionable PHPMailer server response for other SMTP failures,
    // while avoiding any possibility of exposing credentials in the UI.
    $safeMessage = trim(strip_tags($error->getMessage()));
    $safeMessage = preg_replace('/\s+/', ' ', $safeMessage);
    if ($safeMessage !== '' && strlen($safeMessage) <= 240) {
        return 'SMTP error: ' . $safeMessage;
    }
    return 'SMTP rejected the email before delivery. Check the recipient address and Gmail sending limits.';
}

function send_lender_email($id,$lenderId,$allowUncertain=false) {
    global $conn;
    $conn->begin_transaction();
    $row=db('SELECT * FROM lender_outbox WHERE email_id=? AND lender_id=? FOR UPDATE',[$id,$lenderId])->get_result()->fetch_assoc();
    if(!$row){$conn->rollback();throw new DomainException('Email not found.');}
    if($row['status']==='sent'){$conn->commit();return 'sent';}
    if($row['status']==='sending') {
        if(strtotime($row['attempted_at'])>time()-300){$conn->commit();return 'sending';}
        db("UPDATE lender_outbox SET status='uncertain', last_error='Previous send was interrupted. Check the sender mailbox before retrying.' WHERE email_id=?",[$id]);
        $conn->commit(); return 'uncertain';
    }
    if($row['status']==='uncertain'&&!$allowUncertain){$conn->commit();return 'uncertain';}
    $config=lender_mail_config();
    $capture=getenv('UW_MAIL_TRANSPORT')==='capture';
    if(!$capture && empty($config['password'])) {
        db("UPDATE lender_outbox SET status='queued',last_error='Gmail App Password is not configured. No email sent.' WHERE email_id=?",[$id]);
        $conn->commit();return 'queued';
    }
    db("UPDATE lender_outbox SET status='sending',attempted_at=NOW(),attempts=attempts+1,last_error=NULL WHERE email_id=?",[$id]);$conn->commit();
    $smtp=new UWTrackedSMTP();$accepted=false;
    try {
        $mail=new \PHPMailer\PHPMailer\PHPMailer(true);$mail->CharSet='UTF-8';$mail->Timeout=20;$mail->setSMTPInstance($smtp);
        $mail->isSMTP();$mail->Host=$config['host'];$mail->Port=(int)$config['port'];$mail->SMTPAuth=true;$mail->Username=$config['username'];$mail->Password=$config['password'];$mail->SMTPSecure=$config['encryption'];
        $mail->setFrom($config['from'],$config['from_name']);$mail->addAddress($row['recipient']);$mail->MessageID=$row['message_id'];
        $mail->Subject=$row['subject'];$mail->Body=$row['body'];$mail->isHTML(false);
        if($row['agreement_id']) {
            $pdf=db('SELECT pdf_contents FROM loan_agreements WHERE agreement_id=? AND lender_id=?',[$row['agreement_id'],$lenderId])->get_result()->fetch_assoc();
            if(!$pdf)throw new RuntimeException('Agreement attachment unavailable.');
            $mail->addStringAttachment($pdf['pdf_contents'],'Utang-Wise-Agreement-'.$row['agreement_id'].'.pdf','base64','application/pdf');
        }
        if($capture) {
            $dir=getenv('UW_MAIL_CAPTURE_DIR');
            if(!$dir||!is_dir($dir))throw new RuntimeException('Test mail capture directory is unavailable.');
            $mail->preSend();if(file_put_contents($dir.'/email-'.$id.'.eml',$mail->getSentMIMEMessage())===false)throw new RuntimeException('Capture failed.');
        } else $mail->send();
        $accepted=true;
        db("UPDATE lender_outbox SET status='sent',sent_at=NOW(),last_error=NULL WHERE email_id=?",[$id]);return 'sent';
    } catch(Throwable $error) {
        $status=$accepted||$smtp->dataAttempted?'uncertain':'failed';
        // Do not persist SMTP debug output or credentials.
        $reason = $status === 'uncertain'
            ? 'Delivery is uncertain. Check the sender mailbox before retrying.'
            : lender_mail_failure_reason($error);
        db('UPDATE lender_outbox SET status=?,last_error=? WHERE email_id=?',[$status,$reason,$id]);
        return $status;
    }
}
