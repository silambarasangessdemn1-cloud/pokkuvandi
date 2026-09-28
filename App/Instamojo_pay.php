 <?php include('config/setup.php');?>

<?php

require_once('vendor/autoload.php');

  $paygate=mysqli_query($config,"select * from payment_setting where Payment_Option='Payment_Option2' ");
            while($pg=mysqli_fetch_object($paygate))
            {
		  


    $API_KEY = $pg->Payment__id;
    $AUTH_TOKEN = $pg->Payment_Key;
	
	
			}
	
    $URL = 'https://www.instamojo.com/api/1.1/';

    $api = new Instamojo\Instamojo($API_KEY, $AUTH_TOKEN,'https://www.instamojo.com/api/1.1/');

    try {
        $response = $api->paymentRequestCreate(array(
            "purpose" => "Online Shopping",
            "amount" => $_GET["gtotal"],
            "buyer_name" => $_GET["customername"],
            "send_email" => true,
            "email" => $_GET["customermail"],
            "phone" => $_GET["customerphone"],
            "redirect_url" => 
			"https://".$_SERVER['SERVER_NAME']."/App/In_Redirect.php?orderid=".$_GET['trackorder']."&customerid=".$_GET['sessionid']."&paidamount=".$_GET['gtotal']
            ));
            
            header('Location: ' . $response['longurl']);
            exit();
    }catch (Exception $e) {
        print('Error: ' . $e->getMessage());
    }




?>
