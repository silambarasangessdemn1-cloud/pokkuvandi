<?php include('config/setup.php');?>
<?php 
$file_name = $_FILES['image']['name'];
$file_size =$_FILES['image']['size'];
     $file_tmp =$_FILES['image']['tmp_name'];

     move_uploaded_file($file_tmp,"img/dir_help/".$file_name);

$sql = "INSERT INTO dir_help_enq (dir_help_vid,dir_help_desc,dir_help_img)
VALUES ('".$_POST['vid']."', '".$_POST['desc']."', '$file_name')";


mysqli_query($config,$sql);
header("location:dir_help_enq.php");
die;