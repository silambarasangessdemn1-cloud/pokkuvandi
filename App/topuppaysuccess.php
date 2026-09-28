<?php include('config/setup.php')?>



<?php include('session.php');?>	







	<?php

		require_once('vendor/autoload.php');



 $paygate=mysqli_query($config,"select * from payment_setting where Payment_Option='Payment_Option2' ");



            while($pg=mysqli_fetch_object($paygate))

            {


        $API_KEY = $pg->Payment__id;



        $AUTH_TOKEN = $pg->Payment_Key;

}



        $URL = "https://www.instamojo.com/api/1.1/";

        $api = new Instamojo\Instamojo($API_KEY,$AUTH_TOKEN,'https://www.instamojo.com/api/1.1/');

		 $payid = $_GET["payment_request_id"];



    $response = $api->paymentRequestStatus($payid);

		try {



		$response = $api->paymentRequestStatus($payid);



		//  "<h5>Payment ID: " . $response['payments'][0]['payment_id'] . "</h5>" ;



		//  "<h5>Payment Name: " . $response['payments'][0]['buyer_name'] . "</h5>" ;



		//  "<h5>Payment Email: " . $response['payments'][0]['buyer_email'] . "</h5>" ;



		//  "<h5>Payment Mobile: " . $response['payments'][0]['buyer_phone'] . "</h5>" ;



		// echo "<h5>Payment status: " . $response['payments'][0]['status'] . "</h5>" ;



		//  "<pre>";







         if($response['payments'][0]['status']=='Credit')



		 { 

            
 $paygate=mysqli_query($config,"SELECT * FROM `biding_package` where packid='".$_GET['planid']."' ");



 $pack=mysqli_fetch_object($paygate);
                    
             
                
              $sql = "UPDATE biding_vender SET topupamount=topupamount+'".$_GET['paidamount']."' WHERE 	cust_id='".$_GET['customerid']."'";
              mysqli_query($config,$sql);
     
              $sqll = "INSERT INTO bidding_vender_top (bidding_vender_vid,bidding_vender_amount,bidding_vender_payid)
              VALUES ('".$_GET['customerid']."', '".$_GET['paidamount']."', '".$response['payments'][0]['payment_id']."')";
                 mysqli_query($config,$sqll);
         }
        }



        



        catch (Exception $e) {



            print('Error: ' . $e->getMessage());

            header("location:pay_fail.php?payid=$payid&amount=$planprice");





            }
             header("location:intro_pay.php");
            ?>