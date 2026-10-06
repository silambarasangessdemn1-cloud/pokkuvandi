<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['Lee_front_edit']))
 { 
 
    // echo $query="update cms set fron_contanct='".$_POST['name_front']."' where cms_id='".$_POST['Edit_front_id']."'";
$update_about=mysqli_query($config,"update cms set fron_contanct='".$_POST['name_front']."', fron_contanct_tamil='".$_POST['name_front_tamil']."' where cms_id='".$_POST['Edit_front_id']."'");
 if($update_about==false)
{
echo  "<script>window.location.href='../front_content.php?erro=0';</script>".mysqli_error($update_about);	 
}else{
	
echo  "<script>window.location.href='../front_content.php?mes=0';</script>";	 
	
}
 

 }

?>
 