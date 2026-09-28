<?php include('config/setup.php');?>

<?php include('session.php');
 include "email/ex.php";

$det=mysqli_query($config,"SELECT * FROM `biding_vender` where  cust_id='$session_id' order by (created_at) DESC");  
$vdet=mysqli_fetch_object($det);
// echo $n="SELECT * FROM `biding_enq_pay` INNER JOIN `biding_enq` ON biding_enq_pay.biding_enq=biding_en_id where custom_id='$session_id' group by (biding_enq) ";
  $n="SELECT * FROM `biding_enq` where custom_id='$session_id' and status='new' order by (created_at) DESC  ";            
$about=mysqli_query($config,$n);
$rep='Service_report';
$rep .=rand(1000,100000);
$rep .='.csv';
$fp = fopen($rep,'a');          

$cr = "\n";
unset($data);
$data ='';
$data ="Keyword" . ',' . "Description" . ',' . "Date" .',' . "Enq" . ','. $cr;
                while($del=mysqli_fetch_object($about))

                {
                    $cc="SELECT * FROM `biding_post` where  post_id='$del->mid' ";
                    $det=mysqli_query($config,$cc);  
  $vdet=mysqli_fetch_object($det); 
    
  $det6=mysqli_query($config,"SELECT count(biding_enq_pay_id) as eq,selecid FROM `biding_enq_pay` where  biding_enq='$del->biding_en_id'");  
  $vdet6=mysqli_fetch_object($det6); 
 
 
  $data .= "$vdet->keyword" . ',' . "$del->description " . ','. "$del->created_at_time " . ',' . "$vdet6->eq" . $cr;

                }
    
                
             
                fwrite($fp,$data);
                fclose($fp);

               

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
	$mail->AddAddress($session__mail);
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
	unlink($rep);
   ?>