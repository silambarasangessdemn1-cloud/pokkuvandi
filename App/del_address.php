  <?php include('config/setup.php');?>
 <?php include('session.php');?>
 
 <?php
 if($_GET['delid']==2000)
 {
	 $delivery_add=mysqli_query($config," delete from customer_addresss_master where  Customet_id='$session_id' and Address_id='".$_GET['deladd']."' ");
	      header('location:my_address.php');  
 }
 
 
 
 
 
 ?>
 