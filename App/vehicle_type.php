<?php include('config/setup.php');

$id = $_POST['id'];

$data = '';

$data .= '<select required class="form-control" name="vehicle_type_id" id="Add_vehicle_type" onchange="selectVehicleType(this)" ><option value="">---Select---</option>';

$shop_master_ = mysqli_query($config, "select * from vehicle_type where Sub_Category_id='$id' and status='1'");
while ($sm_ = mysqli_fetch_object($shop_master_)) {
    $data .= '<option value="'.$sm_->Vehicle_type_id.'">'.$sm_->Vehicle_type_name.'</option>';
}
 $data .= '<option value="0">Others</option>';  // This is the new option for "Others"

$data .= '</select>';
echo $data;
?>
