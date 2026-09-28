<?php include('config/setup.php');?>



 <?php include('session.php');



 



	?>

   <?php



$ms="SELECT * FROM `membership_list` where user_id='$session_id'";



$msql=mysqli_query($config,$ms);



$msqld=mysqli_fetch_object($msql);



if($msqld->user_id)



{



 





}else{

   

  header("location:membershipview.php");



  die;

}



?>



<?php



 $ms="SELECT * FROM `membership_list` where user_id='$session_id'";



 $msql=mysqli_query($config,$ms);



 $msqld=mysqli_fetch_object($msql);



if($msqld->user_id)



{



  



   



}else{



//     header("location:index.php");



//    die;



}



?>



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



   

<?php



				 



$about=mysqli_query($config,"select * from membership");







$del=mysqli_fetch_object($about);







?>         

<meta name="twitter:card" content="summary" />



<meta name="twitter:site" content="https://callinfo.in/App/membershipdetails.php" />

<meta name="twitter:creator" content="callinfo" />

<meta property="og:image" content="https://callinfo.in/<?php  echo  $new_str = str_replace('../','', $ms);

 ?>" />			

<meta property="og:title" content="<?php echo $del->referal_script_title;

   ?>"/> 

    <meta name="author" content="<?php  

     echo $del->referal_script_title;

       ?>">

             <meta property="og:url" content="https://<?php echo $_SERVER['SERVER_NAME'] ?>/App/membershipdetails.php" />



<meta property="og:type" content="website" />

<meta property="og:description" content="<?php echo $del->referal_script_title;  ?>"/>

 <meta name="description" content="<?php echo $del->referal_script_title;  ?>">

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



   <body>



      <div class="theme-switch-wrapper">



         <label class="theme-switch" for="checkbox">



            <input type="checkbox" id="checkbox" />



            <div class="slider round"></div>



            <i class="icofont-moon"></i>



         </label>



         <em>Enable Dark Mode!</em>



      </div>



      <div class="osahan-help">



         <div class="p-3 border-bottom bg-white">



            <div class="d-flex align-items-center">



               <a class="font-weight-bold text-success text-decoration-none" href="home.php">



               <i class="icofont-rounded-left back-page"></i></a>



               <h6 class="font-weight-bold m-0 ml-3">Reports</h6>



               <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>



            </div>



         </div>



      </div>





      

         



        



         <?php 



 $sql = "SELECT * FROM `membership_list` where user_id='$session_id'";



$result = mysqli_query($config, $sql);















  $data=mysqli_fetch_object($result);



  



  



   $data->ex_date;



  



   // $date_now = new DateTime();



   // $date2    = new DateTime($data->ex_date);



  





  $usm=mysqli_query($config,"SELECT * FROM `membership_list` where user_id='$session_id'");



				 



  $udel=mysqli_fetch_object($usm);

 ?>







      



      <div class="osahan-promo">

       

		 

			   

		 

         <a href="#" class="text-decoration-none text-white">

            <div class="bg-success p-3 text-white" style='display:none'>

               <div class="row align-items-center">

                  <div class="col-6">

                     <div class="d-flex align-items-center">

                      

                      

                     	 <h5><?php echo $del->title; ?></h5>

			   

                     </div>

                     <div class="pt-3">

                        

                         <?php 

                         $copy='https://'.$_SERVER['SERVER_NAME'].'/App/memberferealorder.php?amount='.$del->price.'&planid=1&refcode='.$udel->unique_id.'';

                         $copy = str_replace(' ', '', $copy);

                         ?>



                                                <textarea id="input" class="js-copytextarea9" readonly="" style="height: 23px;"><?php echo $copy?></textarea>

						    <button onclick="copyText()" class="js-textareacopybtn9 btn btn-outline-light" style="vertical-align:top;">COPY NOW</button>

					 <script>

function copyText(){

   var copyText = document.getElementById("input");



/* Select the text field */

copyText.select();

copyText.setSelectionRange(0, 99999); /* For mobile devices */



/* Copy the text inside the text field */

navigator.clipboard.writeText(copyText.value);



/* Alert the copied text */

}





</script>	   

                     </div>

                  </div>

                  <div class="col-6 text-center">

                     <img src="referafriend.png" class="img-fluid">

                  </div>

               </div>

            </div>

         </a>

         <div class="promo_detail">

            <div class="title p-3 bg-white shadow-sm">

               <h5 class="font-weight-bold text-success">Referal Code: <?php echo $udel->unique_id ?> </h5>

               <?php   if ($date_now > $date2) {



echo '<a href="mrenewal.php" style="color:white;margin-bottom: 22px;

" type="button" class="btn btn-danger">Renewal Membership</a>



';



}else{

?>

               <p class="font-weight-bold mb-2">Membership Expiry Date: <?php echo $udel->ex_date ?></p>



<?php





}?>

<br>

               <center style='display:none'>  

    <?php

     $share='https://callinfo.in/App/memberferealorder.php?amount='.$del->price.'%26planid=1%26refcode='.$udel->unique_id.'';

     $share = str_replace(' ', '', $share);

