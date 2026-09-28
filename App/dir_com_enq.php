<?php include('config/setup.php');?>

 <?php include('session.php');

 

	?>
<?php 
date_default_timezone_set("Asia/Kolkata");
 date_default_timezone_get();
 $created_at_time= date( 'd-m-Y h:i a', time ());
$id=$_POST['mail_id'];
 $mail_id=explode(",",$id);
//  print_r($mail_id);

$sql = "INSERT INTO dir_com_enq (com_enq_name,com_enq_email,com_enq_phone,com_enq_msg,com_enq_city,com_enq_title,created_at_time)
VALUES ('".$_POST['name']."','".$_POST['email']."','".$_POST['phone']."','".$_POST['msg']."','".$_POST['city_id']."','".$_POST['keyid']."','$created_at_time')";
mysqli_query($config,$sql);
 $last_id = mysqli_insert_id($config);





foreach($mail_id as $vid)
{
     $sqlw = "INSERT INTO dir_com_vender_enq (com_enq_id,com_vid,com_key,com_city)
    VALUES ('$last_id','$vid','".$_POST['keyid']."','".$_POST['city_id']."')";
    mysqli_query($config,$sqlw); 

$subject = 'Message from Business Enquiry ';


$field_email=$_POST['name'];
// $body_message = 'From: '.$_POST['name']." ";

// $body_message .= 'E-mail: '.$_POST['email']." ";

// $body_message .= 'Phone: '.$_POST['phone']." ";


// $body_message .= 'Message: '.$_POST['msg']." ";
// $body_message .= 'City: '.$_POST['city_name']." ";
// $body_message .= 'Keyword: '.$_POST['keyword']." ";



$from=$field_email;
                $headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 

$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
             


    include "direct_mail.php";



    $sqlb = "SELECT * FROM `dir_vender` where dir_vender_id ='$vid'";
$result = mysqli_query($config, $sqlb);
$vdata=mysqli_fetch_object($result);
 $mail_id=$vdata->c_email;

mail($mail_id,$subject,$txt,$headers);




    
}

echo '1';

?>