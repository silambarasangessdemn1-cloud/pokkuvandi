<?php
// Check if a value is passed
if (isset($_POST['Add_main_cate'])) {
    setcookie('main_category', $_POST['Add_main_cate'], time() + (86400 * 30), "/");  // Store for 30 days
}

if (isset($_POST['Add_sub_category'])) {
    setcookie('sub_category', $_POST['Add_sub_category'], time() + (86400 * 30), "/");  // Store for 30 days
}
?>
