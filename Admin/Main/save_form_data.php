<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['clear']) && $_POST['clear'] === 'true') {
        // Clear the session data
        unset($_SESSION['form_data']);
        echo 'Session data cleared';
        exit();
    }

    $field = $_POST['field'];
    $value = $_POST['value'];

    // Save the specific field data to the session
   echo  $_SESSION['form_data'][$field] = $value;

    echo 'Data saved';
}
?>
