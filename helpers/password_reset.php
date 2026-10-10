<?php
require_once __DIR__.'/mail.php';
function reset_token($token,$lock=false){
 if(!is_string($token)||!preg_match('/^[a-f0-9]{64}$/D',$token))return null;
 return db('SELECT t.*,u.user_type_id FROM password_reset_tokens t JOIN users u ON u.user_id=t.user_id WHERE t.token_hash=? AND t.used_at IS NULL AND t.expires_at>NOW()'.($lock?' FOR UPDATE':''),[hash('sha256',$token)])->get_result()->fetch_assoc();
}
function reset_limit($key,$limit){
 db('INSERT IGNORE INTO password_reset_limits(rate_key,attempts,window_start) VALUES (?,0,NOW())',[$key]);
 $row=db('SELECT attempts,window_start>DATE_SUB(NOW(),INTERVAL 15 MINUTE) recent FROM password_reset_limits WHERE rate_key=? FOR UPDATE',[$key])->get_result()->fetch_assoc();
 if($row['recent']&&(int)$row['attempts']>=$limit)return false;
 db('UPDATE password_reset_limits SET attempts=IF(window_start<=DATE_SUB(NOW(),INTERVAL 15 MINUTE),1,attempts+1),window_start=IF(window_start<=DATE_SUB(NOW(),INTERVAL 15 MINUTE),NOW(),window_start) WHERE rate_key=?',[$key]);return true;
}
function reset_send($user,$token){
 $config=lender_mail_config();$capture=getenv('UW_MAIL_TRANSPORT')==='capture';
 $public=rtrim(getenv('UW_PUBLIC_URL')?:($config['public_url']??''),'/');
 if(!$public&&$capture)$public='http://localhost'.base_url();
 $parts=parse_url($public);$local=in_array($parts['host']??'',['localhost','127.0.0.1'],true);
 if(!$parts||!isset($parts['host'])||isset($parts['user'])||isset($parts['pass'])||isset($parts['query'])||isset($parts['fragment'])||(($parts['scheme']??'')!=='https'&&!($local&&($parts['scheme']??'')==='http'))||(!$capture&&empty($config['password']))){error_log('Utang Wise: reset email unavailable; configure public URL and SMTP.');return 'failed';}
 try{
  $mail=new \PHPMailer\PHPMailer\PHPMailer(true);$mail->CharSet='UTF-8';$mail->Timeout=20;$mail->isSMTP();$mail->Host=$config['host'];$mail->Port=(int)$config['port'];$mail->SMTPAuth=true;$mail->Username=$config['username'];$mail->Password=$config['password'];$mail->SMTPSecure=$config['encryption'];$mail->setFrom($config['from'],$config['from_name']);$mail->addAddress($user['email']);
  $mail->Subject='Reset your Utang Wise password';$mail->Body="Hello ".$user['user_fn'].",\n\nUse this link to choose a new password:\n".$public.'/reset-password.php?token='.$token."\n\nThis link expires in 30 minutes and can be used once. If you did not request it, you can ignore this email. Your account approval status is unchanged.\n\nUtang Wise";
  if($capture){$dir=getenv('UW_MAIL_CAPTURE_DIR');if(!$dir||!is_dir($dir))throw new RuntimeException('Capture directory unavailable');$mail->preSend();if(file_put_contents($dir.'/password-reset-'.hash('sha256',$token).'.eml',$mail->getSentMIMEMessage())===false)throw new RuntimeException('Capture failed');}else{$mail->send();}
  return 'sent';
 }catch(Throwable $error){error_log('Utang Wise: reset email delivery failed.');return 'failed';}
}
