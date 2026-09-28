
<?php include('config/setup.php');?>
<?php
 include('session.php');

 $post_id =$_POST['post_id'];
 $loader_from_date =$_POST['loader_from_date'];
 $loader_to_date =$_POST['loader_to_date'];
 $loader_from_place =$_POST['loader_from_place'];
 $loader_to_place =$_POST['loader_to_place'];
 $loader_space =$_POST['loader_space'];
 $loader_remarks =$_POST['loader_remarks'];

 

 $datetimefrom = $loader_from_date;
$dateTime = new DateTime($datetimefrom);
 $datefrom = $dateTime->format('Y-m-d'); 
 $time = $dateTime->format('H:i:s ');   
 $timefrom= date('h:i:s a ', strtotime($time));


$datetimeto = $loader_to_date;
$todateTime = new DateTime($datetimeto);
  $dateto = $todateTime->format('Y-m-d'); 
  $endtime = $todateTime->format('H:i:s ');   
  $timeto= date('h:i:s a ', strtotime($endtime));



//     echo $query="update create_post set loader_from_date='".$datefrom."',loader_from_time='".$timefrom."',loader_to_date='".$dateto."',loader_to_time='".$timeto."',loader_from_place='".$loader_from_place."',loader_to_place='".$loader_to_place."',loader_status='1' where post_id='".$post_id."'";
//   die;
    $addmaincate=mysqli_query($config,"update create_post set loader_from_date='".$datefrom."',loader_from_time='".$timefrom."',loader_to_date='".$dateto."',loader_to_time='".$timeto."',loader_from_place='".$loader_from_place."',loader_to_place='".$loader_to_place."',loader_status='1', loader_space='".$loader_space."',loader_remarks='".$loader_remarks."' where post_id='".$post_id."'");	

   if($addmaincate==false)
{
 	
    echo "2"; 
}
else{
	
	echo "1";
	
}	


?>
