<?php
include('config/setup.php');

if (isset($_POST['main_cat_id'])) {
    $main_cat_id = intval($_POST['main_cat_id']);

    $result = mysqli_query($config, "SELECT * FROM sub_category WHERE Main_Category = '$main_cat_id' AND Sub_Category_Status = 1  AND live_mode = 1");

    echo '<select required class="form-control" name="Add_sub_category" id="Add_sub_cate_Name">';
    echo '<option value="">---Select---</option>';

    while ($row = mysqli_fetch_object($result)) {
        echo '<option 
                value="' . $row->Sub_Category_id . '" 
                data-base="' . $row->base_price . '" 
                data-rate="' . $row->km_rate . '">'
                . $row->Sub_Category_Name .
             '</option>';
    }

    echo '</select>';
}
?>
