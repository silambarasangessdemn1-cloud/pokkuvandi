<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=delete_approval_list.xls");
header("Pragma: no-cache");
header("Expires: 0");

include('../config/setup.php');
echo "S.No\tDriver Name\tPhone No\tAddress\tCategory\tSub Category\tVehicle No\tVehicle Name\tState\tDistrict\tCity\tReason For Delete\n";

$mc = 1;
$main_cate = mysqli_query($config, "SELECT * FROM create_post WHERE delete_id='1' AND delete_approval_status='0' ORDER BY post_id DESC");

while ($macate = mysqli_fetch_object($main_cate)) {
    $cus_city = mysqli_fetch_object(mysqli_query($config, "SELECT * FROM dir_city_master WHERE dir_city_id='$macate->city_id'"));
    $cus_state = mysqli_fetch_object(mysqli_query($config, "SELECT * FROM dir_state_master WHERE state_id='$macate->state_id'"));
    $cus_area = mysqli_fetch_object(mysqli_query($config, "SELECT * FROM dir_area_master WHERE dir_area_id='$macate->area_id'"));
    $recent_cust = mysqli_fetch_object(mysqli_query($config, "SELECT * FROM main_category WHERE Main_Category_id='$macate->category_id'"));
    $cust = mysqli_fetch_object(mysqli_query($config, "SELECT * FROM sub_category WHERE Sub_Category_id='$macate->subcategory_id'"));
    $cust_details = mysqli_fetch_object(mysqli_query($config, "SELECT * FROM customer_master WHERE Customer_Phone_No='$macate->phone_no'"));

    echo "$mc\t$cust_details->Customer_Name\t$macate->phone_no\t$macate->Address\t$recent_cust->Main_Category_Name\t$cust->Sub_Category_Name\t$macate->vehicle_no\t$macate->vehicle_name\t$cus_state->name\t$cus_city->dir_city_name\t$cus_area->dir_area_name\t$macate->delete_remarks\n";
    $mc++;
}
?>
