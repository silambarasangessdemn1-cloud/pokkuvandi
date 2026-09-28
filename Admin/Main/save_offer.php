<?php include('../config/setup.php');?>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $offer_name = $config->real_escape_string($_POST['offer_name']);

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image'];
        $image_name = uniqid() . '-' . basename($image['name']);
        $image_path = 'uploads/' . $image_name;

        if (move_uploaded_file($image['tmp_name'], $image_path)) {
            // Insert offer details into the database
            $sql = "INSERT INTO offers (image_url, offer_name) VALUES ('$image_path', '$offer_name')";
            if ($config->query($sql) === TRUE) {
                echo "New offer created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $config->error;
            }
        } else {
            echo "Failed to upload image.";
        }
    } else {
        echo "No image uploaded or an error occurred.";
    }
}

// Close connection
$config->close();

?>