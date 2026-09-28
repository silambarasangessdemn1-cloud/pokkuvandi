<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['Lee_del_edit']))
 { 
 echo $_POST['name__del_pol_priv'];
$update_deli=mysqli_query($config,"update cms set Delivery_Policy='".$_POST['name__del_pol_priv']."' where cms_id='".$_POST['Edit_del_pol_cms_id']."'");
 if($update_deli==false)
{
echo  "<script>window.location.href='../delivery_policy.php?erro=0';</script>".mysqli_error($update_deli);	 
}else{
	
echo  "<script>window.location.href='../delivery_policy.php?mes=0';</script>";	 
	
}
 

 }

?>
 