<?php include('../../config/setup.php')?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php 
            
            $leename=mysqli_query($config,"select Name,Name_status from lee_master");
            while($lee=mysqli_fetch_array($leename))
            {
                 $namestatus=$lee[1];
if($namestatus == 1)
{
    echo  $lee[0];
}else{
    echo "Need Name";

}

            }
            
            ?></title>
    <link rel="stylesheet" href="style.css" media="all" />
  </head>
  <body >
    <header class="clearfix">
      <div id="logo" style="margin-top: -2%;">
      <img src="<?php 
            
            $inro_logo=mysqli_query($config,"select Logo_Path,logo_status from lee_master");
            while($logo=mysqli_fetch_array($inro_logo))
            {
                 $logstatus=$logo[1];
if($logstatus == 1)
{
 $ms=substr($logo[0],6);
				  echo  $logo[0];
				 
}else{
    echo "../photos/logo/no_logo.png";

}

            }
            
            ?>">
      </div>
      <div class="invoice_head" style="border-bottom-style: solid;margin-top: -20px;border-width: thin;
   
">
	  
	<center>  <h1><?php 
            
            $leename=mysqli_query($config,"select Name,Name_status from lee_master");
            while($lee=mysqli_fetch_array($leename))
            {
                 $namestatus=$lee[1];
if($namestatus == 1)
{
    echo  $lee[0];
}else{
    echo "Need Name";

}

            }
            
            ?></h1></center>
			 
			
			
			   
       <?php 
            
            $Addressmaster=mysqli_query($config,"select * from lee_master");
            while($am=mysqli_fetch_object($Addressmaster))
            {?>
	   <div style="text-align: center;
    font-size: small;    margin-top: -11px; margin-bottom: 6px;
">Address : <?php echo $am->Address;?>,<?php echo $am->Location;?> </br></br>
       Tel: <?php echo $am->Contact_Number;?> / Website: <?php echo $am->website; ?> / GST No : <?php echo $am->GST_No;?>
       
       </div>
       
			<?php } ?>


	 
			
			
			
			</div>
    
      <div id="project">
	    <h3 style="    padding-left: 10px;">Bill No &nbsp;&nbsp;&nbsp;&nbsp;: INVWT_ <?php
		
		  $innum=mysqli_query($config,"select Order_id from order_master where order_customer_track_id='".$_GET['orderid']."' order by Order_id  DESC LIMIT 1");
           $inn=mysqli_fetch_object($innum);
           
		echo $inn->Order_id;
			
		
		?></h3>
		
		
		
		
		
		
		
		
		
		
		
     <?php 
            
            $toaddress=mysqli_query($config,"select * from order_checkout where order_customer_track_id='".$_GET['orderid']."'");
            while($toam=mysqli_fetch_object($toaddress))
            {
				
 $tocustomer=mysqli_query($config,"select * from customer_master where Customer_Id='".$toam->Customer_id."'");				
	$toc=mysqli_fetch_object($tocustomer);			
 $tocustomeraddress=mysqli_query($config,"select * from customer_addresss_master where Customet_id='".$toc->Customer_Id."'");				
	$tocadd=mysqli_fetch_object($tocustomeraddress);					
				
				?>   

	   <div><h3 style="    padding-left: 10px;"> NAME &nbsp;&nbsp;&nbsp;&nbsp;: <span style="font-size: small;color:black"> <?php echo $toc->Customer_Name; ?></span>
        </h3>
    
        <h3 style="padding-left: 10px;">Address :<small>
        <?php echo $tocadd->Complete_Address; ?></small>
        <br><small  style="margin-left:22%;"><?php echo $tocadd->Delivery_Landmark; ?></small>
        </small></h3>
  

    
	
	
	
	
		
		</div>
       
    
		
</div>

	
   <div id="company" class="clearfix">
         <div><h3 style="    padding-left: 10px;"> DATE :<span style="font-size: small;"> <?php   
		  
echo $newDate = date("d-m-Y");
		
		?></span>  </h3>
		
		 <?php 
            
            $Addressmaster=mysqli_query($config,"select * from lee_master");
            while($am=mysqli_fetch_object($Addressmaster))
            {?>
		
		
        <h3 style=" padding-left: 10px;">TIME  : <span style="font-size: small;"> <?php  date_default_timezone_set('Asia/Kolkata');
                                                             echo $paidon= date('H:i: a'); ?>
       </span>  </h3> <h3 style=" padding-left: 10px;">MOBILE NO :<span style="font-size: small;"> <?php echo $toc->Customer_Phone_No; ?></span>
         </h3>
		 
		
     
		
			<?php } ?>
		
		
		
		
		


	</div>
      </div>

	<?php } ?>

   </header>
  




  <main>
      <table>
        <thead>
          <tr>
            <th class="service">S.No</th>
            <th class="desc">PRODUCT</th>
             <th>TYPE</th>
			 <th>RATE</th>
             
             <th>QTY</th>
			<th>PRICE</th>
          
            <th>TAX</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>
          
		  
		  <?php 
		  $p=1;
		     $orderproduct=mysqli_query($config,"select * from order_master where order_customer_track_id='".$_GET['orderid']."'");
            while($op=mysqli_fetch_object($orderproduct))
            {
                $advance_pay=$op->advance_pay;
		  
		  
		  ?>
		
		
		  
		  <tr>
            <td class="service"><?php echo $p;?></td>
            <td class="desc"><?php echo $op->Productname;?></td>
            	   <td style="text-align: center;"><?php echo $op->order_product_type;?></td>
			  <td style="text-align: center;">Rs.<?php echo 	number_format($pri=$op->Order_product_price ,2);?></td>
		
			            <td style="text-align: center;"><?php echo $op->Ordered_quantity;?></td>
			          

            <td style="text-align: center;">Rs.
			
			
			
			<?php
			
	echo 	number_format($ptp[]=($pri) - ($op->Product_tax_amount * $op->Ordered_quantity),2);
			
			
			
			
			?>
			
			
			
			
			</td>
            <td style="text-align: center;"><?php 	echo $op->Product_tax?>% (<?php 
                    $ttc[]= $txt_=( $pri*$op->Product_tax )/100;
            
            echo number_format($txt_ * $op->Ordered_quantity,2);?>)	</td>
            
			
			
			
			
			
			
			<td style="text-align: center;">Rs.<?php  
//$opp=$op->Order_product_price;
			///$opq=$op->Ordered_quantity;
			 //$c=$opp * $opq;
			echo $tot= number_format($pty[]=$op->Order_product_price * $op->Ordered_quantity ,2);
			
			
			?></td>
          </tr>
           
         
		 
		 <?php $p++;} ?>
		 
		  <?php 
		 
		     $ordertotal=mysqli_query($config,"select * from order_checkout where order_customer_track_id='".$_GET['orderid']."'");
            while($oot=mysqli_fetch_object($ordertotal))
            {
		  
		  
		  
		  ?>
		

		 <tr>
            <td colspan="4">TOTAL</td>
            <td  style="text-align: center;"><?php echo $oot->Quantity; ?></td>
			
            <td  style="text-align: center;">Rs.<?php 
		
			
			echo number_format(array_sum($ptp) ,2);

			


			?></td>
            <td  style="text-align: center;">Rs.<?php echo number_format(array_sum($ttc),2); ?></td>
            <td  style="text-align: center;">Rs.<?php echo number_format(array_sum($pty),2) ; ?></td>
          </tr>
		 
		 
         
          
          <tr>
            <td colspan="7">CGST</td>
            <td  style="text-align: center;">Rs.<?php 
			$cg = $oot->Product_total_tax_amount; 
			echo number_format(array_sum($ttc)/2,2);
			
			
			?></td>
          </tr>
		   <tr>
            <td colspan="7">SGST</td>
            <td  style="text-align: center;">Rs.<?php 
			$cg = $oot->Product_total_tax_amount; 
			echo number_format(array_sum($ttc)/2,2);
			
			
			?></td>
          </tr><tr>
            <td colspan="7">DELIVERY CHARGE</td>
            <td  style="text-align: center;"><?php 
			  $cg = $oot->Delivery_charge; 
			if($cg =='')
			{
				echo "-";
			}else{
				
				echo  "(+) Rs. ".number_format($cg,2);
				
			}
			
			?></td>
          </tr><tr>
           
<?php 

if($oot->wallet_status == 'Applied')
			{

?>
<td colspan="7">WALLET AMOUNT</td>
            <td  style="text-align: center;"><?php 
			
			$wall= $oot->Wallet_Amount; 
			if($wall =='')
			{
				echo "-";
				
			}else{
			
			echo  "(-) Rs. ".number_format($wall,2);
			}
			
			
			?></td>
			
			<?php }else{?>
		   <td colspan="7">DISCOUNT</td>
            <td  style="text-align: center;"><?php 
			
			$dis= $oot->Discount_Offer_prce; 
			if($dis =='')
			{
				echo "-";
				
			}else{
			
			echo  "(-) Rs. ".number_format($dis,2);
			}
			
			
			}?></td>
			
			
			
			
			
			
          </tr>
		  
		  
		  
           
          
         
        <tr>
          <td colspan="7" style="text-transform: capitalize;">ADVANCE PAY</td>
            <td  style="text-align: center;"><?php if($advance_pay ==0)
            {
                echo '-';
            }else{
                echo '(-) Rs.'. number_format($advance_pay, 2); 
            }?>
			</td></tr> 
		  
            <tr>
		  
		  
		  
          <td colspan="7" class="grand total">GRAND TOTAL</td>
          
          <?php 

if($oot->wallet_status == 'Applied')
          {





?>
          
          
          <td style="text-align: center;">Rs.<?php 
          
          
          
          
          
          
          $wall= $oot->Grand_total - $oot->Wallet_Amount;
          
          if($wall < 0 )
          {
           $gto = $oot->Grand_total + $oot->Wallet_Amount ;
           
           echo number_format($gto, 2); 
           
          }else{
              
      echo	$gto1 = $oot->Grand_total ."( Wallet used )"; 

          
          }
          
          
          
          
          ?></td>
      
              <?php }else  if($oot->Promocode_status == 'Applied'  || $oot->Promocode_status == 'ProApplied')
          { 	?>

<td>
  
 

  
  <?php

          
      
          
           $ptotal=  $oot->Grand_total- $oot->Delivery_charge - $oot->Discount_Offer_prce;
          
          if( $ptotal <= 0)
          { ?>
          
          <del style="margin-right: 15px;">Rs.	<?php	echo  number_format($oot->Grand_total,2); ?> </del>
  
          
      
      
      <?php	}else{
              
                  echo  number_format($oot->Grand_total,2);
              
              
          }
           
  ?>
  
  
</td>
  <?php }else {?>









       <td style="text-align: center;">Rs.<?php echo   number_format($oot->Grand_total, 2); ?></td>
      
          <?php } ?>
      
      
      </tr>
		  
			<?php } ?>
        </tbody>
      </table></hr>
   

 <?php 
		 
		     $ordertotal=mysqli_query($config,"select * from order_checkout where order_customer_track_id='".$_GET['orderid']."'");
            while($oot=mysqli_fetch_object($ordertotal))
            {
		  
		  
		  
		  ?>

      <div id="project1" style="    margin-top: -21px;">
	    <h3 style="    padding-left: 10px;">Paid by :<span> <?php echo $oot->Payment_Mode; ?></span> </h3>
  	 <h3 style=" padding-left: 10px;">Paid Status :  <?php 

		  $paist= $oot->Paid_status; 
		   if(is_NULL($paist))
		   {
			   echo "Not Paid";
		   }else{
			   
			    $a=$paist;
				if($a==1)
				{
					echo "Paid";
				}else{
					
					echo  $a;
				}
				
				
				
		   }
		   
		   
		   ?>
         </h3>
</div>

	
   <div id="company1" style="    margin-top: -21px;" class="clearfix">
         <div>
		
		<?php 

if($oot->wallet_status == 'Applied')
			{





?>


<h3 style=" padding-left: 10px;">Paid Amount  :Rs. <span> 
         

<?php 
            
			
			
			
			
			
		$wall= $oot->Grand_total - $oot->Wallet_Amount;
			
			if($wall < 0 )
			{
			 $gto = $oot->Grand_total + $oot->Wallet_Amount ;
			 
			 echo number_format($gto, 2); 
			 
			}else{
				
		echo	$gto1 = $oot->Grand_total ."( Wallet used )"; 

			
			}
			 ?>
			
			</span> </h3>
			
			
			
		<?php	}else  if($oot->Promocode_status == 'Applied'  || $oot->Promocode_status == 'ProApplied') 
			{ 		
			?>
			
			
			
			   
    <?php
  
			
		
			
			 $ptotal=  $oot->Grand_total- $oot->Delivery_charge - $oot->Discount_Offer_prce;
			
			if( $ptotal <= 0)
			{ ?>
			
		<h3 style=" padding-left: 10px;">Paid Amount  : 	<del style="margin-right: 15px;">Rs.	<?php	echo  number_format($oot->Grand_total,2); ?> </del></h3>
	
			
		
		
		<?php	}else{?>
			    
		<h3 style=" padding-left: 10px;">Paid Amount  :Rs.	<span><?php echo  number_format($oot->Grand_total,2); ?> </span> </h3>
			    
			    
<?php			}
			 
    ?>	
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
	<?php		}else{	
			?>
		
        <h3 style=" padding-left: 10px;">Paid Amount  :Rs. <span><?php echo  number_format($oot->Grand_total - $advance_pay,2) ; ?> </span> </h3>
         


<?php } ?>



	</div>
      </div>  <div id="project2"  class="clearfix" style="    width: 793px;">
         <div>
		
        <h3 style=" padding-left: 10px;">Amount  :  <?php
$class_obj = new numbertowordconvertsconver();
$convert_number =  number_format($oot->Grand_total, 2);
echo $class_obj->convert_number($convert_number)." Rupees";
?> </h3>
         

	</div>
      </div>

			<?php } ?>



	 


