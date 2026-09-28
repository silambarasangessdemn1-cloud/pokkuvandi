<?php include('config/setup.php')?>
<?php include('session.php');
 
	?>

<?php
 
$id = $_REQUEST['option'];
 
 
$prpo=mysqli_query($config,"select Product_price,Product_Type_number,Product_type,Shelling_price,Product_id from product_price_master where Product_status=1 and Product_price_id='$id' ");
            $prto=mysqli_fetch_array($prpo);
            
                  $ptt=$prto[1].$prto[2];
				$offeprice=mysqli_query($config," select * from offer_master where offer_Product_id='".$prto[4]."' and offer_quality='$ptt' and Offer_Status=1 and  Offer_upto >='".date('Y-m-d')."'");
		$op=mysqli_fetch_object($offeprice);
		
			$ooffeprice=mysqli_query($config," select * from product_master where Product_id='".$prto[4]."'");
		$oop=mysqli_fetch_object($ooffeprice);
		
		
		
			$ppo=mysqli_num_rows($offeprice);
			if($ppo > 0 && $oop->Product_offer==1 )
			{       
            
                echo " <h6 style=' margin-top: -20px;' id='txtHint'><span style='color:red;'><strike> Rs.".$op->Product_price. "</strike></span>&nbsp;Rs.".$op->offer_price." &nbsp;  <span style='color:green;'>".$op->offer_quality."</span><span class='badge m-3 badge-danger'>" . $op->Offer_percent. "%</span></h6>";

            
			}else{
			    
			     echo " <h6 style=' margin-top: -20px;' id='txtHint'><span style='color:red;'><strike> Rs.".$prto[0]. "</strike></span>&nbsp;Rs.".$prto[3]." &nbsp;  <span style='color:green;'>".$prto[1].$prto[2]."</span></h6>";
   
			    
			    
			    
			}
 
?>