<?php
include(__DIR__ . '/../../config/setup.php');

if(isset($_POST['signup_message_add'])) {
    $title = mysqli_real_escape_string($config, trim($_POST['title']));
    $content = mysqli_real_escape_string($config, trim($_POST['content']));
    $status = isset($_POST['status']) ? intval($_POST['status']) : 1;

    $query = mysqli_query($config, "INSERT INTO signup_messages (title, content, status) VALUES ('$title', '$content', '$status')");

    if($query == false) {
        echo "<script>window.location.href='../signup_messages.php?erro=0';</script>";
    } else {
        echo "<script>window.location.href='../signup_messages.php?msg=100';</script>";
    }
} else {
    echo "<script>window.location.href='../signup_messages.php';</script>";
}
?>
