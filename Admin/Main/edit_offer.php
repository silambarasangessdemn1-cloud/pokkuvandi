<?php include('../config/setup.php');?>


<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $offer_id = $_POST['offer_id'];
    $offer_name = $config->real_escape_string($_POST['offer_name']);

    $update_sql = "UPDATE offers SET offer_name = '$offer_name'";

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image'];
        $image_name = uniqid() . '-' . basename($image['name']);
        $image_path = 'uploads/' . $image_name;

        if (move_uploaded_file($image['tmp_name'], $image_path)) {
            $update_sql .= ", image_url = '$image_path'";
        } else {
            echo "Failed to upload image.";
            exit;
        }
    }

    $update_sql .= " WHERE offer_id = '$offer_id'";

    if ($config->query($update_sql) === TRUE) {
       header('Location : offers_page.php');
    } else {
        echo "Error: " . $update_sql . "<br>" . $config->error;
    }
}

// Close connection
$config->close();
?>