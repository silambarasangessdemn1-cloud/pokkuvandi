<?php include('../../config/setup.php');?>
<?php

   

if(isset($_POST['post_add']))
{
 $current_Date=date('Y-m-d');


 $post_id =$_POST['post_id'];
 $loader_from_date =$_POST['loader_from_date'];
 $loader_to_date =$_POST['loader_to_date'];
 $loader_from_place =$_POST['loader_from_place'];
 $loader_to_place =$_POST['loader_to_place'];
 $loader_space =$_POST['loader_space'];
 $loader_remarks =$_POST['loader_remarks'];
 $state_status =$_POST['state_status'];
 $from_district =$_POST['from_district'];
 $to_district =$_POST['to_district'];
 

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



//  echo $tr="update driver_pokkuvandi_entry set loader_from_date='$datefrom',loader_from_time='$timefrom',loader_to_date='$dateto',loader_to_time='$timeto',loader_from_place='$loader_from_place',loader_to_place='$loader_to_place',loader_space='$loader_space',loader_remarks='$loader_remarks',from_district='$from_district',to_district='$to_district',state_status='$state_status' where driver_pokkuvandi_entry_id = '".$_POST['id']."'";
//  die;
        $addmaincate=mysqli_query($config,"update driver_pokkuvandi_entry set loader_from_date='$datefrom',loader_from_time='$timefrom',loader_to_date='$dateto',loader_to_time='$timeto',loader_from_place='$loader_from_place',loader_to_place='$loader_to_place',loader_space='$loader_space',loader_remarks='$loader_remarks',from_district='$from_district',to_district='$to_district',state_status='$state_status' where driver_pokkuvandi_entry_id = '".$_POST['id']."'");	
        echo "<script>window.location.href='../pokkuvandi_entry_edit.php?msg=505';</script>";


   
  }
  


?>




