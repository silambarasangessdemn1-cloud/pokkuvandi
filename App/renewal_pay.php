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







		$api = new Instamojo\Instamojo($API_KEY, $AUTH_TOKEN,'https://www.instamojo.com/api/1.1/');







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



             $user=$_GET['customerid'];



            $pid=$_GET['planid'];



            $plansql="SELECT * FROM `membership` where mid='$pid'";



            $result = mysqli_query($config, $plansql);



            $row = mysqli_fetch_object($result);



           $plantitle= $row->title;



           $plan_ex_day= $row->ex_days;



           $date=date("d-m-Y");



           $planprice= $row->renew_amount;



            $ex_date=date('d-m-Y', strtotime($date. '+'.$plan_ex_day.'day'));



          $sql = "UPDATE membership_list SET ex_date='$ex_date', pay_id='".$_GET['payment_id']."' WHERE user_id='$user'";







         mysqli_query($config, $sql);



        $level1_com= $row->level1_com;



        $level2_com= $row->level2_com;



        $com1=(($planprice * $level1_com)/100);



        $com2=(($planprice * $level2_com)/100);



       $membersql="SELECT * FROM `membership_list` where user_id='$user'";



       $memberresult = mysqli_query($config, $membersql);



       $memberdetails1 = mysqli_fetch_object($memberresult);



       $meid=$memberdetails1->member_referraid;



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



       $membershipsql = "INSERT INTO membership_wallet (member_id,user_id,amount,comm_member_id,comm_date,comm_type)



       VALUES ('$memberdetail_id', '$memberdetail_user_id', '$com1','$user','$date','renewal membership')";



       



                mysqli_query($config, $membershipsql);



                    $l1walletsql = "UPDATE customer_master SET Customer_Wallet=Customer_Wallet+$com1 WHERE Customer_Id='$memberdetail_user_id'";







                mysqli_query($config,$l1walletsql);



   }



                $membersql3="SELECT * FROM `membership_list` where memeber_id='$member_referraid'";



                $memberresult3 = mysqli_query($config, $membersql3);



                $memberdetails3 = mysqli_fetch_object($memberresult3);



               $memberdetail_id3= $memberdetails3->memeber_id;



                $memberdetail_user_id3= $memberdetails3->user_id;



                $date_now1 = new DateTime();



                $date3    = new DateTime($memberdetails3->ex_date);



                if ($date_now1 > $date3) {



                 



               }else{



              $le2membershipsql = "INSERT INTO membership_wallet (member_id,user_id,amount,comm_member_id,comm_date,comm_type)



              VALUES ('$memberdetail_id3', '$memberdetail_user_id3', '$com2','$user','$date','renewal membership')";



                  mysqli_query($config,$le2membershipsql );



                $l1walletsql = "UPDATE customer_master SET Customer_Wallet=Customer_Wallet+$com2 WHERE Customer_Id='$memberdetail_user_id3'";



                mysqli_query($config,$l1walletsql);



               }



                // header("location:membership_pay_success.php?payid=$payid&amount=$planprice");







           }



        }



        



         catch (Exception $e) {



             print('Error: ' . $e->getMessage());

             header("location:pay_fail.php?payid=$payid&amount=$planprice");





             }



             header("location:intro_pay.php");



             ?>