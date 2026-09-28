<?php include('../config/setup.php');

$pack_id = $_POST['pack_id'];
$Add_amount = $_POST['Add_amount'];
$coupon_code = trim($_POST['coupon_code']);
$Add_driver_name = $_POST['Add_driver_name'];
$customerid = $_POST['customerid'];

// Secure user inputs
$coupon_code = mysqli_real_escape_string($config, $coupon_code);
$Add_driver_name = mysqli_real_escape_string($config, $Add_driver_name);


// Fetch Coupon Details
$coupon_query = "SELECT * FROM coupon WHERE coupon_name = '$coupon_code' AND status = 0";
$coupon = mysqli_query($config, $coupon_query);

// Check if query executed properly

// Check if coupon exists
// if (mysqli_num_rows($coupon) == 0) {
//     echo "<p style='font-size: 14px;color: red;font-weight: 700;text-align: center;'>Invalied Coupon</p>";

// }

$coupon_ = mysqli_fetch_object($coupon);


// Assign values
$coupon_type = $coupon_->coupon_type;
$time_of_use = $coupon_->time_of_use;
$couponamount = $coupon_->amount;
$coupon_customer_id = $coupon_->customer_id;
$expiry_date = $coupon_->expiry_date;

// Calculation
$netamount = ($Add_amount > $couponamount) ? 0 : ($Add_amount - $couponamount);

// Set timezone
date_default_timezone_set('Asia/Kolkata');
$current_date = date("Y-m-d");

// Check if coupon is valid
if ($coupon_) {
   if($coupon_type == '1')
   {
     //echo $query="select count(*) as total from create_post where discount_name ='$coupon_code' and coupon_type='$coupon_type' and customer_id='$customer_id'";
      $post=mysqli_query($config,"select * from create_post where discount_name ='$coupon_code' and coupon_type='$coupon_type' and customer_id='$customer_id' ");
      $post__=mysqli_fetch_object($post);
  $rowcount=mysqli_num_rows($post);
//   $row = mysql_fetch_array($result);
 //echo  $rowcount;
      if($time_of_use == $rowcount)
      {         
         echo "<p style='font-size: 14px;color: red;font-weight: 700;text-align: center;'>Cross Your Limits</p>";
      }
      else
      {
         if($current_date > $expiry_date)
         {
            echo "<p style='font-size: 14px;color: red;font-weight: 700;text-align: center;'>Coupon will be expired</p>";
         }
         else
         {
            $data ='';
            $data .='<div class="form-group col-md-6" > <label for="email2">Less Amount</label>';
            $data .='<input type="text" class="form-control" id="less_amount" name="less_amount" value="'.$couponamount.'" readonly>';
            $data .='</div>'; 
            echo  $data;
            $data ='';
            $data .='<div class="form-group col-md-6" > <label for="email2">Net Amount</label>';
            $data .='<input type="text" class="form-control" id="net_amount" name="net_amount" value="'.$netamount.'" readonly>';
            $data .='</div>';    
            
            echo  $data;
            $data ='';
         
            $data .='<input type="hidden" class="form-control" id="coupon_type" name="coupon_type" value="'.$coupon_type.'" readonly>';
            $data .='</div>'; 

         echo  $data;

         }
      }


   }
   else 
   {
      
      $coupon=mysqli_query($config,"select * from coupon where coupon_name ='$coupon_code' and customer_id='$customer_id' and status=0");
      $coupon__=mysqli_fetch_object($coupon);

      $coupon_type = $coupon__->coupon_type;
      $coupon__->coupon_name;
      $time_of_use=$coupon__->time_of_use; 
      $couponamount=$coupon__->amount;
      $coupon__->customer_id;
      $expiry_date=$coupon__->expiry_date;
      //$netamount=$Add_amount - $couponamount ;
      $coupon_type=$coupon__->coupon_type;


      if($couponamount > $Add_amount)
      {
         $netamount=0;
      }
      else
      {
         $netamount=$Add_amount - $couponamount ;
      }
      
      date_default_timezone_set('Asia/Kolkata'); 
      $current_date=date("Y-m-d ");

      if($time_of_use > 0)
      {
   if($current_date > $expiry_date)
   {
   echo "<p style='font-size: 14px;color: red;font-weight: 700;text-align: center;'>Coupon will be expired</p>";
   }
   else
   {
     
      $data ='';
      $data .='<div class="form-group col-md-6" > <label for="email2">Less Amount</label>';
      $data .='<input type="text" class="form-control" id="less_amount" name="less_amount" value="'.$couponamount.'" readonly>';
      $data .='</div>'; 
      echo  $data;
      $data ='';
      $data .='<div class="form-group col-md-6" > <label for="email2">Net Amount</label>';
      $data .='<input type="text" class="form-control" id="net_amount" name="net_amount" value="'.$netamount.'" readonly>';
      $data .='</div>';
      echo  $data;
      $data ='';

      $data .='<input type="hidden" class="form-control" id="coupon_type" name="coupon_type" value="'.$coupon_type.'" readonly>';
      $data .='</div>'; 

     
   
   echo  $data;
   }
   }
   else
   {
      echo "<p style='font-size: 14px;color: red;font-weight: 700;text-align: center;'>This Coupon Code Used More Then Times...</p> ";
   }

   }

   
}
else
{
   echo "<p style='font-size: 14px;color: red;font-weight: 700;text-align: center;'>Invalied Coupon</p>";
}

?>
