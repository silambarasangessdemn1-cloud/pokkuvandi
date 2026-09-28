<?php include('config/setup.php');?>

<?php include('session.php');
 include "email/ex.php";

 $dir_vender_id=$_POST['id'];   
    
$about=mysqli_query($config,$n);
$rep='Business_Enquiry';
$rep .=rand(1000,100000);
$rep .='.csv';
$fp = fopen($rep,'a');          

$cr = "\n";
unset($data);
$data ='';
$data ="Keyword" . ','. "Name" . ',' . "Phone" . ',' . "Msg" .',' . "date" .','. $cr;

$n2="SELECT * FROM `dir_bussness` where vid='$dir_vender_id' and e_status='0' order by (dir_bu_id) DESC ";            
$about=mysqli_query($config,$n2);

                

                while($del=mysqli_fetch_object($about))

                {

                    $cc="SELECT * FROM `dir_post`  where  dir_post_id='$del->e_vender_key' ";
                    $det=mysqli_query($config,$cc);  
  $vbdet=mysqli_fetch_object($det); 
  $cc="SELECT * FROM `dir_city_master` where  dir_city_id='$del->e_area' ";
  $detv=mysqli_query($config,$cc);
  $vbdetv=mysqli_fetch_object($detv);
 
  $data .= "$vbdet->dir_keyword" . ',' . "$del->e_name" .',' . "$del->e_phone" .',' . "$del->e_msg" . ','. "$del->created_at_time" . $cr;

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
	$mail->Subject = 'Thank you for requested Business Enquiry ';
	$mail->Body ='Business Enquiry';
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