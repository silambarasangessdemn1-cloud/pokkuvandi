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
      $subject = 'Membership  payment has been confirmed ';


            $PP=$_GET['payment_id'];

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
             
            
            $headers .= 'From: '.$session__mail."\r\n".
                'Reply-To: '.$session__mail."\r\n" .
                'X-Mailer: PHP/' . phpversion();
                include "member_pay_mail.php";           
                mail($session__mail,$subject,$txt,$headers);
            
             
            
             $unique_id=$_GET['rcode'];

            $membersql="SELECT * FROM `membership_list` where unique_id=$unique_id";

            $memberresult = mysqli_query($config, $membersql);

            $memberdetails = mysqli_fetch_object($memberresult);

            $memberdetail_id=$memberdetails->memeber_id;

            $memberdetail_user_id=$memberdetails->user_id;

            $pid=$_GET['planid'];

             $plansql="SELECT * FROM `membership` where mid='$pid'";

             $result = mysqli_query($config, $plansql);

             $row = mysqli_fetch_object($result);

            $plantitle= $row->title;

            $plan_ex_day= $row->ex_days;

            $planprice= $row->price;

            $level1_com= $row->level1_com;

            $level2_com= $row->level2_com;

          $date=date("d-m-Y");

          $uid=rand(0000000000,9999999999);

           $ex_date=date('d-m-Y', strtotime($date. '+'.$plan_ex_day.'day'));



          $membership_list_sql = "INSERT INTO membership_list (user_id,membership_plan_id,membership_title,valid_days,ex_date,membership_amount,pay_status,member_referraid,unique_id,pay_id,status)

          VALUES ('".$_GET['customerid']."', '$row->mid', '$row->title','$plan_ex_day','$ex_date','$planprice','paid','$memberdetail_id',' $uid','".$_GET['payment_id']."','1')";

          

          mysqli_query($config, $membership_list_sql);

                 $com1=(($planprice * $level1_com)/100);

                 $com2=(($planprice * $level2_com)/100);



                $membershipsql = "INSERT INTO membership_wallet (member_id,user_id,amount,comm_member_id,comm_date,comm_type)

          VALUES ('$memberdetail_id', '$memberdetail_user_id', '$com1','$uid','$date','level1')";

          

                   mysqli_query($config, $membershipsql);

                $l1walletsql = "UPDATE customer_master SET Customer_Wallet=Customer_Wallet+$com1 WHERE Customer_Id='$memberdetail_user_id'";



                 mysqli_query($config,$l1walletsql);

                $l2membersql="SELECT * FROM `membership_list` where user_id='$memberdetail_user_id'";

                $memberresultlevel2 = mysqli_query($config, $l2membersql);

                $level2com = mysqli_fetch_object($memberresultlevel2 );

               $levelid= $level2com->member_referraid;





              $l3membersql="SELECT * FROM `membership_list` where user_id='$memberdetail_user_id'";

              $memberresultlevel3 = mysqli_query($config, $l3membersql);

              $level3com = mysqli_fetch_object($memberresultlevel3);

             $levelid3= $level3com->user_id;



                 $le2membershipsql = "INSERT INTO membership_wallet (member_id,user_id,amount,comm_member_id,comm_date,comm_type)

              VALUES ('$levelid3', '$levelid', '$com2','$uid','$date','level2')";

                  mysqli_query($config,$le2membershipsql );

                    $l1walletsql = "UPDATE customer_master SET Customer_Wallet=Customer_Wallet+$com2 WHERE Customer_Id='$levelid'";

                 mysqli_query($config,$l1walletsql);
              
               

         }

        }

        

        catch (Exception $e) {

            print('Error: ' . $e->getMessage());
            header("location:pay_fail.php?payid=$payid&amount=$planprice");


            }

    

            // header("location:membership_pay_success.php?payid=$payid&amount=$planprice");


            // header('location:successful.php?ordertrack='.$_GET['orderid']);
            header("location:intro_pay.php");

        ?>