
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
 $state_status =$_POST['state_status'];
 $from_district =$_POST['from_district'];
 $from_state =$_POST['from_state'];

 $to_district =$_POST['to_district'];
 $to_state =$_POST['to_state'];


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
  $editon=date('Y-m-d');

// //     echo $query="update create_post set loader_from_date='".$datefrom."',loader_from_time='".$timefrom."',loader_to_date='".$dateto."',loader_to_time='".$timeto."',loader_from_place='".$loader_from_place."',loader_to_place='".$loader_to_place."',loader_status='1' where post_id='".$post_id."'";
// //   die;
    // $addmaincate=mysqli_query($config,"update create_post set loader_from_date='".$datefrom."',loader_from_time='".$timefrom."',loader_to_date='".$dateto."',loader_to_time='".$timeto."',loader_from_place='".$loader_from_place."',loader_to_place='".$loader_to_place."',loader_status='1', loader_space='".$loader_space."',loader_remarks='".$loader_remarks."' where post_id='".$post_id."'");
    
    $addmaincate=mysqli_query($config,"update create_post set loader_status='1' , state_status='$state_status' where post_id='".$post_id."'");
    

    // echo "insert into driver_pokkuvandi_entry(post_id,loader_from_date,loader_from_time,loader_to_date,loader_to_time,loader_from_place,loader_to_place,loader_space,loader_remarks,status,from_district,to_district,state_status)
    // values('$post_id','$datefrom','$timefrom','$dateto','$timeto','$loader_from_place','$loader_to_place','$loader_space','$loader_remarks','1','$from_district','$to_district','$state_status')";

    $update_custom=mysqli_query($config,"insert into driver_pokkuvandi_entry(post_id,loader_from_date,loader_from_time,loader_to_date,loader_to_time,loader_from_place,loader_to_place,loader_space,loader_remarks,status,from_district,to_district,state_status,from_state,to_state)
    values('$post_id','$datefrom','$timefrom','$dateto','$timeto','$loader_from_place','$loader_to_place','$loader_space','$loader_remarks','1','$from_district','$to_district','$state_status','$from_state','$to_state')");	



   if($update_custom==false)
{
 	
    echo "2"; 
}
else{
	
	echo "1";
	
}	


?>
