
<?php include('config/setup.php');?>
<?php
 include('session.php');

 $post_id =$_POST['post_id'];
 $diable_status =$_POST['diable_status'];
 
//    echo $query="update create_post set disable_status='".$diable_status."' where post_id='".$post_id."'";
// die;   
    $addmaincate=mysqli_query($config,"update create_post set disable_status='".$diable_status."' where post_id='".$post_id."'");	

   if($addmaincate==false)
{
 	
    echo "2"; 
}
else{
	
	echo "1";
	
}	


?>
