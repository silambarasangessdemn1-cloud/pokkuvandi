<?php include('../config/setup.php');?>


<?php 
$id=$_POST['id'];
$status=$_POST['status'];

 $sql = "UPDATE membership_list SET status='$status' WHERE memeber_id='$id'";

if (mysqli_query($config, $sql)) {
  } else {
  }
header("location:memberlist.php");
?>