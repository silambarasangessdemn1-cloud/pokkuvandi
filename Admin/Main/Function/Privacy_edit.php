<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['Lee_priv_edit']))
 { 
 
$update_about=mysqli_query($config,"update cms set Privacy_policy='".$_POST['name_priv']."' where cms_id='".$_POST['Edit_priv_cms_id']."'");
 if($update_about==false)
{
echo  "<script>window.location.href='../Privacy.php?erro=0';</script>".mysqli_error($update_about);	 
}else{
	
echo  "<script>window.location.href='../Privacy.php?mes=0';</script>";	 
	
}
 

 }

?>
 