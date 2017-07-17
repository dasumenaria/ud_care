<?php 
require_once('phpmailer/class.phpmailer.php');
define('GUSER', 'you@gmail.com'); // GMail username
define('GPWD', 'password'); // GMail password
function smtpmailer($to, $from, $from_name, $subject, $body, $is_gmail = true) 
{ 
	global $error;
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = true; 
	if ($is_gmail) 
	{
		$mail->SMTPSecure = 'ssl'; 
		$mail->Host = 'smtp.googlemail.com';
		$mail->Port = 465;  
		$mail->Username = 'helpline.udaipurcare@gmail.com';  
		$mail->Password = '!QAZ@WSX';   
	}						
	else 
	{
		$mail->Host = SMTPSERVER;
		$mail->Username = SMTPUSER;  
		$mail->Password = SMTPPWD;
	}
	$mail->SetFrom($from, $from_name);
	$HTML = true;	 
	$mail->WordWrap = 50; // set word wrap
	$mail->IsHTML($HTML);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($to);
	if(!$mail->Send()) 
	{
		$error = 'Mail error: '.$mail->ErrorInfo;
		return false;
	} 
	else 
	{
		$error = 'Message sent!';
		return true;
	}
}
?>