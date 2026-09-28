<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['name_copy']))
 { 
 
    // echo $query="update cms set fron_contanct='".$_POST['name_front']."' where cms_id='".$_POST['Edit_front_id']."'";
$update_about=mysqli_query($config,"update cms set copy_right='".$_POST['name_copy']."' where cms_id='".$_POST['Edit_front_id']."'");
 if($update_about==false)
{
echo  "<script>window.location.href='../copy_right.php?erro=0';</script>".mysqli_error($update_about);	 
}else{
	
echo  "<script>window.location.href='../copy_right.php?mes=0';</script>";	 
	
}
 

 }

?>
 