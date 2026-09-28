<?php include('config/setup.php');

$id=$_POST['id'];

?>
<?php 


$data='';
$data .='<div class="form-group col-md-6" style="display:none"> <label for="email2">Package Days</label>';
   $shop_master_=mysqli_query($config,"select * from category_package where package_id ='$id' and status=1");
   while($sm_=mysqli_fetch_object($shop_master_))
   {
   $data .=' <input type="text" value="'.$sm_->package_valid.'" class="form-control" id="email2" name="Add_days" placeholder="amount" readonly>  ';
   }

$data .='</div>';

echo  $data;

$data='';
$data .='<div class="form-group col-md-6" > <label for="email2">Package Expiry Date</label>';
   $shop_master_=mysqli_query($config,"select * from category_package where package_id ='$id' and status=1");
   while($sm_=mysqli_fetch_object($shop_master_))
   {
      $package_valid = $sm_->package_valid;

      date_default_timezone_set('Asia/Kolkata'); 
       $Date = date("Y-m-d");
      $exp_date = date("d-m-Y", strtotime($Date . " +$package_valid days")); 

   $data .=' <input type="text" value="'.$exp_date.'" class="form-control" id="email2" name="Add_date" placeholder="amount" readonly>  ';
   }

$data .='</div>';

echo  $data;



$data='';
            $data .='<div class="form-group col-md-6" > <label for="email2">Package Amount</label>';
            
                $shop_master_=mysqli_query($config,"select * from category_package where package_id ='$id' and status=1");
                while($sm_=mysqli_fetch_object($shop_master_))
                {
                $data .=' <input type="text" value="'.$sm_->package_amount.'" class="form-control" id="Add_amount" name="Add_amount" placeholder="amount" readonly >  ';
                }
		
             $data .='</div>';

             echo  $data;


  




?>
