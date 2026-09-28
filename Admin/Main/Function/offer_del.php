<?php
include('../../config/setup.php');

if (isset($_GET['cd'])) {
    $offer_id = intval($_GET['cd']);
    $delete_query = "DELETE FROM `offers` WHERE `offer_id` = $offer_id";
    
    if (mysqli_query($config, $delete_query)) {
        echo "Offer deleted successfully.";
        // Redirect back to the admin panel or offer list page
        header('Location: ../offers_page.php');
        exit();
    } else {
        echo "Error deleting offer: " . mysqli_error($config);
    }
} else {
    echo "Invalid request.";
}
?>
