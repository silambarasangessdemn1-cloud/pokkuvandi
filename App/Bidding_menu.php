<?php include('config/setup.php')?>

 <div class="border-bottom p-3" style="background-color: #199b37 !important;">

            <div class="title d-flex align-items-center">

               <a href="Bidding.php" class="text-decoration-none text-dark d-flex align-items-center">

                  <img class="osahan-logo mr-2" src=" <?php 

               

                $inro_logo=mysqli_query($config,"select Logo_Path,logo_status from lee_master");

                 while($logo=mysqli_fetch_array($inro_logo))

               {

                    $logstatus=$logo[1];

   if($logstatus == 1)

   {

     $ms=substr($logo[0],6);

				  echo  $ms;

   }else{

       echo "../photos/logo/no_logo.png";

   

   }

   

               }

               

               ?>

               ">

                  <h6 class="m-0"><?php 

               

               $leename=mysqli_query($config,"select Name,Name_status from lee_master");

               while($lee=mysqli_fetch_array($leename))

               {

                    $namestatus=$lee[1];

   if($namestatus == 1)

   {

      //  echo  $lee[0];
      echo 'Services ';

   }else{

       echo "Need Name";

   

   }

   

               }

               

               ?> </h6>

               </a>
              
               <p class="ml-auto m-0">

               <a href="bidingview.php" class="text-decoration-none bg-white p-1 rounded shadow-sm d-flex align-items-center">
                  <i class="text-dark icofont-notification"></i>
                  <span class="badge badge-danger p-1 ml-1 small">
				  
                  <?php

$det=mysqli_query($config,"SELECT * FROM `biding_vender` where  cust_id='$session_id'");  
$vdet=mysqli_fetch_object($det);
  $e1="SELECT count(vender_list_id) as etotal FROM `vemder_enq_list` INNER JOIN biding_enq ON biding_enq.biding_en_id=vemder_enq_list.enq_id  where venderlid='".$vdet->vender_id."'  and status='new' ";
                $about1=mysqli_query($config,$e1);
 $del1=mysqli_fetch_object($about1);

  $e="SELECT COUNT(`biding_enq_pay_id`) as rtotal FROM `biding_enq_pay` INNER JOIN biding_enq ON biding_enq_pay.biding_enq=biding_enq.biding_en_id
where ve_id='".$vdet->vender_id."' and biding_enq.status='new' ";
                $about=mysqli_query($config,$e);
 $del=mysqli_fetch_object($about);?>
                  <?php 
   //   echo $del->rtotal;

    $d= $del->rtotal - $del1->etotal;
    if($d == 0)
    {
      
    }else{
echo abs($d);
    }?>
				  
				  
				  
				  
				  
				  
				  </span>
                  </a>

               </p>

               <a class="toggle ml-3" href="#"><i class="icofont-navigation-menu"></i></a>

            </div>

             

               <!-- <div class="input-group mt-3 rounded shadow-sm overflow-hidden bg-white">

                 

                  <input style='margin-left: 7%;' id='catesearch1'  type="text" class="shadow-none border-0 form-control pl-0" placeholder="Search for Category.." aria-label="" aria-describedby="basic-addon1">

                  <div class="input-group-prepend">

                     <button id='catesearch' class="border-0 btn btn-outline-secondary text-success bg-white"><i class="icofont-search"></i></button>

                  </div>

               </div>

               <div id='search'>

                -->

                  <!-- </div> -->
                  <a href="biding_search.php" class="text-decoration-none">

               <div class="input-group mt-3 rounded shadow-sm overflow-hidden bg-white">

                  <div class="input-group-prepend">

                     <button class="border-0 btn btn-outline-secondary text-success bg-white"><i class="icofont-search"></i></button>

                  </div>

                  <input type="text" class="shadow-none border-0 form-control pl-0" placeholder="Search for Keywords.." aria-label="" aria-describedby="basic-addon1">

               </div>

            </a>
         </div>



         <style>

            .sresults{

               background: white;

            }

            .sresults li{

               border-bottom: 1px solid gainsboro;
padding-top: 2%;
            }

            .sresults {

               list-style: none;

              

               

            }

            </style>