<?php include('../config/setup.php');

                    
                $area=$_GET['area'];
              
            
                $date=date("d-m-Y");
                $paygate=mysqli_query($config,"SELECT * FROM `biding_package` where packid='".$_GET['packid']."' ");



                $pack=mysqli_fetch_object($paygate);


                $plan_ex_day=  $pack->package_valid;
     
                $plan_id=$_GET['packid'];
     
                 $ex_date=date('d-m-Y', strtotime($date. '+'.$plan_ex_day.'day'));
                 date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
                 $ffb= date('d-m-Y H:i:s');


                 $ven="INSERT INTO biding_vender (cust_id,vender_city,vender_package,vender_valid,pay_id,ex_date,status,topupamount,c_name,GST,vender_cre_da)
                VALUES ('".$_GET['sessionid']."', '".$_GET['city']."','".$_GET['packid']."','".$pack->package_valid."','Cash','$ex_date','1','". $pack->topupamount."','".$_GET['c_name']."','".$_GET['gst']."','$ffb')";
    
   mysqli_query($config,$ven);
        $last_id = mysqli_insert_id($config);
                    foreach($area as $area)
                    {
                        $key=$_GET['key'];
                        foreach($key as $key)
                        {
                            $sql_key="INSERT INTO vender_keyword (vender_key,venderid,vender_area1,vender_package1) VALUES ('$key','$last_id','$area','$plan_id')";
                           mysqli_query($config,$sql_key);
                        }
                    }

       
            header("location:biding_ven.php?msg=1");
            die;
            ?>