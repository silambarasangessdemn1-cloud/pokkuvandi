<?php include('config/setup.php');
 
 $coupon_code=$_POST['coupon_code'];
 $pack_id=$_POST['pack_id'];
  $Add_amount=$_POST['Add_amount'];
 $Add_driver_name=$_POST['Add_driver_name'];
 $cus_id=$_POST['cus_id'];

 
//echo $query="select * from customer_master where Customer_Name ='$Add_driver_name'";
 $couponcustomer=mysqli_query($config,"select * from customer_master where Customer_Id ='$cus_id' ");
 $couponcustomer_=mysqli_fetch_object($couponcustomer);
 $customer_id=$couponcustomer_->Customer_Id;


$session__username;

//echo $query="select * from coupon where coupon_name ='$coupon_code' and status=0";

$coupon=mysqli_query($config,"select * from coupon where coupon_name ='$coupon_code' and status=0");
 $coupon_=mysqli_fetch_object($coupon);

  $coupon_type = $coupon_->coupon_type;

 $coupon_->coupon_name;
 $time_of_use=$coupon_->time_of_use; 
  $couponamount=$coupon_->amount;
 $coupon_->customer_id;
  $expiry_date=$coupon_->expiry_date;


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
?>
<?php 
if($coupon_!='')
{
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
         if (strtotime($current_date) > strtotime($expiry_date)) {
   
            echo "<p style='font-size: 14px;color: red;font-weight: 700;text-align: center;'>Coupon Date Expired</p>";
         }
         else
         {
            $data ='';
            $data .='<div class="form-group col-md-12" > <label for="email2">Less Amount</label>';
            $data .='<input type="text" class="form-control" id="less_amount" name="less_amount" value="'.$couponamount.'" readonly>';
            $data .='</div>'; 
            echo  $data;
            $data ='';
            $data .='<div class="form-group col-md-12" > <label for="email2">Net Amount</label>';
            $data .='<input type="text" class="form-control" id="net_amount" name="net_amount" value="'.$netamount.'" readonly>';
            $data .='</div>';    
            
            echo  $data;
            $data ='';
         
            $data .='<input type="hidden" class="form-control" id="coupon_type" name="coupon_type" value="'.$coupon_type.'" readonly>';
            $data .='</div>'; 

         echo  $data;
         echo "<script>
         var netamount = $netamount; // pass PHP variable into JavaScript
       
         var postBtnHtml = '';
         if (netamount == 0) {
           postBtnHtml = '<div class=\"form-group\"><button class=\"btn btn-success\" type=\"submit\" name=\"post_add\">Get Free registration</button></div>';
         } else {
           postBtnHtml = '<div class=\"form-group\"><button class=\"btn btn-success\" type=\"submit\" name=\"post_add\">Pay For registration</button></div>';
         }
       
         document.getElementById('post_btn').innerHTML = postBtnHtml;
        

       </script>";
         
         }
      }


   }
   else 
   {
      $coupon=mysqli_query($config,"select * from coupon where coupon_name ='$coupon_code' and customer_id='$customer_id' and status=0");
      $coupon__=mysqli_fetch_object($coupon);
      if ($coupon__) {

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
   echo "<p style='font-size: 14px;color: red;font-weight: 700;text-align: center;'>Coupon Date Expired</p>";
   }
  
   }
   else
   {
      echo "<p style='font-size: 14px;color: red;font-weight: 700;text-align: center;'>This Coupon Code Used More Then Times...</p> ";
   }


      } else
      {
        
         $data ='';
         $data .='<div class="form-group col-md-12" > <label for="email2">Less Amount</label>';
         $data .='<input type="text" class="form-control" id="less_amount" name="less_amount" value="'.$couponamount.'" readonly>';
         $data .='</div>'; 
         echo  $data;
         $data ='';
         $data .='<div class="form-group col-md-12" > <label for="email2">Net Amount</label>';
         $data .='<input type="text" class="form-control" id="net_amount" name="net_amount" value="'.$netamount.'" readonly>';
         $data .='</div>';
         echo  $data;
         $data ='';
   
         $data .='<input type="hidden" class="form-control" id="coupon_type" name="coupon_type" value="'.$coupon_type.'" readonly>';
         $data .='</div>'; 
   
        
      
      echo  $data;
      echo "<script>
      var netamount = $netamount; // pass PHP variable into JavaScript
    
      var postBtnHtml = '';
      if (netamount == 0) {
        postBtnHtml = '<div class=\"form-group\"><button class=\"btn btn-success\" type=\"submit\" name=\"post_add\">Get Free registration</button></div>';
      } else {
        postBtnHtml = '<div class=\"form-group\"><button class=\"btn btn-success\" type=\"submit\" name=\"post_add\">Pay For registration</button></div>';
      }
    
      document.getElementById('post_btn').innerHTML = postBtnHtml;
     

    </script>";

      }


   }

   
}
else
{
   echo "<p style='font-size: 14px;color: red;font-weight: 700;text-align: center;'>Invalied Coupon</p>";
}

?>
