<?php
include('../config/setup.php');
// Check if a search query is provided
if (isset($_GET['search'])) {

    $search = mysqli_real_escape_string($config, $_GET['search']);

    // Query to search across all relevant columns
    $sql = "SELECT cm.*, 
    dcm.dir_city_name AS city_name, 
    dam.dir_area_name AS area_name
FROM customer_master cm
LEFT JOIN dir_city_master dcm ON cm.Add_city = dcm.dir_city_id
LEFT JOIN dir_area_master dam ON cm.Add_area = dam.dir_area_id
WHERE cm.Customer_Name LIKE '%$search%' OR
   cm.Customer_Fathername LIKE '%$search%' OR
   cm.Customer_DOB LIKE '%$search%' OR
   cm.Customer_Address LIKE '%$search%' OR
   cm.Customer_Phone_No LIKE '%$search%' OR
   cm.Customer_Mail_id LIKE '%$search%'";

    $result = mysqli_query($config, $sql);

    // Collect matching records
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = [
            'Customer_Name' => $row['Customer_Name'],
            'Customer_Fathername' => $row['Customer_Fathername'],
            'Customer_DOB' => $row['Customer_DOB'],
            'Customer_Address' => $row['Customer_Address'],
            'Add_city' => $row['city_name'],
            'Add_area' => $row['area_name'],
            'Customer_Phone_No' => $row['Customer_Phone_No'],
            'Customer_Mail_id' => $row['Customer_Mail_id'],
            'Customer_Password' => $row['Customer_Password'],
            'Customer_Registred_on' => date('d-m-Y', strtotime($row['Customer_Registred_on'])),
            'Status' => ($row['Customer_Active_Status'] == 1) ? 'Active' : 'In-Active',
            'Customer_Id' => $row['Customer_Id']
        ];
    }

    // Return the data as a JSON response
    echo json_encode($data);
}
// Set Content-Type to JSON

?>
