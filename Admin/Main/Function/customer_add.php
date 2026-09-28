<?php include('../../config/setup.php'); ?>

<?php
if (isset($_POST['customer_add'])) {

    date_default_timezone_set('Asia/Kolkata'); // Set the timezone to IST
    $editon = date('Y-m-d h:i:sa'); // Get the current date and time in the desired format

    $password = stripslashes($_POST['password']);
    $EncryptPassword = md5($password);

    $insert_sql = "INSERT INTO customer_master (
        Customer_Name, 
        Customer_Fathername, 
        Customer_DOB, 
        Customer_Address, 
        Add_city, 
        Add_area, 
        Customer_Phone_No, 
        Customer_Mail_id, 
        Customer_Password, 
        customer_active_status, 
        Customer_Registred_on,
        state_id
    ) VALUES (
        '" . mysqli_real_escape_string($config, $_POST['customer_name']) . "',
        '" . mysqli_real_escape_string($config, $_POST['father_name']) . "',
        '" . mysqli_real_escape_string($config, $_POST['dob']) . "',
        '" . mysqli_real_escape_string($config, $_POST['address']) . "',
        '" . mysqli_real_escape_string($config, $_POST['Add_city']) . "',
        '" . mysqli_real_escape_string($config, $_POST['Add_area']) . "',
        '" . mysqli_real_escape_string($config, $_POST['phone_no']) . "',
        '" . mysqli_real_escape_string($config, $_POST['mail_id']) . "',
        '$EncryptPassword',
        '" . mysqli_real_escape_string($config, $_POST['customer_active_status']) . "',
        '$editon',
        '" . mysqli_real_escape_string($config, $_POST['state']) . "'
    )";

    // Execute the query
    if (mysqli_query($config, $insert_sql)) {
        echo "<script>window.location.href='../Customer_Master.php?msg=100';</script>";
    } else {
        echo "<script>window.location.href='../Customer_Master.php?erro=0';</script>";
        echo "Error: " . mysqli_error($config);
    }
}
?>
