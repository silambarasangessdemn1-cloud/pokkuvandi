<?php include('config/setup.php')?>
 <div class="border-bottom p-3" style="background-color: #dee2e6 !important;">
            <div class="title d-flex align-items-center">
               <a href="home.php" class="text-decoration-none text-dark d-flex align-items-center">
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
       echo  $lee[0];
   }else{
       echo "Need Name";
   
   }
   
               }
               
               ?> </h6>
               </a>
               <p class="ml-auto m-0">
                  <a href="cart.php" class="text-decoration-none bg-white p-1 rounded shadow-sm d-flex align-items-center">
                  <i class="text-dark icofont-notification"></i>
                  <span class="badge badge-danger p-1 ml-1 small">
				  
				  <?php
				   $checkout=mysqli_query($config,"select count(Order_id) from order_master where Customer_id='$session_id' and Order_status='Cart'");
               while($order_checkout=mysqli_fetch_array($checkout))
               {
				  
				 echo $order_checkout[0];
				  
			   }
				  
				  
				  ?>
				  
				  
				  
				  
				  
				  
				  </span>
                  </a>
               </p>
               <a class="toggle ml-3" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
            <a href="search.php" class="text-decoration-none">
               <div class="input-group mt-3 rounded shadow-sm overflow-hidden bg-white">
                  <div class="input-group-prepend">
                     <button class="border-0 btn btn-outline-secondary text-success bg-white"><i class="icofont-search"></i></button>
                  </div>
                  <input type="text" class="shadow-none border-0 form-control pl-0" placeholder="Search for Products.." aria-label="" aria-describedby="basic-addon1">
               </div>
            </a>
         </div>