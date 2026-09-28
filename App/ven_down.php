<?php include('config/setup.php');?>

<?php include('session.php');
 include "email/ex.php";

 $fromdate=$_POST['form'];   
 $enddate=$_POST['end'];      
$about=mysqli_query($config,$n);
$rep='Service_report';
$rep .=rand(1000,100000);
$rep .='.csv';
$fp = fopen($rep,'a');          

$cr = "\n";
unset($data);
$data ='';
$data ="Keyword" . ','. "Sub Key" . ',' . "Description" . ',' . "Date" .',' . "Name" . ',' . "City/Area" .','. $cr;

$det=mysqli_query($config,"SELECT * FROM `biding_vender` where  cust_id='$session_id'");  
$vdet=mysqli_fetch_object($det);
  $sql="SELECT * FROM `vemder_enq_list` INNER JOIN biding_enq ON vemder_enq_list.enq_id=biding_enq.biding_en_id INNER JOIN biding_post ON biding_post.post_id=biding_enq.mid
where venderlid='".$vdet->vender_id."'  and (created_at BETWEEN '$fromdate' AND '$enddate') ";
                $about=mysqli_query($config,$sql);

                

                while($del=mysqli_fetch_object($about))

                {
                    $abouti=mysqli_query($config,"SELECT * FROM `customer_master` where Customer_Id='$del->custom_id'");
                    $delm=mysqli_fetch_object($abouti);
                    $inrologo=mysqli_query($config,"SELECT * FROM `subkeyword` where subid='$del->subkey_id' ");
                    $delr=mysqli_fetch_object($inrologo);
                    $inro_logon=mysqli_query($config,"SELECT * FROM `biding_city_master` INNER JOIN biding_area_master ON biding_city_master.city_id=biding_area_master.cityid WHERE city_id='$del->cityid' and area_id='$del->areaid'");

                    $delrvn=mysqli_fetch_object($inro_logon);
 
  $data .= "$del->keyword" . ',' . "$delr->subkeyword" .',' . "$del->description" .',' . "$del->created_at_time" . ','. "$delm->Customer_Name" . ',' . "$delrvn->city_name $delrvn->area_name" . $cr;

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