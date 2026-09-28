<?php include('../config/setup.php');?>
<?php 
if(isset($_POST['edit1']))
{
   

    $maincate=mysqli_query($config,"SELECT * FROM `customer_master` where Customer_Phone_No='".$_POST['cust_id']."'");
    
    $macat=mysqli_fetch_object($maincate);
     $cid=$macat->Customer_Id;
    

    $file_name1 = $_FILES['logo']['name'];
    if($file_name1)
    {
        $file_name = $_FILES['logo']['name'];
$file_size =$_FILES['logo']['size'];
     $file_tmp =$_FILES['logo']['tmp_name'];
    $file_type=$_FILES['logo']['type'];
  move_uploaded_file($file_tmp,"../../App/img/dir_logo/".$file_name);

  $sql = "UPDATE dir_vender SET c_name='".$_POST['c_name']."',c_email='".$_POST['c_email']."',c_phone='".$_POST['c_phone']."',site_link='".$_POST['site_link']."',c_logo='$file_name',c_about='".$_POST['about']."'
  ,future_keys='".$_POST['fkeys']."',c_address='".$_POST['c_address']."',c_city='".$_POST['c_city']."',c_area='".$_POST['c_area']."',c_map='".$_POST['map']."',c_video='".$_POST['video']."'
  ,c_whatsapp='".$_POST['whatsapp']."',fb='".$_POST['fb']."',instagram='".$_POST['instagram']."',twitter='".$_POST['twitter']."',cust_id='$cid' WHERE dir_vender_id='".$_POST['id']."'"; 

  mysqli_query($config, $sql);

    }else{

 echo $sql = "UPDATE dir_vender SET c_name='".$_POST['c_name']."',c_email='".$_POST['c_email']."',c_phone='".$_POST['c_phone']."',site_link='".$_POST['site_link']."',c_about='".$_POST['about']."'
  ,future_keys='".$_POST['fkeys']."',c_address='".$_POST['c_address']."',c_city='".$_POST['c_city']."',c_area='".$_POST['c_area']."',c_map='".$_POST['map']."',c_video='".$_POST['video']."'
  ,c_whatsapp='".$_POST['whatsapp']."',fb='".$_POST['fb']."',instagram='".$_POST['instagram']."',twitter='".$_POST['twitter']."',cust_id='$cid' WHERE dir_vender_id='".$_POST['id']."'"; 

  mysqli_query($config, $sql);
    }
$id=$_POST['id'];


    if($_POST['weeks'])
    {
        $week=$_POST['weeks'];
        $sql3 = "DELETE FROM dir_vender_days WHERE dir_day_vender_id='".$_POST['id']."'";
mysqli_query($config,$sql3);
$formtime=$_POST['formtime'];
$totime=$_POST['totime'];
$i=0;
foreach($week as $days)
{
     $sql2 = "INSERT INTO dir_vender_days (dir_day_vender_id,c_days,formtime,totime)

    VALUES ('".$_POST['id']."','$days','".$formtime[$i]."','".$totime[$i]."')";
    mysqli_query($config,$sql2);
$i++;
}
    }
    header("location:bussness_list.php");
    die;
}

if(isset($_POST['keyedit']))
{
$key=$_POST['key'];
$area=$_POST['area'];
// print_r($key);
// print_r($area);
$sql = "DELETE FROM dir_keyword WHERE dir_vender_id='".$_POST['vid']."'";
mysqli_query($config,$sql);
foreach($area as $area)
                    {
                        $key=$_POST['key'];
                        foreach($key as $key)
                        {
                       $sql_key="INSERT INTO dir_keyword (dir_vender_key,dir_vender_id,dir_vender_area,dir_vender_pack,dir_vender_city) VALUES ('$key','".$_POST['vid']."','$area','".$_POST['packid']."','".$_POST['dir_city']."')";
                          mysqli_query($config,$sql_key);
                        }
                    }
                    $id=$_POST['vid'];
                    header("location:dir_bussness_list_details_key.php?eid=$id");
    die;
}
if(isset($_POST['nsubmit']))
{
   
        $file_name = $_FILES['logo']['name'];
$file_size =$_FILES['logo']['size'];
     $file_tmp =$_FILES['logo']['tmp_name'];
    $file_type=$_FILES['logo']['type'];
  move_uploaded_file($file_tmp,"../../App/img/dir_gallery/".$file_name);


    $sql_key="INSERT INTO notification (title,description,n_img,n_type,replay) VALUES ('".$_POST['title']."','".$_POST['desc']."','$file_name','".$_POST['type']."','".$_POST['replay']."')";
    mysqli_query($config,$sql_key);
    header("location:notification.php");
    die;
}
if(isset($_GET['ndid']))
{
    $sql3 = "DELETE FROM notification WHERE n_id='".$_GET['ndid']."'";
    mysqli_query($config,$sql3);
    header("location:notification.php");
    die;
}
if(isset($_POST['nedit']))
{
    $file_name1 = $_FILES['logo']['name'];
    if($file_name1){
    $file_name = $_FILES['logo']['name'];
    $file_size =$_FILES['logo']['size'];
         $file_tmp =$_FILES['logo']['tmp_name'];
        $file_type=$_FILES['logo']['type'];
      move_uploaded_file($file_tmp,"../../App/img/dir_gallery/".$file_name);
    
$sql = "UPDATE notification SET title='".$_POST['title']."',description='".$_POST['desc']."',n_type='".$_POST['type']."',replay='".$_POST['replay']."',n_img='$file_name' WHERE n_id='".$_POST['sid']."'";
mysqli_query($config,$sql);
    }else{
        $sql = "UPDATE notification SET title='".$_POST['title']."',description='".$_POST['desc']."',n_type='".$_POST['type']."',replay='".$_POST['replay']."' WHERE n_id='".$_POST['sid']."'";
        mysqli_query($config,$sql); 
    }

header("location:notification.php");
die;
}

if(isset($_POST['company_status'])){

    $sql = "UPDATE dir_vender SET dirv_status='".$_POST['status']."' WHERE dir_vender_id='".$_POST['id']."'"; 
    mysqli_query($config,$sql); 
    header("location:bussness_list.php");
die;
}
?>