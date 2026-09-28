
<?php include('config/setup.php');?>
<?php
 include('session.php');

 $post_id =$_POST['post_id'];
 $city =$_POST['city'];
 $area1 =$_POST['area1'];
  $subarea =$_POST['subarea'];
  $state =$_POST['state'];
  $edit_location = mysqli_real_escape_string($config, isset($_POST['edit_location']) ? $_POST['edit_location'] : '');

//    echo $query="update create_post set city_id='".$city."',area_id='".$area1."' ,sub_area_id='".$subarea."'  where post_id='".$post_id."'";
// die;   
    $addmaincate=mysqli_query($config,"update create_post set city_id='".$city."',area_id='".$area1."' ,sub_area_id='".$subarea."' ,state_id='".$state."', Add_location='".$edit_location."' where post_id='".$post_id."'");	

   if($addmaincate==false)
{
 	
    echo "2"; 
}
else{
	
	echo "1";
	
}	


?>
