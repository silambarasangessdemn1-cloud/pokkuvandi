<?php include('../config/setup.php');?>

<?php

if(isset($_POST['state_id'])) {
    $state_id = $_POST['state_id'];
    $district_query = mysqli_query($config, "SELECT * FROM dir_city_master WHERE state_id = '$state_id'");

    echo '<option value="">---SELECT---</option>';
    while($district = mysqli_fetch_object($district_query)) {
        echo "<option value='{$district->dir_city_id}'>{$district->dir_city_name}</option>";
    }
}
?>
