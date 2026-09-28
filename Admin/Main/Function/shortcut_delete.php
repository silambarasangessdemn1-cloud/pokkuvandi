<?php
include('../../config/setup.php');

$id = $_GET['id'];
mysqli_query($config, "DELETE FROM shortcuts WHERE shortcut_id = $id");
header('Location: ../short_cut.php');
?>
