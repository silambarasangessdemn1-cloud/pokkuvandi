<?php include('../../config/setup.php');?>
<?php

   

if(isset($_POST['post_add']))
{


 $current_Date=date('Y-m-d');


 $post_id =$_POST['post_id'];
 $from_date =$_POST['from_date'];

 $from_date_time = date('Y-m-d H:i', strtotime("$from_date"));


 $state_status =$_POST['state_status'];
 $from_district =$_POST['from_district'];
 $loader_from_place =$_POST['loader_from_place'];
 $to_district =$_POST['to_district'];
 $loader_to_place =$_POST['loader_to_place'];
 $vehicle_type =$_POST['vehicle_type'];
 $general_remarks =$_POST['general_remarks'];
 $trip_status  = $_POST['status']? $_POST['status'] : '';
 $state =$_POST['state'];
 $to_state=$_POST['to_state'];
 $driver_name = $_POST['driver_name'];
 
 $customer_name = $_POST['customer_name'];
 $customer_phone_no =$_POST['customer_phone_no'];
    $driver_phone_no = $_POST['driver_phone_no']? $_POST['driver_phone_no'] : '';
    $reg_veh_no = $_POST['reg_veh_no']? $_POST['reg_veh_no'] : '';
    $vehicle_type_cpe = $_POST['vehicle_type_cpe']? $_POST['vehicle_type_cpe'] : '';

    // Cancellation information (if applicable)
    $reson_for_cancel = isset($_POST['reson_for_cancel']) ? $_POST['reson_for_cancel'] : '';
    $cancell_date = isset($_POST['cancell_date']) ? $_POST['cancell_date'] : '';

//  echo $tr="update customer_pokkuvandi_entry set from_date='$from_date_time ',place ='$loader_from_place',vehicle_type='$vehicle_type',general_remarks='$general_remarks',to_place='$loader_to_place',from_district='$from_district',to_district='$to_district',state='$state_status' where cus_pokkuvandi_entry_id = '".$_POST['id']."'";
//  die;
 $updateQuery = "UPDATE customer_pokkuvandi_entry SET 
 Customer_Name = '$customer_name',
  Customer_Phone_No = '$customer_phone_no',
from_date = '$from_date_time',
place = '$loader_from_place',
vehicle_type = '$vehicle_type',
general_remarks = '$general_remarks',
to_place = '$loader_to_place',
from_district = '$from_district',
to_district = '$to_district',
state = '$state_status',
from_state_id = '$state',
trip_status = '$trip_status',
to_state_id = '$to_state',
driver_name = '$driver_name',
driver_phone_no = '$driver_phone_no',
reg_veh_no = '$reg_veh_no',
reson_for_cancel = '$reson_for_cancel',
cancell_date = '$cancell_date',
vehicle_type_cpe = '$vehicle_type_cpe'
WHERE cus_pokkuvandi_entry_id = '$post_id'";

// Execute the query
$addmaincate = mysqli_query($config, $updateQuery);

// Redirect with success message
echo "<script>window.location.href='../customer_pokkuvadi_edit.php?msg=505';</script>";


   
  }
  


?>




