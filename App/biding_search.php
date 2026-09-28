<?php include('config/setup.php')?>

<?php include('session.php');?>

<?php $pro_page=3; ?>

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

	    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

  

<style>



a:hover {

   cursor: pointer;

   background-color: yellow;

}





</style>





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

	   <form action="#" method="POST">

      <div class="osahan-search">

         <div class="p-3 border-bottom">

            <div class="d-flex align-items-center">

               <a class="back" href="Bidding.php">

               <i class="icofont-rounded-left back-page"></i></a>

              

			   

			   <div class="input-group ml-3 rounded shadow-sm overflow-hidden bg-white">

                 

                  <input type="text"  id="keyword" class="shadow-none border-0 form-control pl-0" name="search" placeholder=" &nbsp;Search for Keyword.." >

                 

            <div class="input-group-prepend">

                     <button type="button" name="search_now"  class="btn btn-secondary text-success"><i class="icofont-search" style="color: white;"></i></button>

                  </div>

				 

               </div>

			 

			 

			   

            </div>

         </div>

      </div>

      </form>
      <div class='container osahan-categories'>
          <div style="padding: 3%;margin-bottom:3%;" id="keydata" class="row">
    
      </div>
      </div>
      <?php include('promo_footermenu.php');?>
      <?php include('menu.php');?> 


	  

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#keyword").keyup(function(){
var key=$('#keyword').val();
  console.log(key);
  $.ajax({
        type: "POST",
        url: 'keyword_search.php',
        data: {key:key}, // serializes the form's elements.
        success: function(data)
        {
          $('#keydata').html(data);
        }
    });
  });

});
</script>

<style>
   .back:hover {
      color: black !important;
    background: white;
   }
   a:hover {
      color: white !important;
    background: white;
   }
   input[type=text] {
       margin-left: 4%;
       }
       .c-it {
    height: 106px;
}
</style>