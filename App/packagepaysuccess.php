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

$PP=$response['payments'][0]['payment_id'];

$subject = 'Bidding Membership  payment has been confirmed ';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 

$headers .= 'From: '.$session__mail."\r\n".
    'Reply-To: '.$session__mail."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    include "bidding_membership_mail.php";           
    mail($session__mail,$subject,$txt,$headers);



            $rid=$_GET['rid'];
            

            
 $paygate=mysqli_query($config,"SELECT * FROM `biding_package` where packid='".$_GET['planid']."' ");



 $pack=mysqli_fetch_object($paygate);


 
                    
                $area=unserialize(urldecode($_GET['area']));
                
            
                $date=date("d-m-Y");



                $plan_ex_day=  $pack->package_valid;
     
                $plan_id=$_GET['planid'];
     
                 $ex_date=date('d-m-Y', strtotime($date. '+'.$plan_ex_day.'day'));
                 date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
                 $ffb= date('d-m-Y H:i:s');

                $ven="INSERT INTO biding_vender (cust_id,vender_city,vender_package,vender_valid,pay_id,ex_date,status,topupamount,c_name,GST,vender_cre_da)
                VALUES ('".$_GET['customerid']."', '".$_GET['city']."','".$_GET['planid']."','".$pack->package_valid."','".$response['payments'][0]['payment_id'] ."','$ex_date','1','". $pack->topupamount."','".$_GET['c_name']."','".$_GET['gst']."','$ffb')";
           mysqli_query($config,$ven);
        $last_id = mysqli_insert_id($config);


        if($rid)
        {

            $ptotal=(($pack->amount) * ($pack->r_earn )/100);

            $en = "INSERT INTO biding_share_earn (cust_earn_id,e_amount,bid_vid)
VALUES ('$rid', '$ptotal','$last_id')";


mysqli_query($config,$en);

$sqly = "UPDATE customer_master SET Customer_Wallet=Customer_Wallet+'$ptotal' WHERE Customer_Id='$rid'";
mysqli_query($config,$sqly);

        }


                    foreach($area as $area)
                    {
                        $key=unserialize(urldecode($_GET['key']));
                        foreach($key as $key)
                        {
                            $sql_key="INSERT INTO vender_keyword (vender_key,venderid,vender_area1,vender_package1) VALUES ('$key','$last_id','$area','$plan_id')";
                             mysqli_query($config,$sql_key);
                        }
                    }

         }
        }



        



        catch (Exception $e) {



            print('Error: ' . $e->getMessage());

            header("location:pay_fail.php?payid=$payid&amount=$planprice");





            }
            header("location:intro_pay.php");
            ?>