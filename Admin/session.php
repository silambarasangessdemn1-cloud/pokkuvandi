<?php include('config/setup.php');


?>

<?php
  

if(!isset($_SESSION)){
    session_start();
}
   
  $prof_id=$_SESSION['usr_id'];
  
$session=mysqli_query($config,"select * from master_login where Master_id='$prof_id' ");
$s1=mysqli_fetch_array($session);
$session_id=$s1['Master_id'];
$session__username=$s1['Master_Name'];
$session__usertype=$s1['Master_Type'];
$session__password=$s1['Master_Password'];




 if(!isset($session_id))
{
mysqli_close($config);
}

?>