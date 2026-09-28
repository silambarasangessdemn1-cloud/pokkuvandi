<?php include('config/setup.php');?>

<?php include('session.php');
if(isset($_POST['sub']))
{
   
        $file_name = $_FILES['logo']['name'];
$file_size =$_FILES['logo']['size'];
     $file_tmp =$_FILES['logo']['tmp_name'];
    $file_type=$_FILES['logo']['type'];
  move_uploaded_file($file_tmp,"img/dir_replay/".$file_name);


    $sql_key="INSERT INTO notification_replay (replay_enq,replay_image,n_enq,c_id,replay_order) VALUES ('".$_POST['desc']."','$file_name ','".$_POST['eid']."','".$_POST['id']."','1')";
    mysqli_query($config,$sql_key);
    header("location:ven_notification.php");
    die;
}