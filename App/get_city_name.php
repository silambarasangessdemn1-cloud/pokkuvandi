<?php
include('config/setup.php');

$id = $_GET['id'] ?? '';  // Get the ID from the URL parameter (or set to empty if not set)
$response = [];

if ($id != '') {
    // Fetch all records where dir_cityid matches the provided $id
    $query = mysqli_query($config, "SELECT * FROM dir_area_master WHERE dir_cityid = '$id'");

    // Loop through the query results to fetch all matching records
    while ($row = mysqli_fetch_assoc($query)) {
        $response[] = [
            'id' => $row['dir_area_id'],
            'name' => $row['dir_area_name']
        ];
    }
}

// If needed, return or output the results
echo json_encode($response);
?>
