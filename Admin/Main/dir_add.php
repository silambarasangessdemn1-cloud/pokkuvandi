<?php include('../config/setup.php');?>
<?php 

$cmail=$_POST['c_email'];
$cname=$_POST['c_name'];
$subject = 'Directory Membership  payment has been confirmed ';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 

$headers .= 'From: '.$cmail."\r\n".
    'Reply-To: '.$cmail."\r\n" .
    'X-Mailer: PHP/' . phpversion();
  $PP=rand(100000,100000000);


    include 'dir_contact_mail.php';           
    mail($cmail,$subject,$txt,$headers);




 $sqlo = "DELETE FROM dir_enq WHERE dir_enq_id='".$_POST['c_id']."'";
 mysqli_query($config,$sqlo);



$_POST['cust_id'];

$maincate=mysqli_query($config,"SELECT * FROM `customer_master` where Customer_Phone_No='".$_POST['cust_id']."'");

$macat=mysqli_fetch_object($maincate);
 $cid=$macat->Customer_Id;



$pcom=$_POST['com'];
$damount=$_POST['damount'];
$t=$pcom*$damount;

 $comm=$t/100;

echo $sqlm = "UPDATE customer_master SET Customer_Wallet=Customer_Wallet+'$comm' WHERE Customer_Id='".$_POST['rid']."'";
mysqli_query($config,$sqlm); 

 


$d=$_POST['package_valid'];
$date=date("d-m-Y");
 $ex_date=date('d-m-Y', strtotime($date. '+'.$d.'day'));




$file_name = $_FILES['logo']['name'];
$file_size =$_FILES['logo']['size'];
     $file_tmp =$_FILES['logo']['tmp_name'];
    $file_type=$_FILES['logo']['type'];
  move_uploaded_file($file_tmp,"../../App/img/dir_logo/".$file_name);
  
$gtotal=(($_POST['finaltotal'] )+($_POST['dir_amount']));
 $sql = "INSERT INTO dir_vender (cust_id,packid,c_name,c_email,c_phone,site_link,c_logo,c_about,future_keys
,c_address,c_city,c_area,c_map,c_video,c_whatsapp,fb,instagram,twitter,ex_date,total_days,total_amount,dir_pay_id)
VALUES ('$cid','".$_POST['packid']."', '".$_POST['c_name']."', '".$_POST['c_email']."'
, '".$_POST['c_phone']."', '".$_POST['site_link']."','$file_name', '".$_POST['about']."', '".$_POST['fkeys']."'
, '".$_POST['c_address']."', '".$_POST['c_city']."', '".$_POST['c_area']."', '".$_POST['map']."'
, '".$_POST['video']."', '".$_POST['whatsapp']."', '".$_POST['fb']."', '".$_POST['instagram']."', '".$_POST['twitter']."'
, '$ex_date', '".$_POST['package_valid']."','$gtotal','$PP')";

mysqli_query($config,$sql); 

$last_id = mysqli_insert_id($config);
echo $sqlj = "INSERT INTO dir_commistion (dir_com_cid,dir_com_amount,dir_down)
VALUES ('".$_POST['rid']."','$comm','$last_id')";
mysqli_query($config,$sqlj);


$file_name = $_FILES['image']['name'];
$file_size =$_FILES['image']['size'];
 $file_tmp =$_FILES['image']['tmp_name'];
$file_type=$_FILES['image']['type'];
$countfiles = count($_FILES['image']['name']);
for($i=0;$i<$countfiles;$i++){
    $filename = $_FILES['image']['name'][$i];
   
    move_uploaded_file($_FILES['image']['tmp_name'][$i],'../../App/img/dir_gallery/'.$filename);
    $sql1 = "INSERT INTO dir_vender_gallery (dir_venderid,image)

    VALUES ('$last_id','$filename')";
mysqli_query($config,$sql1);

   }
$week=$_POST['weeks'];

$formtime=$_POST['formtime'];
$totime=$_POST['totime'];
$i=0;
foreach($week as $days)
{
     $sql2 = "INSERT INTO dir_vender_days (dir_day_vender_id,c_days,formtime,totime)

    VALUES ('$last_id','$days','".$formtime[$i]."','".$totime[$i]."')";
    mysqli_query($config,$sql2);
$i++;
}

$area=$_POST['area'];
foreach($area as $area)
                    {
                        $key=$_POST['key'];
                        foreach($key as $key)
                        {
                       $sql_key="INSERT INTO dir_keyword (dir_vender_key,dir_vender_id,dir_vender_area,dir_vender_pack,dir_vender_city) VALUES ('$key','$last_id','$area','".$_POST['packid']."','".$_POST['dir_city']."')";
                          mysqli_query($config,$sql_key);
                        }
                    }

?>

 <script>
    alert('Successfully Added DIRECTORY');
</script> 
<?php
 $pid=$_POST['packid'];
                    header("location:addkeypack.php?vid=$last_id&packid=$pid");
                     die;
?>