<?php include('../config/setup.php');

$id=$_POST['id'];

?>
<?php 
$data='';
$shop_master_ = mysqli_query($config, "SELECT * FROM customer_master WHERE Customer_Phone_No LIKE '$id%'");

if (mysqli_num_rows($shop_master_) > 0) {
    while ($sm_ = mysqli_fetch_object($shop_master_)) {
        $data .= '<input type="text" class="form-control" name="customer_name" value="' . $sm_->Customer_Name . '" readonly>';
        $data .= '<input type="hidden" name="Add_customer" value="' . $sm_->Customer_Id . '" readonly>';
    }
} else {
    $data .= '<p style="color: red;">Customer not found.</p>';
}

echo $data;

?>
