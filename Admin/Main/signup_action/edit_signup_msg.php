<?php 
include(__DIR__ . '/../../config/setup.php');

if(isset($_POST['Lee_signup_edit'])) {
    $content = mysqli_real_escape_string($config, $_POST['name_signup']);
    $edit_id = isset($_POST['Edit_signup_id']) ? intval($_POST['Edit_signup_id']) : 1;

    // Check if row exists in signup_messages
    $check = mysqli_query($config, "SELECT id FROM signup_messages WHERE id='$edit_id'");
    if(mysqli_num_rows($check) > 0) {
        $update = mysqli_query($config, "UPDATE signup_messages SET content='$content' WHERE id='$edit_id'");
    } else {
        $update = mysqli_query($config, "INSERT INTO signup_messages (id, title, content, status) VALUES ('$edit_id', 'Sign Up Message', '$content', 1)");
    }

    if($update == false) {
        $error = mysqli_real_escape_string($config, mysqli_error($config));
        echo "<script>window.location.href='../signup_messages.php?erro=0&msg=$error';</script>";
    } else {
        echo "<script>window.location.href='../signup_messages.php?mes=0';</script>";
    }
} else {
    echo "<script>window.location.href='../signup_messages.php';</script>";
}
?>
