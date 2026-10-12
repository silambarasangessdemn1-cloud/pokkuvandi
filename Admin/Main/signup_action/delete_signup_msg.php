<?php
include(__DIR__ . '/../../config/setup.php');

if(isset($_GET['delid']) && isset($_GET['delcat']) && $_GET['delcat'] == 100) {
    $id = intval($_GET['delid']);

    $query = mysqli_query($config, "DELETE FROM signup_messages WHERE id='$id'");

    if($query == false) {
        echo "<script>window.location.href='../signup_messages.php?erro=0';</script>";
    } else {
        echo "<script>window.location.href='../signup_messages.php?delmsg=101';</script>";
    }
} else {
    echo "<script>window.location.href='../signup_messages.php';</script>";
}
?>
