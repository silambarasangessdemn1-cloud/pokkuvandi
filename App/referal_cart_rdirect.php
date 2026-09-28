<?php include('config/setup.php')?>
<?php include('session.php');?>

<?php

if(isset($_GET['add_to_cart']))
{
	
			
	 	 
	 	$a=$_GET['quantity'];
 	   $b=$_GET['protype'];
		
	 $dat=date('d');	
	 $tim=date('h');
		 $cp=$_GET['cart_product'];
		$track_id= $session_id.$dat.$tim;
		$cartadd=date('Y-m-d');
		
		  $prpo=mysqli_query($config,"select Product_price,Product_Type_number,Product_type,Shelling_price,Product_id from product_price_master where Product_status=1 and Product_price_id='$b' ");
            $prto=mysqli_fetch_array($prpo);
	

		
			$ptt=$prto[1].$prto[2];
				$offeprice=mysqli_query($config," select * from offer_master where offer_Product_id='".$_GET['cart_product']."' and offer_quality='$ptt' and Offer_Status=1 and  Offer_upto >='".date('Y-m-d')."'");
	
		$op=mysqli_fetch_object($offeprice);
			
			$ppo=mysqli_num_rows($offeprice);
		
			if($ppo > 0)
			{
			$price=$a * $op->offer_price;
		$pro_sel=mysqli_query($config," select * from product_master where Product_id='".$_GET['cart_product']."'");
		$ps=mysqli_fetch_object($pro_sel);
		
	                $tax_amount =  $op->offer_price * $_GET['cart_product_tax'] / (100 + $_GET['cart_product_tax']);
							
							
		//$tax_amount = (($prto[3] * $_GET['cart_product_tax'] )/100);
		$total_tx= $tax_amount * $a;
		
	$cart_add=mysqli_query($config,"insert into order_master(Order_Main_Category,Order_Sub_category,Order_product,Order_Price,Ordered_quantity,Customer_id,Order_product_price,order_customer_track_id,Order_on,Order_type_quantity,Order_status,Referral_code,Refered_customer_id,Productname,Product_tax,Product_tax_amount,Product_total_tax_amount,cart_track_id,order_product_type)
  values('".$ps->Main_Category."','".$ps->Sub_Categoryid."','".$_GET['cart_product']."','$price','".$_GET['quantity']."','$session_id','".$op->offer_price."','$track_id','$cartadd','".$op->offer_price."','Cart','".$_GET['ref_product_code']."','".$_GET['ref_product_client']."','".$ps->Product_Name."','".$_GET['cart_product_tax']."','$tax_amount','$total_tx','$track_id','".$prto[1].$prto[2]."')");
							  
							  
							  
header('location:cart.php?gemsg=1000');
	
	
	
			}else{
		
		$price=$a*$prto[3];
		$pro_sel=mysqli_query($config," select * from product_master where Product_id='".$_GET['cart_product']."'");
		$ps=mysqli_fetch_object($pro_sel);
		  $tax_amount = $prto[3] * $_POST['cart_product_tax'] / (100 + $_POST['cart_product_tax']);
			//$tax_amount = (($prto[3] * $_POST['cart_product_tax'] )/100);
		$total_tx= $tax_amount * $a;
		
		
	$cart_add=mysqli_query($config,"insert into order_master(Order_Main_Category,Order_Sub_category,Order_product,Order_Price,Ordered_quantity,Customer_id,Order_product_price,order_customer_track_id,Order_on,Order_type_quantity,Order_status,Referral_code,Refered_customer_id,Productname,Product_tax,Product_tax_amount,Product_total_tax_amount,cart_track_id,order_product_type)
  values('".$ps->Main_Category."','".$ps->Sub_Categoryid."','".$_GET['cart_product']."','$price','".$_GET['quantity']."','$session_id','".$prto[3]."','$track_id','$cartadd','".$prto[3]."','Cart','".$_GET['ref_product_code']."','".$_GET['ref_product_client']."','".$ps->Product_Name."','".$_POST['cart_product_tax']."','$tax_amount','$total_tx','$track_id','".$prto[1].$prto[2]."')");
	
			
	 

	
	
	
	
	
	
	
	
	
	
	header('location:cart.php?gemsg=1000');
	
	
}}



?>