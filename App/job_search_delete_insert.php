<?php include('config/setup.php');

$delete_remarks = $_POST['delete_remarks'];
//echo "update create_post set delete_remarks='".$_POST['delete_remarks']."' , delete_id ='1'  where post_id='".$_POST['id']."'";
 $addmaincate=mysqli_query($config,"update job_search_post set delete_remarks='".$_POST['delete_remarks']."' , delete_id ='1'  where job_search_id='".$_POST['id']."'");	

?>