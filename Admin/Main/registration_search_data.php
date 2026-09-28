<?php
include('../config/setup.php');

$search = $_GET['search'];
$results = [];

$query = "SELECT create_post.*, 
                 dir_city_master.dir_city_name, 
                 dir_area_master.dir_area_name, 
                 sub_area_master.sub_area_name
          FROM create_post 
          LEFT JOIN dir_city_master ON create_post.city_id = dir_city_master.dir_city_id
          LEFT JOIN dir_area_master ON create_post.area_id = dir_area_master.dir_area_id
          LEFT JOIN sub_area_master ON create_post.sub_area_id = sub_area_master.sub_area_id
          WHERE create_post.delete_id = '0' 
          AND (create_post.driver_name LIKE '%$search%' 
               OR create_post.vehicle_no LIKE '%$search%' 
               OR create_post.phone_no LIKE '%$search%' 
               OR create_post.whatsapp_no LIKE '%$search%' 
               OR create_post.post_addon LIKE '%$search%'
               OR dir_city_master.dir_city_name LIKE '%$search%'
               OR dir_area_master.dir_area_name LIKE '%$search%'
               OR sub_area_master.sub_area_name LIKE '%$search%')
          ORDER BY create_post.post_id DESC";

$result = mysqli_query($config, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $results[] = [
        'Post_Id' => $row['post_id'],
        'Driver_Name' => $row['driver_name'],
        'Vehicle_No' => $row['vehicle_no'],
        'Vehicle_Photo' => $row['vehicle_photo'],
        'Phone_No' => $row['phone_no'],
        'Whatsapp_No' => $row['whatsapp_no'],
        'District' => $row['dir_city_name'],
        'City' => $row['dir_area_name'],
        'Area' => $row['sub_area_name'],
        'Status' => $row['status'] == 1 ? 'Active' : 'In-Active',
        'Create_On' => date('d-m-Y', strtotime($row['post_addon']))
    ];
}

echo json_encode($results);
?>
