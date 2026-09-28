<?php include('config/setup.php')?>

<?php include('session.php');?>



<!DOCTYPE html>

<html lang="en">

   <head>

      <meta charset="utf-8">

      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <meta name="description" content="">

      <meta name="author" content="">

        <link rel="icon" type="image/png" href="<?php 

            

            $inro_logo=mysqli_query($config,"select Logo_Path,logo_status from lee_master");

            while($logo=mysqli_fetch_array($inro_logo))

            {

                 $logstatus=$logo[1];

if($logstatus == 1)

{

	

	 $ms=substr($logo[0],3);

				  echo  $ms;

	

     

}else{

    echo "../../photos/logo/no_logo.png";



}



            }

            

            ?>">

      <title><?php 

            

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

            

            ?></title>

      <!-- Slick Slider -->

      <link rel="stylesheet" type="text/css" href="vendor/slick/slick.min.css"/>

      <link rel="stylesheet" type="text/css" href="vendor/slick/slick-theme.min.css"/>

      <!-- Icofont Icon-->

      <link href="vendor/icons/icofont.min.css" rel="stylesheet" type="text/css">

      <!-- Bootstrap core CSS -->

      <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom styles for this template -->

      <link href="css/style.css" rel="stylesheet">

      <!-- Sidebar CSS -->

      <link href="vendor/sidebar/demo.css" rel="stylesheet">

   </head>

   <body class="fixed-bottom-padding">

      <div class="theme-switch-wrapper">

         <label class="theme-switch" for="checkbox">

            <input type="checkbox" id="checkbox" />

            <div class="slider round"></div>

            <i class="icofont-moon"></i>

         </label>

         <em>Enable Dark Mode!</em>

      </div>

      <div class="osahan-order">

        

         <div class="p-3 border-bottom bg-white">

            <div class="d-flex align-items-center">

                <a class="font-weight-bold text-success text-decoration-none" href="Bidding.php">

<i class="icofont-rounded-left back-page"></i></a>

                <h6 class="font-weight-bold m-0 ml-3">My Wallet  </h6>

                <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>

            </div>

        </div>
        <br>

         <div class="d-flex" style="height: 34px;">

                      <h6 class="text-muted m-0">Total Earning  <b>Rs. <?php echo number_format($session__wallet,2);?> </b></h6>

			

			 

			  	<?php 

	$payoutin=mysqli_query($config,"select * from payout_setting where Payout_setting=1");

	while($pin=mysqli_fetch_object($payoutin))

	

	{

		if($session__wallet >= $pin->payout_set  )

		{

		?>

 

       <a href="payout_request.php" style="margin-left: 85px;" class="btn btn-success">Withdraw Now</a>	

		

	<?php }else{ 	?> 

 

		

		

		<a href="wallet_payout.php" style="margin-left: 85px;" class="btn btn-success">Payout Status</a>	 

			 

	<?php }} ?>	 

			 

			 

			 

					

                         

                     </div>

		 	<?php 

	$adcart=mysqli_query($config,"select * from wallet_master where wallet_Customer_id='$session_id' ");

	while($ac=mysqli_fetch_object($adcart))

	

	{

		 

 

       	

		

		?>

 

		 

		 

		 

		 <div class="order-body p-3">

            <div class="pb-3">

               <a href="#" class="text-decoration-none text-dark">

                  <div class="p-3 rounded shadow-sm bg-white">

                     <div class="d-flex align-items-center mb-3">

					 

			

                        <p class="bg-warning text-white py-1 px-2 rounded small m-0"><?php echo $ac->Wallet_status; ?></p>

                       

						

				 

						

						

						

						

                        <p class="text-muted ml-auto small m-0"><i class="icofont-clock-time"></i>   <?php 

						

						$dt=  $ac->Wallet_Add_on;   

echo $newDate = date("d-m-Y", strtotime($dt));

						

						

						?></p>

                     </div>

                     <div class="d-flex">

                        <p class="text-muted m-0">Referal. ID<br>

                           <span class="text-dark font-weight-bold">#<?php echo $ac->wallet_order; ?></span>

                        </p>

                        

						 

						   

						   

                        </p>

                        <p class="text-muted m-0 ml-auto">Add Amount<br>

                           <span class="text-dark font-weight-bold">Rs.<?php echo $ac->Wallet_amount; ?></span>

                        </p> 

						<p class="text-muted m-0 ml-auto">Used Customer<br>

                           <span class="text-dark font-weight-bold"><?php  

													

													$referalto=mysqli_query($config,"select Customer_Name from customer_master where Customer_Id='".$ac->Referal_customer_id."'");

											$r=mysqli_num_rows($referalto);

if($r > 0)

{

											$rto=mysqli_fetch_object($referalto);

											 

											 

												

												

												echo  $rto->Customer_Name;

												

}else{

	

	echo "-";

}				

													

													

													?></span>

                        </p>

                     </div>

                  </div>

               </a>

            </div>

         </div>

		 

	<?php } ?>

   

   <br> <br>

   <div class="card" style="width:100%">

  <div class="card-body">

    <h5 class="card-title">Product Referal Earning</h5>

    <hr><br>

    <div class="row"><div class="col-3">

       <img src="purchase.png" width="100px"></div>

       <?php 

       

       $mship=mysqli_query($config,"SELECT sum(Wallet_amount) as amount FROM `wallet_master` WHERE wallet_Customer_id='$session_id' ");

       $memship=mysqli_fetch_object($mship);

        $memship_amount=$memship->amount;

       ?><div class='col-9'>

       <h4 style="

    text-align: center;

