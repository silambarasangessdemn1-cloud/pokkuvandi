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

	    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

  

<style>



a:hover {

   cursor: pointer;

   background-color: yellow;

}





</style>

<?php $pro_page=2; ?>



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

	   <form action="search.php" method="POST">

      <div class="osahan-search">

         <div class="p-3 border-bottom">

            <div class="d-flex align-items-center">

               <a style="margin-top: 4%;
    padding-right: 3%;" class="back" href="Directory.php">

               <i class="icofont-rounded-left back-page"></i></a>

              

			   
<form id="search">
               <div  class="input-group mt-3 rounded shadow-sm overflow-hidden bg-white">
                  <!-- <div class="input-group-prepend">
          <span class="input-group-text" id="city_name">  
                <select id="city" name="city" class="form-control" id="exampleFormControlSelect1">
                <?php 

$mc=1;

$main_cates1=mysqli_query($config,"SELECT * FROM `dir_city_master`");

while($macates2=mysqli_fetch_object($main_cates1))

{

?>
      <option <?php if($_SESSION["city"] ==  $macates2->dir_city_id){ echo 'selected';} ?>  value="<?php echo $macates2->dir_city_id?>"><?php echo $macates2->dir_city_name?></option>
     <?php }?>
    </select></span>
        </div> -->
                  <input id="keyword" name="keyword" style="background-color: white;" list="heroes" type="text" id="catesearch1" class="shadow-none border-0 form-control pl-0 " placeholder=" &nbsp;Choose  Category.." aria-label="" aria-describedby="basic-addon1">
<datalist id="heroes" style="overflow-y: scroll;height:100px;">
<?php 

$mc=1;

$main_cates=mysqli_query($config,"SELECT * FROM `dir_post` order by (dir_keyword) ASC");

while($macates=mysqli_fetch_object($main_cates))

{

?>
  <option value="<?php echo $macates->dir_keyword?>">
 <?php }?>
     
</datalist></div>
</form>
			 

			 

			   

            </div>

         </div>

      </div>
      <div class="row m-2" style="margin-bottom:3%;" id="result">


</div>
<script>
    $("#keyword").keyup(function(){
     var key=$("#keyword").val(); 
    
   $.ajax({
        type: "POST",
        url: "dir_keyword_search.php",
        data: {key:key}, // serializes the form's elements.
        success: function(data)
        {
        $('#result').html(data);
        }
    });
});
</script>
<style>
    .input-group-text {
        padding: 0px;
    }
</style>
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