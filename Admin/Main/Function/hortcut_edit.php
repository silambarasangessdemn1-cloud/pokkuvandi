<?php
include('../../config/setup.php');

$id = $_POST['shortcut_id'];
$name = $_POST['name'];
$url = $_POST['target_url'];


if (!empty($_FILES['image']['name'])) {
    $imageName = $_FILES['image']['name'];
    $imagePath = '../uploads/shortcuts/' . $imageName;
    move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    $imagePath1 = 'uploads/shortcuts/' . $imageName;
    mysqli_query($config, "UPDATE shortcuts SET name='$name', target_url='$url', image_url='$imagePath1' WHERE shortcut_id=$id");

}

mysqli_query($config, "UPDATE shortcuts SET name='$name', target_url='$url' WHERE shortcut_id=$id");
header('Location: ../short_cut.php');
?>
