<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['Lee_tc_edit']))
 { 
 
$update_tc=mysqli_query($config,"update cms set Refund_policy='".$_POST['name_trefp']."' where cms_id='".$_POST['Edit_cms_id']."'");
 if($update_tc==false)
{
echo  "<script>window.location.href='../RFmaster.php?erro=0';</script>".mysqli_error($update_tc);	 
}else{
	
echo  "<script>window.location.href='../RFmaster.php?mes=0';</script>";	 
	
}
 

 }

?>
 