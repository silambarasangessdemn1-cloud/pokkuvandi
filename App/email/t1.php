<?php 
include 'ex.php';

$rep='Invoice-ORD294082110.pdf';
$mail = new PHPMailer(); 
// $mail->SMTPDebug=3;
$mail->IsSMTP(); 
$mail->SMTPAuth = true; 
$mail->SMTPSecure = 'ssl'; 
$mail->Host = "smtp.hostinger.com";
$mail->Port = "465"; 
$mail->IsHTML(true);
$mail->CharSet = 'UTF-8';
$mail->Username = "sales@callinfo.in";
$mail->Password = 'Sales!234';
$mail->SetFrom("sales@callinfo.in");
$mail->AddAttachment($rep);
$mail->Subject = 'Thank you for requested Service report ';
$mail->Body ='Service Report';
$mail->AddAddress('saravanansri1999@gmail.com');
$mail->SMTPOptions=array('ssl'=>array(
    'verify_peer'=>false,
    'verify_peer_name'=>false,
    'allow_self_signed'=>false
));
if(!$mail->Send()){
    echo $mail->ErrorInfo;
}else{
     echo '1';
}
?>