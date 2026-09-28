<?php include('../config/setup.php');?>

<?php


// Get the requested page number, number of records per page, and search query from DataTables
$start = isset($_POST['start']) ? $_POST['start'] : 0;
$length = isset($_POST['length']) ? $_POST['length'] : 10;
$search = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';

// Get the total number of records in the database
$total_records_query = mysqli_query($config, "SELECT COUNT(*) as total FROM online_payment_transcation");
$total_records = mysqli_fetch_assoc($total_records_query)['total'];

// If there is a search term, filter the data
$search_query = "";
if (!empty($search)) {
    $search_query = "WHERE Customer_Name LIKE '%$search%' OR Order_Paid_Status LIKE '%$search%' OR Payment_Gateway LIKE '%$search%' OR Paid_Amout LIKE '%$search%' OR merchantTransactionId LIKE '%$search%' OR Paid_on LIKE '%$search%'  ";
}

// Query to get the filtered records based on the search term and pagination
$query = "SELECT * FROM online_payment_transcation $search_query ORDER BY Online_order_id DESC LIMIT $start, $length";

$result = mysqli_query($config, $query);

// Prepare the data to be returned in JSON format
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = [
        'customer_name' => $row['Customer_Name'],
        'order_paid_status' => $row['Order_Paid_Status'],
        'paid_on' => $row['Paid_on'],
        'payment_gateway' => $row['Payment_Gateway'],
        'paid_amount' => $row['Paid_Amout'],
        'merchant_transaction_id' => $row['merchantTransactionId']
    ];
}

// Calculate the filtered record count
$filtered_records_query = "SELECT COUNT(*) as filtered FROM online_payment_transcation $search_query";
$filtered_records_result = mysqli_query($config, $filtered_records_query);
$filtered_records = mysqli_fetch_assoc($filtered_records_result)['filtered'];

// Return the data in DataTables expected JSON format
echo json_encode([
    'draw' => isset($_POST['draw']) ? $_POST['draw'] : 1,
    'recordsTotal' => $total_records,
    'recordsFiltered' => $filtered_records,
    'data' => $data
]);
?>
