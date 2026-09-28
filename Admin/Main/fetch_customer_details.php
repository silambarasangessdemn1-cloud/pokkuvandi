<?php include('../config/setup.php');?>


<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['customerId'])) {
    $customerId = $_POST['customerId'];

    // Fetch customer details based on the passed ID
    $query = "SELECT * FROM customer_master WHERE Customer_Id = $customerId";
    $result = mysqli_query($config, $query);
    $customer = mysqli_fetch_object($result);

    // Fetch districts
    $districtQuery = "SELECT * FROM dir_city_master";
    $districtResult = mysqli_query($config, $districtQuery);
    $districts = [];
    while ($row = mysqli_fetch_object($districtResult)) {
        $districts[] = $row;
    }

    // Fetch cities based on the selected district
    $cityQuery = "SELECT * FROM dir_area_master WHERE dir_cityid='$customer->Add_city'";
    $cityResult = mysqli_query($config, $cityQuery);
    $cities = [];
    while ($row = mysqli_fetch_object($cityResult)) {
        $cities[] = $row;
    }

    $response = [
        'Customer_Id' => $customer->Customer_Id,
        'Customer_Name' => $customer->Customer_Name,
        'Customer_Fathername' => $customer->Customer_Fathername,
        'Customer_DOB' => $customer->Customer_DOB,
        'Customer_Address' => $customer->Customer_Address,
        'Add_city' => $customer->Add_city,
        'Add_area' => $customer->Add_area,
        'Customer_Phone_No' => $customer->Customer_Phone_No,
        'Customer_Mail_id' => $customer->Customer_Mail_id,
        'Customer_Password' => $customer->Customer_Password,
        'Customer_Active_Status' => $customer->Customer_Active_Status,
        'districts' => $districts,
        'cities' => $cities
    ];

    echo json_encode($response);
}
?>
