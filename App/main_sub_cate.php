<?php include('config/setup.php');

$id = $_POST['id'];

$data = '';

$data .= '<select required class="form-control" onchange="subcateg(this.value); setCookie(\'Add_sub_category\', this.value, 1);" name="Add_sub_category" id="Add_sub_cate_Name" ><option value="">---Select---</option>';

$shop_master_ = mysqli_query($config, "select * from sub_category where Main_Category='$id' and Sub_Category_Status=1");
while ($sm_ = mysqli_fetch_object($shop_master_)) {
    $data .= '<option value="'.$sm_->Sub_Category_id.'">'.$sm_->Sub_Category_Name.'</option>';
}

$data .= '</select>';

echo $data;
?>