">Total Amount<br> Rs.<?php if($memship_amount){ echo $memship_amount;}else{echo'0';}?></h4></div>

    </div>

   

  </div></div>



   <div class="card" style="width:100%">

  <div class="card-body">

    <h5 class="card-title">Membership Referral Earnings</h5>

    <hr><br>

    <div class="row"><div class="col-3">

       <img src="members.png" width="100px"></div>

       <?php 

       

       $mship=mysqli_query($config,"SELECT sum(amount) as amount FROM `membership_wallet` WHERE user_id='$session_id' ");

       $memship=mysqli_fetch_object($mship);

        $memship_amount=$memship->amount;

       ?><div class='col-9'>

       <h4 style="

    text-align: center;

">Total Amount <br> Rs.<?php if($memship_amount){ echo $memship_amount;}else{echo'0';}?></h4></div>

    </div>

   

  </div>
</div>

  <div class="card" style="width:100%;">

  <div class="card-body">

    <h5 class="card-title">Membership Purchase Earnings</h5>

    <hr><br>

    <div class="row">

       <div class="col-3">

       <img src="shopping-bag.png" width="100px"></div>

       <?php 

       

       $mship=mysqli_query($config,"SELECT sum(amount) as amount FROM `purchas_wallet` WHERE user_id='$session_id' ");

       $memship=mysqli_fetch_object($mship);

        $memship_amount=$memship->amount;

       ?><div class='col-9'>

       <h4 style="

    text-align: center;

">Total Amount <br> Rs.<?php if($memship_amount){ echo $memship_amount;}else{echo'0';}?></h4></div>

    </div>

   

  </div>

</div>

		 
</div>

  <div class="card" style="width:100%;">

  <div class="card-body">

    <h5 class="card-title">Bidding Referal  Earnings</h5>

    <hr><br>

    <div class="row">

       <div class="col-3">

       <img src="ticket.png" width="100px"></div>

       <?php 

       $b_b="SELECT sum(e_amount) as amount FROM `biding_share_earn` WHERE cust_earn_id='$session_id' ";

       $mship=mysqli_query($config,$b_b);

       $memship=mysqli_fetch_object($mship);

        $memship_amount=$memship->amount;

       ?><div class='col-9'>

       <h4 style="

    text-align: center;

">Total Amount <br> Rs.<?php if($memship_amount){ echo $memship_amount;}else{echo'0';}?></h4></div>

    </div>

   

  </div>

</div>

		 

      </div>


      <div class="card" style="width:100%;">

  <div class="card-body">

    <h5 class="card-title">

Directory
 Referal  Earnings</h5>

    <hr><br>

    <div class="row">

       <div class="col-3">

       <img src="team.png" width="100px"></div>

       <?php 

       

       $mship=mysqli_query($config,"SELECT sum(dir_com_amount) as amount FROM `dir_commistion` WHERE dir_com_cid='$session_id' ");

       $memship=mysqli_fetch_object($mship);

        $memship_amount=$memship->amount;

       ?><div class='col-9'>

       <h4 style="

    text-align: center;

">Total Amount <br> Rs.<?php if($memship_amount){ echo $memship_amount;}else{echo'0';}?></h4></div>

    </div>

   

  </div>

</div>

		 

      </div>

      <!-- Footer -->


      <?php  include('menu.php');?> 
      <?php  include('footermenu.php');?> 
      <!-- Bootstrap core JavaScript -->

      <script src="vendor/jquery/jquery.min.js"></script>

      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

      <!-- slick Slider JS-->

      <script type="text/javascript" src="vendor/slick/slick.min.js"></script>

      <!-- Sidebar JS-->

      <script type="text/javascript" src="vendor/sidebar/hc-offcanvas-nav.js"></script>

      <!-- Custom scripts for all pages-->

      <script src="js/osahan.js"></script>

   </body>

</html>