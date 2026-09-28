<?php
include('../../config/setup.php');

if(isset($_POST['delete_approval']))
{ 
    $delete_approval_status = $_POST['delete_approval_status'];

    if($delete_approval_status == '1'){
        // Set the timezone to Indian Standard Time (IST)
        date_default_timezone_set('Asia/Kolkata');
        
        // Set the delete date to current date and time in IST
        $delete_date = date('Y-m-d H:i:s'); // Format current date and time in IST
    }

    $post_id = $_POST['post_id'];

    // Update query with the current date and delete_reason
    $update_query = "
        UPDATE create_post 
        SET 
            delete_approval_status = '".$_POST['delete_approval_status']."', 
            delete_reason = '".$_POST['delete_reason']."', 
            delete_date = '".$delete_date."' 
        WHERE post_id = '".$_POST['post_id']."' 
    ";

    // Execute the query
    $addmaincate = mysqli_query($config, $update_query);

    if($addmaincate == false)
    {
        echo mysqli_error(); // If query fails, show error
    }
    else{
        // Redirect with a success message
        echo "<script>window.location.href='../delete_approval.php?msg=100';</script>";	 
    }
}
?>
