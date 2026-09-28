<?php include('config/setup.php');



?>





<?php







require_once('vendor/autoload.php');


$area=$_GET['area'];
$key=$_GET['key'];

  $paygate=mysqli_query($config,"select * from payment_setting where Payment_Option='Payment_Option2' ");



            while($pg=mysqli_fetch_object($paygate))



            {

    $API_KEY = $pg->Payment__id;



   $AUTH_TOKEN = $pg->Payment_Key;

			}


    $URL = 'https://www.instamojo.com/api/1.1/';

    $api = new Instamojo\Instamojo($API_KEY,$AUTH_TOKEN,'https://www.instamojo.com/api/1.1/');

    try {



        $response = $api->paymentRequestCreate(array(



            "purpose" => "Topup",



            "amount" => $_GET["totalpay"],



            "buyer_name" => $_GET["customername"],



            "send_email" => true,



            "email" => $_GET["customermail"],



            "phone" => $_GET["customerphone"],



            "redirect_url" =>"https://callinfo.in/App/topuppaysuccess.php?rcode=".$_GET['rcode']."&customerid=".$_GET['sessionid']."&paidamount=".$_GET['totalpay']." ",

                  ));



            



            header('Location: ' . $response['longurl']);



            exit();



    }catch (Exception $e) {



        print('Error: ' . $e->getMessage());



    }
?>
