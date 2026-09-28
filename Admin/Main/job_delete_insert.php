<?php 
include('../config/setup.php');

$delete_remarks = $_POST['delete_remarks'];
$post_id = $_POST['id'];

$addmaincate = mysqli_query($config, "UPDATE job_search_post SET delete_remarks='$delete_remarks', delete_id='1' WHERE job_search_id='$post_id'");

if ($addmaincate) {
    echo json_encode(['status' => 'success', 'message' => 'Delete Successfully']);
exit;
} else {
    echo json_encode(['status' => 'error', 'message' => 'Delete Failed']);
}
?>