?>

                   <a href="https://api.whatsapp.com/send?text=<?php echo $del->referal_script;?> <?php echo $share; ?>  " data-action="share/whatsapp/share" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" class="font-weight-bold text-white text-decoration-none ml-2" target="_blank" title="Share on whatsapp"><i class="icofont-whatsapp p-2 bg-success shadow-sm rounded-circle"></i></a>

            <a href="https://www.facebook.com/sharer/sharer.php?u=https://<?php echo $_SERVER['SERVER_NAME'] ?>/App/memberferealorder.php?amount=<?php echo $del->price;?>&planid=1&refcode=<?php echo $udel->unique_id?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" class="font-weight-bold text-white text-decoration-none ml-2" target="_blank" title="Share on Facebook"><i class="icofont-facebook p-2 bg-primary shadow-sm rounded-circle"></i></a>

		<a href="https://twitter.com/share?url=<?php echo $del->referal_script; ?> <?php echo $share; ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" class="font-weight-bold text-white text-decoration-none ml-2" title="Share on Twitter"><i class="icofont-twitter p-2 bg-primary shadow-sm rounded-circle"></i></a>

 		<a href="mailto:?subject=Leefoodies&body=<?php echo $del->referal_script; ?> <?php echo $share; ?>" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Mail" class="font-weight-bold text-white text-decoration-none ml-2"><i class="icofont-email p-2 bg-danger shadow-sm rounded-circle"></i></a></center>

            </div>

           

         

         </div>

		 

			

      </div>

<hr>

<?php 

 $f=$_GET["fromdate"];

 $f1=$_GET["fromdate"];

 $fromdate=date('Y-m-d H:i:s', strtotime($f));

 $fromdate1=date('Y-m-d', strtotime($f1));



$tdate=$_GET['todate'];

$tdate1=$_GET['todate'];

 $todate=date('Y-m-d H:i:s', strtotime($tdate));

 $todate1=date('Y-m-d', strtotime($tdate1));



?>

<div class="container">

<form action="#" method="GET">

  <div class="form-row">

    <div class="col-4">

    <label for="inputState">From Date</label>

      <input type="date" name="fromdate" value="<?php  echo  $f1 ?>" class="form-control" >

    </div>

    <div class="col-4">

    <label for="inputState">To Date</label>



      <input type="date" name="todate" value="<?php echo  $tdate1 ?>" class="form-control" placeholder="Last name">

    </div>

    <div class="col-4">

    <button style='margin-top: 19px;' type="submit" class="btn btn-primary">Submit</button>    </div>

  </div>

</form></div>

<br>

      <div class="container" style="    margin-bottom: 100px;">



      <?php  



                 $mid=$udel->memeber_id;



                 $msql="SELECT * FROM `membership_list` WHERE (created_at BETWEEN '$fromdate' AND '$todate') AND member_referraid='$mid'";

                $memcount=mysqli_query($config,$msql);



				while($mem=mysqli_fetch_object($memcount))



                {







                 ?>



      <div class="card" style="margin-bottom: 2%;">



  <div class="card-body">



      <div class="row">



          <div class="col-3">



              <img src="teamwork.png" style="width:65px;">



          </div>



          <div class="col-9">



              <?php $id=$mem->user_id; $csql=mysqli_query($config,"SELECT * FROM `customer_master` WHERE Customer_Id='$id'");



				 



                 $cde=mysqli_fetch_object($csql);?>



    Name: <?php echo $cde->Customer_Name ?><br>



    Phone Number: <?php echo $cde->Customer_Phone_No ?><br>



    Email : <?php echo $cde->Customer_Mail_id ?><br>

    Expired date : <?php echo $mem->ex_date ?><br>



    <?php  $msql1="SELECT count(member_referraid) as total FROM `membership_list` where member_referraid='$mem->memeber_id'";



                $memcount1=mysqli_query($config,$msql1);



				$mem1=mysqli_fetch_object($memcount1);?>



    Downline Members : <?php echo $mem1->total ?><br>



</div>



      </div>



  </div>



  



</div><?php }?>



      </div>



      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



  <script>



$(document).ready(function(){



  $("#more").click(function(){



     



   



      $(".teaser").attr("style", "display: none;");



      $(".complete").attr("style", "display: block;");



      $("#more").attr("style", "display: none;");



      });



      



});



</script>



      <style>



    .complete{



    display:none;



}



.boxs



   {



    box-shadow: 0 3px 10px rgb(0 0 0 / 20%);



    padding: 15px;



}



}



.more{



    background:lightblue;



    color:navy;



    font-size:13px;



    padding:3px;



    cursor:pointer;



}



body {



    font-family: 'Ubuntu', sans-serif;



    font-size: 13px;



    background-color:white;



}



iframe{



   width:100%;



   height: 300px;



}



</style>



         <?php include('footermenu.php');?>



      <?php include('menu.php')?> 



    



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







