<?php
// Your database connection
include('../config/setup.php');

// Check if the export parameter is set
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$searchQuery = "";
if (!empty($searchTerm)) {
    $searchQuery = "AND (
        customer_name LIKE '%$searchTerm%' 
        OR customer_phone_no LIKE '%$searchTerm%' 
        OR job_name LIKE '%$searchTerm%' 
        OR company_name LIKE '%$searchTerm%' 
        OR salary_range LIKE '%$searchTerm%' 
        OR contact_no LIKE '%$searchTerm%' 
        OR email_id LIKE '%$searchTerm%' 
    )";
}

$main_cate = mysqli_query(
    $config,
    "SELECT * FROM job_search_post 
    WHERE delete_id = '0' 
    AND job_category_id != '1' 
    $searchQuery 
    ORDER BY job_search_id DESC"
);

// Create a new PHP file to store the Excel data
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="job_search_export.xls"');
header('Cache-Control: max-age=0');

// Start outputting the HTML table structure for Excel
echo "<table border='1' cellpadding='5' cellspacing='0'>";

// Add table headers
echo "<thead>";
echo "<tr>";
echo "<th>S.No</th>";
echo "<th>Name</th>";
echo "<th>Phone No</th>";
echo "<th>Category Name</th>";
echo "<th>Job Name</th>";
echo "<th>Experiences</th>";
echo "<th>Qualification</th>";
echo "<th>Company Name</th>";
echo "<th>Salary Range</th>";
echo "<th>Contact No</th>";
echo "<th>Email Id</th>";
echo "<th>Licence No</th>";
echo "<th>Vehicle Type</th>";
echo "<th>Create On</th>";
echo "<th>Last Date</th>";
echo "<th>Address</th>";
echo "<th>Remarks</th>";
echo "<th>Amount</th>";
echo "<th>Exp Date</th>";
echo "</tr>";
echo "</thead>";

// Add table body with the data from the database
echo "<tbody>";
$mc = 1; // Starting S.No
while ($macate = mysqli_fetch_object($main_cate)) {
    // Fetch the category name for the job
    $main_cate__cate = mysqli_query($config, "SELECT * FROM job_search_category WHERE Main_Category_id ='$macate->job_category_id'");
    $macate_cate = mysqli_fetch_object($main_cate__cate);

    // Format the dates
    $postDate = date('d-m-Y', strtotime($macate->post_date));
    $lastDate = date('d-m-Y', strtotime($macate->last_date));
    $expDate = date('d-m-Y', strtotime($macate->exp_date));

    // Output each row of data
    echo "<tr>";
    echo "<td>$mc</td>";
    echo "<td>{$macate->customer_name}</td>";
    echo "<td>{$macate->customer_phone_no}</td>";
    echo "<td>{$macate_cate->Main_Category_Name}</td>";
    echo "<td>{$macate->job_name}</td>";
    echo "<td>{$macate->experiences}</td>";
    echo "<td>{$macate->qualification}</td>";
    echo "<td>{$macate->company_name}</td>";
    echo "<td>{$macate->salary_range}</td>";
    echo "<td>{$macate->contact_no}</td>";
    echo "<td>{$macate->email_id}</td>";
    echo "<td>{$macate->licence_no}</td>";
    echo "<td>{$macate->vehicle_type}</td>";
    echo "<td>$postDate</td>";
    echo "<td>$lastDate</td>";
    echo "<td>{$macate->address}</td>";
    echo "<td>{$macate->remarks}</td>";
    echo "<td>{$macate->amount}</td>";
    echo "<td>$expDate</td>";
    echo "</tr>";

    $mc++; // Increment S.No
}
echo "</tbody>";

// End the table
echo "</table>";

// Exit to complete the export
exit();
?>
