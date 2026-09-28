<?php include('config/setup.php')?>

<?php include('session.php');?>	

<!DOCTYPE html>

<html>

<head>

<title>Online Payment</title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

</head>

<body class="">

	
<?php 


?>
	<br><br><br><br>

	<article class="bg-secondary mb-3">  

	<div class="card-body text-center">

	<h4 class="text-white">Thank you for payment<br></h4>

	<?php



		
		 

		



			 $user=$_GET['sessionid'];
	



 $membersql="SELECT * FROM `membership_list` where user_id='$user'";

$memberresult = mysqli_query($config, $membersql);

$memberdetails1 = mysqli_fetch_object($memberresult);



 $meid=$memberdetails1->member_referraid;

 $date_now5 = new DateTime();

 $date5   = new DateTime($memberdetails1->ex_date);

 if ($date_now5 > $date5) {

    

}else{

 

 $pid=$memberdetails1->membership_plan_id;

  $plansql="SELECT * FROM `membership` where mid='$pid'";

$result = mysqli_query($config, $plansql);

 $row = mysqli_fetch_object($result);

$planprice=$_GET['gtotal'];

$level1_com= $row->purchase_1;

$level2_com= $row->purchase_2;

$date=date("d-m-Y");

 $com1=(($planprice * $level1_com)/100);

 $com2=(($planprice * $level2_com)/100);

$membersql1="SELECT * FROM `membership_list` where memeber_id='$meid'";

$memberresult1 = mysqli_query($config, $membersql1);

$memberdetails = mysqli_fetch_object($memberresult1);

$memberdetail_id= $memberdetails->memeber_id;

$memberdetail_user_id= $memberdetails->user_id;

 $member_referraid= $memberdetails->member_referraid;

 $date_now = new DateTime();

 $date2    = new DateTime($memberdetails->ex_date);

 if ($date_now > $date2) {

    

}else{

    $membershipsql = "INSERT INTO purchas_wallet (member_id,user_id,amount,comm_member_id,purchase_date,purchase_comm_type)

    VALUES ('$memberdetail_id', '$memberdetail_user_id', '$com1','$user','$date','purchase commission')";

    

             mysqli_query($config, $membershipsql);

          $l1walletsql = "UPDATE customer_master SET Customer_Wallet=Customer_Wallet+$com1 WHERE Customer_Id='$memberdetail_user_id'";



            mysqli_query($config,$l1walletsql);

}





    

    $membersql3="SELECT * FROM `membership_list` where memeber_id='$member_referraid'";

    $memberresult3 = mysqli_query($config, $membersql3);

    $memberdetails3 = mysqli_fetch_object($memberresult3);

   $memberdetail_id3= $memberdetails3->memeber_id;

    $memberdetail_user_id3= $memberdetails3->user_id;

    $date_now3 = new DateTime();

    $date3    = new DateTime($memberdetails->ex_date);

    if ($date_now3 > $date3) {

    

    }else{

 $le2membershipsql = "INSERT INTO purchas_wallet (member_id,user_id,amount,comm_member_id,purchase_date,purchase_comm_type)

VALUES ('$memberdetail_id3', '$memberdetail_user_id3', '$com2','$user','$date','purchase commission')";



     mysqli_query($config,$le2membershipsql );

    $l1walletsql = "UPDATE customer_master SET Customer_Wallet=Customer_Wallet+$com2 WHERE Customer_Id='$memberdetail_user_id3'";

      mysqli_query($config,$l1walletsql);

    }

    $paidon= date('d-m-Y H:i: a ');
    $pm="INSERT INTO `online_payment_transcation` (`R_Order_id`, `Payment_id`, `Order_Paid_Status`, `Order_id`, `Customer_id`, `Customer_Name`, `Paid_on`,`Payment_Gateway`,`Paid_Amout`) VALUES ('".$_GET['trackorder']."', '".$response['payments'][0]['payment_id']."', 'success', '".$_GET['trackorder']."','".$_GET['sessionid']."','".$_GET['customername']."',' $paidon','Instamojo','".$_GET['advance_pay']."')";
    $sql =mysqli_query($config,$pm);
    
       $finaladd = date('Y-m-d');
    echo   $or="update order_master set Payment_Mode='ONLINE_PAYMENT',Order_on='$finaladd',Order_status='Completed',Delivery_status='On_Progress',Grand_total='".$_GET['gtotal']."',advance_pay='".$_GET['advance_pay']."' where order_customer_track_id='".$_GET['trackorder']."' and Customer_id='$session_id' ";
    
      $check_add=mysqli_query($config,$or);
           
       $prqu=mysqli_query($config,"select Order_product,Ordered_quantity  from order_master where order_customer_track_id='".$_GET['trackorder']."' and Customer_id='$session_id'");	
       
       while($qual= mysqli_fetch_array($prqu))
       {
           
           $upqu=mysqli_query($config,"update product_master set Product_Avalible_Stocks = Product_Avalible_Stocks -'".$qual[1]."' where Product_id='".$qual[0]."'  ");
           
          
           
           
       }
         
 }



date_default_timezone_set('Asia/Kolkata');

$paidon= date('d-m-Y H:i: a ');

$cartadd= date('d-m-Y ');




$order_sel=mysqli_query($config," select * from order_master where order_customer_track_id='".$_GET['orderid']."'");

$os=mysqli_fetch_object($ref_sel);	

if($os->Referral_code != '')

{

$ref_sel=mysqli_query($config," select * from referal_master where Referal_Code='".$os->Referral_code."'");

$rs=mysqli_fetch_object($ref_sel);

$refundon=date('Y-m-d');





$refund=mysqli_query($config,"insert into wallet_master(wallet_Customer_id,Wallet_amount,Wallet_status,Wallet_Active_Status,Wallet_Add_on,Unic_wallet,Referal_customer_id,wallet_order) values('".$os->Refered_customer_id."','".$rs->Referal_Price_Percentage."','Referal Earning','0','$refundon','".$_GET['ref_product_client'].$rs->Referal_Price_Percentage.'Referal Earning'.$_GET['ref_product_code'].$session_id."','$session_id','".$_GET['orderid']."') ");	

















if($refund)

{



$referal_add = mysqli_query($config,"select * from customer_master where Customer_Id='".$_GET['ref_product_client']."'");



$rfadd = mysqli_fetch_object($referal_add);



$already=$rfadd->Customer_Wallet;





$wallet_update = mysqli_query($config,"update customer_master set Customer_Wallet='".$rs->Referal_Price_Percentage."' + '". $already ."' where Customer_Id='".$_GET['ref_product_client']."'  ");





}

}	






 











if($sql){

echo "payment details inserted to db";


 

$adcart=mysqli_query($config,"select * from order_checkout where order_customer_track_id='".$_GET['orderid']."' and Customer_id='$session_id' ");

$ac=mysqli_fetch_object($adcart);





if($ac->wallet_status =='Applied')

{

$upwal=mysqli_query($config,"update customer_master set Customer_Wallet='".$ac->Wallet_Amount."' where Customer_Id='$session_id'");





}
}

        
        
        
        
        
     header('location:successful.php?ordertrack='.$_GET['trackorder']);

		

   

		

	?>

	<br>

	<p><a class="btn btn-warning" target="_blank" href=""> View Your order 

	 <i class="fa fa-window-restore "></i></a></p>

	</div>

	<br><br><br>

	</article>



</body>

</html>

