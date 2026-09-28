<?php include('config/setup.php');?>

<?php 


     $area=$_POST['area'];

     $co=count($area);
     $v=$_POST['nofoareaamount'];
    $gtotal1= $co * $v;
   
    $total_member=$_POST['total_member'];

    foreach($area as $area)
    {
    $key=$_POST['key'];

    foreach($key as $key)
    {
      
    $ss="SELECT count(vender_area1) as total FROM `biding_vender` INNER join vender_keyword on biding_vender.vender_id=vender_keyword.venderid where vender_package1='".$_POST['packid']."' and vender_area1='$area' and vender_key='$key'";

        $main_cate1=mysqli_query($config,$ss);
        $first=mysqli_query($config,"SELECT * FROM `biding_package` where packid='".$_POST['packid']."'");
        $pfirst=mysqli_fetch_object($first);
        if (mysqli_num_rows($main_cate1) > 0) {
        
        $macate3=mysqli_fetch_object($main_cate1);
        if(  $total_member > $macate3->total)
        {
        //    echo  $data ='1';
        $fullkey[]=$key;
        $addpack[]=$_POST['packid'];
        $addkeys[]= $pfirst->addonkey_amount;
        $addarea[]= $pfirst->addonarea_amount;

        }else{
        
            $x=1;
            while($x <=3)
            {
            switch ($x) {
                case 1:
                    $se="SELECT count(vender_area1) as total FROM `biding_vender` INNER join vender_keyword on biding_vender.vender_id=vender_keyword.venderid where vender_package1='1' and vender_area1='$area' and vender_key='$key'";
                    $case1=mysqli_query($config,$se);
                    $pcase1=mysqli_query($config,"SELECT * FROM `biding_package` where packid='1'");
                    $pscase1=mysqli_fetch_object($pcase1);
                    if (mysqli_num_rows($case1) > 0) {
                    $scase1=mysqli_fetch_object($case1);
                     if(  $total_member > $scase1->total)
                    {
                        $addpack[]='1';
                        $fullkey[]=$key;
                        $addkeys[]= $pscase1->addonkey_amount;
                        $addarea[]= $pscase1->addonarea_amount;
                        $x=4;
                    }
                    
                    }else{
                        $addpack[]='1';
                        $fullkey[]=$key;
                        $addkeys[]= $pscase1->addonkey_amount;
                        $addarea[]= $pscase1->addonarea_amount;
                        $x=4;
                    }


                  break;
                  case 2:
                   $se="SELECT count(vender_area1) as total FROM `biding_vender` INNER join vender_keyword on biding_vender.vender_id=vender_keyword.venderid where vender_package1='2' and vender_area1='$area' and vender_key='$key'";
            $case2=mysqli_query($config,$se);
            $pcase2=mysqli_query($config,"SELECT * FROM `biding_package` where packid='2'");
            $pscase2=mysqli_fetch_object($pcase2);
            if (mysqli_num_rows($case2) > 0) {
            $scase2=mysqli_fetch_object($case2);
             if(  $total_member > $scase2->total)
            {
                $addpack[]='2';
                $fullkey[]=$key;
                $addkeys[]= $pscase2->addonkey_amount;
                $addarea[]= $pscase2->addonarea_amount;
                $x=4;
            }
            
            }else{
                $addpack[]='2';
                $fullkey[]=$key;
                $addkeys[]= $pscase2->addonkey_amount;
                $addarea[]= $pscase2->addonarea_amount;
                $x=4;
            }
                     break;
                     case 3:
                        $se="SELECT count(vender_area1) as total FROM `biding_vender` INNER join vender_keyword on biding_vender.vender_id=vender_keyword.venderid where vender_package1='3' and vender_area1='$area' and vender_key='$key'";
                        $case3=mysqli_query($config,$se);
                        $pcase3=mysqli_query($config,"SELECT * FROM `biding_package` where packid='3'");
                        $pscase3=mysqli_fetch_object($pcase3);
                        if (mysqli_num_rows($case3) > 0) {
                        $scase3=mysqli_fetch_object($case3);
                         if(  $total_member > $scase3->total)
                        {
                            $addpack[]='3';
                            $fullkey[]=$key;
                            $addkeys[]= $pscase3->addonkey_amount;
                            $addarea[]= $pscase3->addonarea_amount;
                            $x=4;
                        }
                        
                        }else{
                            $addpack[]='3';
                            $fullkey[]=$key;
                            $addkeys[]= $pscase3->addonkey_amount;
                            $addarea[]= $pscase3->addonarea_amount;
                            $x=4;
                        }
                         break;

                    
              }
              $x++;
            }

        }
     
     }
    }
    }

// echo $data;
$area1=$_POST['area'];
$key1=$_POST['key'];
// print_r($area1);
// die;
$gtotal=array_sum($addkeys);
// $areatotal=$addarea[0];

// $area=$_POST['area'];
 $totalamount=$gtotal+$gtotal1;



// print_r( $addkeys);
// print_r( $addpack); 
// print_r( $addarea);
// print_r( $fullkey);   
?>



<?php







require_once('vendor/autoload.php');




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



            "purpose" => "Addkeys",



            "amount" => $totalamount,



            "buyer_name" => $_POST["customername"],



            "send_email" => true,



            "email" => $_POST["customermail"],



            "phone" => $_POST["customerphone"],



            "redirect_url" =>"https://callinfo.in/App/addkeypaysuccess.php?rcode=".$_GET['rcode']."&customerid=".$_GET['sessionid']."&paidamount=".$totalamount."&vid=".$_POST['vid']."&planid=".urlencode(serialize($addpack))."&area=".urlencode(serialize($area1))."&key=".urlencode(serialize($key1))." ",

                  ));



            



            header('Location: ' . $response['longurl']);



            exit();



    }catch (Exception $e) {



        print('Error: ' . $e->getMessage());



    }
?>
