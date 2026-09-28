<?php
include('../config/setup.php');

// Handle DataTable Request (Pagination, Search, Sorting)
$limit = isset($_GET['length']) ? $_GET['length'] : 10;  // Number of records per page
$start = isset($_GET['start']) ? $_GET['start'] : 0; // Starting record
$search = isset($_GET['search']['value']) ? $_GET['search']['value'] : ''; // Search term

// Sorting parameters
$order_column = isset($_GET['order'][0]['column']) ? $_GET['order'][0]['column'] : 0; // Default column to sort by
$order_dir = isset($_GET['order'][0]['dir']) ? $_GET['order'][0]['dir'] : 'asc'; // Sorting direction

// Columns to sort by (corresponds to the column indices in DataTables)
$columns = ['Customer_Id', 'Customer_Name', 'Customer_Fathername', 'Customer_DOB', 'Customer_Address', 'Add_city', 'Add_area', 'Customer_Phone_No', 'Customer_Mail_id', 'Customer_Password', 'Customer_Registred_on', 'Customer_Active_Status'];

$order_by = $columns[$order_column] . ' ' . $order_dir; // Determine order by clause

// SQL query to get the filtered and paginated records
$query = "SELECT * FROM customer_master WHERE Customer_Name LIKE '%$search%' ORDER BY Customer_Id DESC LIMIT $start, $limit";
$result = mysqli_query($config, $query);

// Fetch data for DataTables
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $main_cate_dis = mysqli_query($config, "SELECT * FROM dir_city_master WHERE dir_city_id = '{$row['Add_city']}'");
    $addsubcate_dis = mysqli_fetch_assoc($main_cate_dis);

    $main_cate_area = mysqli_query($config, "SELECT * FROM dir_area_master WHERE dir_area_id = '{$row['Add_area']}'");
    $addsubcate_area = mysqli_fetch_assoc($main_cate_area);

    $data[] = [
        'Customer_Id' => $row['Customer_Id'],
        'Customer_Name' => $row['Customer_Name'],
        'Customer_Fathername' => $row['Customer_Fathername'],
        'Customer_DOB' => $row['Customer_DOB'],
        'Customer_Address' => $row['Customer_Address'],
        'City' => $addsubcate_dis['dir_city_name'],
        'Area' => $addsubcate_area['dir_area_name'],
        'Phone_No' => $row['Customer_Phone_No'],
        'Email' => $row['Customer_Mail_id'],
        'Password' => $row['Customer_Password'],
        'Register_Date' => date('d-m-Y', strtotime($row['Customer_Registred_on'])),
        'Status' => $row['Customer_Active_Status'] == 1 ? 'Active' : 'Inactive',
        'Action' => '
    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="exampleModal">
            <i class="fas fa-pencil-alt"></i>
        </a>
        <a href="Function/customer_delete.php?delcuteid=' . $row['Customer_Id'] . '&delcat=100" class="btn btn-danger" onClick="return confirm(\'Are you sure you want to delete this Customer?\');">
            <i class="fas fa-trash"></i>
        </a>
    '
    ];
}

// Get the total number of records (for pagination)
$totalRecordsResult = mysqli_query($config, "SELECT COUNT(*) AS total FROM customer_master");
$totalRecords = mysqli_fetch_assoc($totalRecordsResult)['total'];

// Prepare response for DataTables
$response = [
    'draw' => isset($_GET['draw']) ? $_GET['draw'] : 1, // DataTables draw counter
    'recordsTotal' => $totalRecords, // Total number of records without filters
    'recordsFiltered' => $totalRecords, // Filtered number of records (same as recordsTotal if no filter)
    'data' => $data // Data to be displayed in the table
];

// Set Content-Type to JSON
header('Content-Type: application/json');

// Send JSON response
echo json_encode($response);
exit();
?>
