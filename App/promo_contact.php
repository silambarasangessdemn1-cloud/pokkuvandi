<?php include('config/setup.php');?>



<?php 



 $sql = "INSERT INTO promote_enquiry (name,email,phone,msg,status,view)

VALUES ('".$_POST['name']."','".$_POST['email']."','".$_POST['phone']."','".$_POST['msg']."','1','0')";



 mysqli_query($config,$sql);

echo '1';





?>