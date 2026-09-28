<?php
include('config/setup.php');
include('session.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['customer_id'])) {
    $customer_id = mysqli_real_escape_string($config, $_POST['customer_id']);
    
    // First, check if the column exists, if not, add it
    $check_column = "SHOW COLUMNS FROM customer_master LIKE 'activation_popup_shown'";
    $column_result = mysqli_query($config, $check_column);
    
    if (mysqli_num_rows($column_result) == 0) {
        // Column doesn't exist, add it
        $alter_table = "ALTER TABLE customer_master ADD COLUMN activation_popup_shown TINYINT(1) DEFAULT 0";
        mysqli_query($config, $alter_table);
    }
    
    // Update the activation_popup_shown field
    $update_sql = "UPDATE customer_master 
                   SET activation_popup_shown = 1 
                   WHERE Customer_Id = '$customer_id'";
    
    if (mysqli_query($config, $update_sql)) {
        echo json_encode(['success' => true, 'message' => 'Activation popup marked as shown']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating database: ' . mysqli_error($config)]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
