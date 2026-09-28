<?php
header("Content-Type: application/json"); // Ensures JSON response
include('../config/setup.php');

if (isset($_POST['newPassword']) && isset($_POST['customerId'])) {
    $newPassword = $_POST['newPassword'];
    $customerId = $_POST['customerId'];

    // Hash password using MD5 (⚠️ Not Secure! Consider using password_hash())
    $hashedPassword = md5($newPassword);

    // Update the password in the database
    $query = "UPDATE customer_master SET Customer_Password = '$hashedPassword' WHERE Customer_Id = '$customerId'";

    if (mysqli_query($config, $query)) {
        echo json_encode(["success" => true, "message" => "Password changed successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error updating password: " . mysqli_error($config)]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Required data not received."]);
}
?>
