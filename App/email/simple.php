<?php
include('smtp/PHPMailerAutoload.php');

function smtp_mailer($to, $subject, $msg, &$error_msg = null){

	$mail = new PHPMailer(); 
	// $mail->SMTPDebug = 2; // Enable for debugging
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = "587"; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "pokkuvandiho@gmail.com";
	$mail->Password = 'cwpzvywrdutclrco';
	$mail->SetFrom("pokkuvandiho@gmail.com", "Pokkuvandi Support");
	$mail->Subject = $subject;
	$mail->Body = $msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions = array('ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
	));
	
	if(!$mail->Send()){
		$error_msg = $mail->ErrorInfo;
		return false;
	} else {
		return true;
	}
}
?>