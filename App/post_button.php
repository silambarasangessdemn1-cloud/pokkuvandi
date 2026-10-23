<?php include('config/setup.php');

$id = isset($_POST['id']) ? mysqli_real_escape_string($config, $_POST['id']) : '';

$data = '';
$data .= '<div class="form-group" style="width: 100%; display: flex; justify-content: flex-end; margin-top: 15px; margin-bottom: 85px;">';

$found = false;
if (!empty($id)) {
    $shop_master_ = mysqli_query($config, "SELECT * FROM category_package WHERE package_id = '$id' AND status = 1");
    if ($shop_master_ && mysqli_num_rows($shop_master_) > 0) {
        while ($sm_ = mysqli_fetch_object($shop_master_)) {
            $found = true;
            $package_amount = $sm_->package_amount;
            if ($package_amount == '0') {
                $data .= ' <button class="btn btn-success btn-lg" type="submit" id="post_submit" name="post_add" style="padding: 10px 24px; font-weight: bold; border-radius: 8px;">Get Free registration</button> ';
            } else {
                $data .= ' <button class="btn btn-success btn-lg" type="submit" id="post_submit" name="post_add" style="padding: 10px 24px; font-weight: bold; border-radius: 8px;">Pay For registration</button> ';
            }
        }
    }
}

if (!$found) {
    $data .= ' <button class="btn btn-success btn-lg" type="submit" id="post_submit" name="post_add" style="padding: 10px 24px; font-weight: bold; border-radius: 8px;">Pay For registration</button> ';
}

$data .= '</div>';

echo $data;

?>
