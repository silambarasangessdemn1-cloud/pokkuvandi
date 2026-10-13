<?php
include('config/setup.php');
include('session.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'])) {
    $post_id = mysqli_real_escape_string($config, $_POST['post_id']);
    
    // Update activation_popup_shown to 2 (marked as shown so it will never show again)
    $update_sql = "UPDATE create_post 
                   SET activation_popup_shown = 2 
                   WHERE post_id = '$post_id'";
    
    if (mysqli_query($config, $update_sql)) {
        echo json_encode(['success' => true, 'message' => 'Post activation popup marked as shown']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating database: ' . mysqli_error($config)]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
