<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['Lee_about_edit']))
 { 
 
$update_about=mysqli_query($config,"update cms set About_us='".$_POST['name_about']."' where cms_id='".$_POST['Edit_about_cms_id']."'");
 if($update_about==false)
{
echo  "<script>window.location.href='../about_us.php?erro=0';</script>".mysqli_error($update_about);	 
}else{
	
echo  "<script>window.location.href='../about_us.php?mes=0';</script>";	 
	
}
 

 }

?>
 