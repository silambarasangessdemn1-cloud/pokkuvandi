<?php
 include('config/setup.php');

$sub_category_id = $_POST['sub_category_id'];
$customer_id = $_POST['customer_id'];

$options = '';

 $query = "SELECT DISTINCT vt.Vehicle_type_id, vt.vehicle_type_name 
          FROM create_post  cp
          JOIN vehicle_type vt ON cp.vehicle_type_id = vt.Vehicle_type_id
          WHERE cp.customer_id = '$customer_id' AND cp.subcategory_id = '$sub_category_id'";

$result = mysqli_query($config, $query);

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $options .= "<option value='{$row['Vehicle_type_id']}'>{$row['vehicle_type_name']}</option>";
  }
} else {
  $options = "<option value=''>No vehicles found</option>";
}

echo $options;
?>
