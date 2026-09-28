<?php
include('config/setup.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get values from POST
    $utr_number = mysqli_real_escape_string($config, $_POST['utr_number']);
    $utr_date   = mysqli_real_escape_string($config, $_POST['utr_date']); // new field
    $post_id    = intval($_POST['post_id']);

    // Basic validation
    if (empty($utr_number) || empty($utr_date) || empty($post_id)) {
        echo "Invalid input.";
        exit;
    }

    // Update query
    $query = "UPDATE create_post 
              SET utr_number = '$utr_number', utr_date = '$utr_date' 
              WHERE post_id = '$post_id'";

    if (mysqli_query($config, $query)) {
        echo "UTR submitted successfully!";
    } else {
        echo "Database error: " . mysqli_error($config);
    }
} else {
    echo "Invalid request method.";
}
?>
