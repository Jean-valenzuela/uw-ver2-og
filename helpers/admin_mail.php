<?php
require_once __DIR__ . '/mail.php';
function send_admin_email($id, $adminId, $allowUncertain = false)
{
    global $conn;
    $conn->begin_transaction();
    $row = db('SELECT * FROM admin_outbox WHERE email_id=? FOR UPDATE', [$id])->get_result()->fetch_assoc();
    if (!$row) {
        $conn->rollback();
        throw new DomainException('Email not found.');
    }
    if ($row['status'] === 'sent') {
        $conn->commit();
        return 'sent';
    }
    if ($row['status'] === 'sending') {
        if (strtotime($row['attempted_at']) > time() - 300) {
            $conn->commit();
            return 'sending';
        }
        db("UPDATE admin_outbox SET status='uncertain', last_error='Previous send was interrupted. Check the sender mailbox before retrying.' WHERE email_id=?", [$id]);
        $conn->commit();
        return 'uncertain';
    }
    if ($row['status'] === 'uncertain' && !$allowUncertain) {
        $conn->commit();
        return 'uncertain';
    }
    $config = lender_mail_config();
    $capture = getenv('UW_MAIL_TRANSPORT') === 'capture';
    if (!$capture && empty($config['password'])) {
        db("UPDATE admin_outbox SET status='queued',last_error='Gmail App Password is not configured. No email sent.' WHERE email_id=?", [$id]);
        $conn->commit();
        return 'queued';
    }
    db("UPDATE admin_outbox SET status='sending',attempted_at=NOW(),attempts=attempts+1,last_error=NULL WHERE email_id=?", [$id]);
    $conn->commit();
    $smtp = new UWTrackedSMTP();
    $accepted = false;
    try {
        $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        $mail->Timeout = 20;
        $mail->setSMTPInstance($smtp);
        $mail->isSMTP();
        $mail->Host = $config['host'];
        $mail->Port = (int) $config['port'];
        $mail->SMTPAuth = true;
        $mail->Username = $config['username'];
        $mail->Password = $config['password'];
        $mail->SMTPSecure = $config['encryption'];
        $mail->setFrom($config['from'], $config['from_name']);
        $mail->addAddress($row['recipient']);
        $mail->MessageID = $row['message_id'];
        $mail->Subject = $row['subject'];
        $mail->Body = $row['body'];
        $mail->isHTML(false);
        if ($capture) {
            $dir = getenv('UW_MAIL_CAPTURE_DIR');
            if (!$dir || !is_dir($dir))
                throw new RuntimeException('Test mail capture directory is unavailable.');
            $mail->preSend();
            if (file_put_contents($dir . '/email-' . $id . '.eml', $mail->getSentMIMEMessage()) === false)
                throw new RuntimeException('Capture failed.');
        } else
            $mail->send();
        $accepted = true;
        db("UPDATE admin_outbox SET status='sent',sent_at=NOW(),last_error=NULL WHERE email_id=?", [$id]);
        return 'sent';
    } catch (Throwable $error) {
        $status = $accepted || $smtp->dataAttempted ? 'uncertain' : 'failed';
        // Do not persist SMTP debug output or credentials.
        db('UPDATE admin_outbox SET status=?,last_error=? WHERE email_id=?', [$status, $status === 'uncertain' ? 'Delivery is uncertain. Check the sender mailbox before retrying.' : 'Email could not be sent. Check Gmail configuration and connectivity, then retry.', $id]);
        return $status;
    }
}