</br></br></br></br></br></br>



	 <div id="notices" style=" padding-left: 10px;">
        
		
		
		<div style=" margin-top: 33px;"><b>NOTICE:</b></div>
        <div class="notice">This is a computer generated receipt so no need a signature</div>
        <div class="notice">Terms and Condition as Displayed in Store at the time of Purchase</div>
		
	<h3 style="text-align: right;
    margin-right: 104px;
">Thank You for Purchase</h3>
		<center>	<button onclick="window.print()">Print this Invoice</button> <a href="../invoice.php" class="btn btn-danger">Back</a>  </center>
      </div>
	  
	  
	  
	  
	  
    </main>
   <!-- <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>-->
	
	<?php
class numbertowordconvertsconver {
    function convert_number($number) 
    {
        if (($number < 0) || ($number > 999999999)) 
        {
            throw new Exception("Number is out of range");
        }
        $giga = floor($number / 1000000);
        // Millions (giga)
        $number -= $giga * 1000000;
        $kilo = floor($number / 1000);
        // Thousands (kilo)
        $number -= $kilo * 1000;
        $hecto = floor($number / 100);
        // Hundreds (hecto)
        $number -= $hecto * 100;
        $deca = floor($number / 10);
        // Tens (deca)
        $n = $number % 10;
        // Ones
        $result = "";
        if ($giga) 
        {
            $result .= $this->convert_number($giga) .  "Million";
        }
        if ($kilo) 
        {
            $result .= (empty($result) ? "" : " ") .$this->convert_number($kilo) . " Thousand";
        }
        if ($hecto) 
        {
            $result .= (empty($result) ? "" : " ") .$this->convert_number($hecto) . " Hundred";
        }
        $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
        $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");
        if ($deca || $n) {
            if (!empty($result)) 
            {
                $result .= " and ";
            }
            if ($deca < 2) 
            {
                $result .= $ones[$deca * 10 + $n];
            } else {
                $result .= $tens[$deca];
                if ($n) 
                {
                    $result .= "-" . $ones[$n];
                }
            }
        }
        if (empty($result)) 
        {
            $result = "zero";
        }
        return $result;
    }
}
?>
	
	
	
	
  </body>
</html>


<style>
    #company {
    float: right;
    text-align: left;
    border-style: solid;
    border-top: thin;
    width: 220px;
    border-right: thin;
    border-width: thin;
    border-left: 1px solid;
    margin-top: -110px;
    border-bottom: thin;
}
</style>