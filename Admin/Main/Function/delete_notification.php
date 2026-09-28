<?php
include('../../config/setup.php');

if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Start transaction for data integrity
    mysqli_begin_transaction($config);
    
    try {
        // First, delete all replies associated with this notification (to avoid foreign key constraint)
        $delete_replies_sql = "DELETE FROM notification_replies WHERE notification_id = '$id'";
        $delete_replies_result = mysqli_query($config, $delete_replies_sql);
        
        if (!$delete_replies_result) {
            throw new Exception("Error deleting replies: " . mysqli_error($config));
        }
        
        // Then delete the notification itself
        $delete_notification_sql = "DELETE FROM comman_notification_messages WHERE notification_id = '$id'";
        $delete_notification_result = mysqli_query($config, $delete_notification_sql);
        
        if (!$delete_notification_result) {
            throw new Exception("Error deleting notification: " . mysqli_error($config));
        }
        
        // Commit transaction if both deletions are successful
        mysqli_commit($config);
        echo "<script>alert('Notification and all associated replies deleted successfully');window.location='../comman_notification_messages.php';</script>";
        
    } catch (Exception $e) {
        // Rollback transaction on error
        mysqli_rollback($config);
        echo "<script>alert('Error deleting notification: " . addslashes($e->getMessage()) . "');window.history.back();</script>";
    }
} else {
    echo "<script>alert('Invalid notification ID');window.history.back();</script>";
}
?>
