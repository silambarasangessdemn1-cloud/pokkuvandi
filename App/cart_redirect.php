<?php include('config/setup.php')?>
<?php include('session.php');?>

<?php

if(isset($_POST['add_to_cart']))
{
	
			date_default_timezone_set('Asia/Kolkata');
	 	 
	 	$a=$_POST['quantity'];
 	   $b=$_POST['protype'];
		
		$dat=date('d');	
		 $tim=date('h');
		 
		 $cp=$_POST['cart_product'];
		 $track_id= $session_id.$dat.$tim;
		$cartadd=date('Y-m-d');
		
	       $prpo=mysqli_query($config,"select Product_price,Product_Type_number,Product_type,Shelling_price,Product_id from product_price_master where Product_status=1 and Product_price_id='$b' ");
            $prto=mysqli_fetch_array($prpo);
			
			
			 $ptt=$prto[1].$prto[2];
				$offeprice=mysqli_query($config," select * from offer_master where offer_Product_id='".$_POST['cart_product']."' and offer_quality='$ptt' and Offer_Status=1 and  Offer_upto >='".date('Y-m-d')."'");
		$op=mysqli_fetch_object($offeprice);
			$ooffeprice=mysqli_query($config," select * from product_master where Product_id='".$prto[4]."'");
		$oop=mysqli_fetch_object($ooffeprice);
		
		
		
			$ppo=mysqli_num_rows($offeprice);
			if($ppo > 0 && $oop->Product_offer==1 )
			{       
            
			 $price = $a * $op->offer_price;
		$pro_sel=mysqli_query($config," select * from product_master where Product_id='".$_POST['cart_product']."'");
		$ps=mysqli_fetch_object($pro_sel);
		
	                $tax_amount =  $op->offer_price * $_POST['order_pro_tax'] / (100 + $_POST['order_pro_tax']);
							
							
		//$tax_amount = (($prto[3] * $_POST['order_pro_tax'] )/100);
		$total_tx= $tax_amount * $a;
	echo 	$check_sql="SELECT * FROM `order_master` WHERE `Order_product`='".$_POST['cart_product']."' Customer_id='$session_id' ";
	
	$cart_add=mysqli_query($config,"insert into order_master(Order_Main_Category,Order_Sub_category,Order_product,Order_Price,Ordered_quantity,Customer_id,Order_product_price,order_customer_track_id,Order_on,Order_type_quantity,Order_status,Productname,Product_tax,Product_tax_amount,Product_total_tax_amount,cart_track_id,order_product_type)
	                          values('".$ps->Main_Category."','".$ps->Sub_Categoryid."','".$_POST['cart_product']."','$price','".$_POST['quantity']."','$session_id','". $op->offer_price."','$track_id','$cartadd','". $op->offer_price."','Cart','".$ps->Product_Name."','".$_POST['cart_product_tax']."','$tax_amount','$total_tx','$track_id','".$prto[1].$prto[2]."')");
	header('location:cart.php?gemsg=1000');
	
	
	
			}else{
				
				
				
		 $price=$a*$prto[3];
		$pro_sel=mysqli_query($config," select * from product_master where Product_id='".$_POST['cart_product']."'");
		$ps=mysqli_fetch_object($pro_sel);


	           

		echo $check_sql="SELECT *  FROM order_master WHERE Order_product='".$_POST['cart_product']."' and  Customer_id='$session_id' ";
			
		 	$cart=mysqli_query($config,$check_sql);
		 $qty=mysqli_fetch_object($cart);
	 	$pr= $qty->Order_product;
	
			if($pr)
			{
			  
			    $p_qty=$qty->Ordered_quantity;
			   $product_qty=(($_POST['quantity']) + ($p_qty));
			   
			      $Product_total_tax_amount= ($qty->Product_tax_amount) * ($product_qty);
			  $order_price=(($qty->Order_product_price) * ($product_qty));
			 echo    $p_qty="UPDATE order_master SET Ordered_quantity=' $product_qty', Order_price=' $order_price' , Product_total_tax_amount='$Product_total_tax_amount' WHERE Customer_id='$session_id' and Order_product='".$_POST['cart_product']."'  ";
			   	$cart_=mysqli_query($config,$p_qty);
			   	
			   	
			     	header('location:cart.php?gemsg=1000');	

			}else{
			
		
     $tax_amount = $prto[3] * $ps->product_tax / (100 + $ps->product_tax);
							
							
		//$tax_amount = (($prto[3] * $_POST['order_pro_tax'] )/100);
	 	$total_tx= $tax_amount * $a;
		 if($c_memeber_id != 0){
			$prto[3]=($prto[3] - $offpri=round((($prto[3] /100)*$c_memeber_off)));
		$price=$prto[3]*$a;
		}
		
	$cart_add=mysqli_query($config,"insert into order_master(Order_Main_Category,Order_Sub_category,Order_product,Order_Price,Ordered_quantity,Customer_id,Order_product_price,order_customer_track_id,Order_on,Order_type_quantity,Order_status,Productname,Product_tax,Product_tax_amount,Product_total_tax_amount,cart_track_id,order_product_type)
	                          values('".$ps->Main_Category."','".$ps->Sub_Categoryid."','".$_POST['cart_product']."','$price','".$_POST['quantity']."','$session_id','".$prto[3]."','$track_id','$cartadd','".$prto[3]."','Cart','".$ps->Product_Name."','".$_POST['cart_product_tax']."','$tax_amount','$total_tx','$track_id','".$prto[1].$prto[2]."')");
	header('location:cart.php?gemsg=1000');	
				
			}	
						
				
				
				
				
			}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}



?>