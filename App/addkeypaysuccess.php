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

            
//  $paygate=mysqli_query($config,"SELECT * FROM `biding_package` where packid='".$_GET['planid']."' ");



//  $pack=mysqli_fetch_object($paygate);
                    
                 
        //         $date=date("d-m-Y");



        //         $plan_ex_day=  $pack->package_valid;
     
        //         $plan_id=$_GET['planid'];
     
        //          $ex_date=date('d-m-Y', strtotime($date. '+'.$plan_ex_day.'day'));
     
        //         $ven="INSERT INTO biding_vender (cust_id,vender_city,vender_package,vender_valid,pay_id,ex_date,status,topupamount)
        //         VALUES ('".$_GET['customerid']."', '".$_GET['city']."','".$_GET['planid']."','".$pack->package_valid."','".$response['payments'][0]['payment_id'] ."','$ex_date','1','". $pack->topupamount."')";
        //    mysqli_query($config,$ven);
        // $last_id = mysqli_insert_id($config);
        $planid=unserialize(urldecode($_GET['planid']));
               
         
             $area=unserialize(urldecode($_GET['area']));
            //  $key=unserialize(urldecode($_GET['key']));
              // print_r($key);
        foreach($area as $area)
        {
          $key=unserialize(urldecode($_GET['key']));
                  $i=0;

                
                        foreach($key as $key)
                        {
                           echo $sql_key="INSERT INTO vender_keyword (vender_key,venderid,vender_area1,vender_package1) VALUES ('$key','".$_GET['vid']."','$area','". $planid[$i]."')";
                             mysqli_query($config,$sql_key);
                             $i++;
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