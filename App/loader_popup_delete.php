
<?php include('config/setup.php');?>
<?php
 include('session.php');


 $id=$_REQUEST['id'];


//  echo $query="update create_post set loader_from_date='',loader_from_time='',loader_to_date='',loader_to_time='',loader_from_place='',loader_to_place='',loader_status='0', loader_space='',loader_remarks='' where post_id='".$id."'";
//  die;
    // $addmaincate=mysqli_query($config,"update create_post set loader_from_date='',loader_from_time='',loader_to_date='',loader_to_time='',loader_from_place='',loader_to_place='',loader_status='0', loader_space='',loader_remarks='' where post_id='".$id."'");	

    $addmaincate_update=mysqli_query($config,"update driver_pokkuvandi_entry set status='0' where driver_pokkuvandi_entry_id='".$id."'");	




   if($addmaincate==false)
{
 	
    echo "<script>window.location.href='pokkuvandi_entry_view.php?msg=100';</script>";	 
}
else{
	
    echo "<script>window.location.href='pokkuvandi_entry_view.php?msg=100';</script>";	 
	
}	


?>
