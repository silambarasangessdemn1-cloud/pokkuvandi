<?php include('config/setup.php');

$id=$_POST['id'];

?>
<?php 
$data='';

$data .='<select required class="form-control" name="Add_package" id="Add_package" onchange="package(this.value);" ><option  value="">---Select---</option>';

                $shop_master_=mysqli_query($config,"select * from category_package where Main_Category_id ='$id' and status=1");
                while($sm_=mysqli_fetch_object($shop_master_))
                {
                $data .='<option  value="'.$sm_->package_id.'">'.$sm_->package_title.'</option>';
                }
		
             $data .='</select>';

             echo  $data;

?>
