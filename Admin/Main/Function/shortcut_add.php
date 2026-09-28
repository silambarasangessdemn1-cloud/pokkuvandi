<?php
include('../../config/setup.php');

$name = $_POST['name'];
$url = $_POST['target_url'];

$imageName = $_FILES['image']['name'];
$imagePath = '../uploads/shortcuts/' . $imageName;
move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
$imagePath1 = 'uploads/shortcuts/' . $imageName;

mysqli_query($config, "INSERT INTO shortcuts (name, image_url, target_url) VALUES ('$name', '$imagePath1', '$url')");
header('Location: ../short_cut.php');
?>
