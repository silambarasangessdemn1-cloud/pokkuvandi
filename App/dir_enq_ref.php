<?php include('config/setup.php');?>

 <?php include('session.php');

 

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
      <!-- sign in -->
      <div class="osahan-signin">
         <div class="border-bottom p-3 d-flex align-items-center" style="background-color:#68ba61;">
        <center> <img class="index-osahan-logo" src="
            <?php 
            
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
            
            
            
            
            
            " alt="leefoodies Logo" style="
    height: 51px;
"></center>
         <h4>
         <?php $pro_page=2; ?>  Directory  </h4>
        
             


         </div>
		 
	 
 
		 
         <div class="p-3">
           
         <form  id='cform'>

<div class="form-group">

<label for="exampleInputEmail1">Name</label>

<input type="text" name='name' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $session__username;?>" placeholder="" required>
<input type="hidden" name='send_email' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value='<?php echo $logo22->Email_id ?>' >
<input type="hidden" name='rid' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value='<?php echo $_GET['rid']?>' >

</div>

<div class="form-group">

<label for="exampleInputEmail1">E-Mail address</label>

<input type="email" name='email' class="form-control" id="exampleInputEmail1"  aria-describedby="emailHelp" value="<?php echo $session__mail;?>" placeholder="" >

</div>


<div class="form-group">

<label for="exampleInputEmail1">City</label>
<select id="enq_city" name="enq_city" class="form-select form-control form-select-lg mb-3" aria-label=".form-select-lg example">
<option  valu=''>Select City</option>
  <?php

											$main_cate3=mysqli_query($config,"SELECT * FROM `dir_city_master`");

											while($macate3=mysqli_fetch_object($main_cate3))

											{

											?>
  <option  value="<?php echo $macate3->dir_city_id ?>"><?php echo $macate3->dir_city_name ?></option>
<?php }?>
</select>  
</div>

<div class="form-group">
<label for="exampleInputEmail1">Area</label>
<div id="enq_earea">
 
</div>
<div class="form-group">

<label for="exampleInputPassword1">Phone Number</label>

<input type="number" name='phone' class="form-control" id="exampleInputPassword1" value="<?php echo $session__phone; ?>"  placeholder="" required>

</div>

<div class="form-group">

<label for="exampleInputPassword1">Message</label>

<textarea name='msg' class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>  </div>



<button style="width: 100%;" type="submit" class="btn btn-primary">Submit</button>  



</form>
<p id="t"></p>
           

<?php include('promo_footermenu.php');?>
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

<script>

   $("#cform").submit(function(e) {



e.preventDefault(); // avoid to execute the actual submit of the form.


var form = $(this);

var actionUrl = 'bussiness_contact.php';

// $("#exampleModal").modal('hide');

$.ajax({

    type: "POST",

    url: actionUrl,

    data: form.serialize(), // serializes the form's elements.

    success: function(data)

    {

    //    alert(data); 
// $('#t').html(data);
      if(data == 1)

      {

window.location.href = "Directory.php";
         $('#cform')[0].reset();

         // $('#modal').modal('hide');

        //  $('.modal').modal('toggle'); 

         $("#exampleModal").modal('toggle');

         // setTimeout(function(){ $(".alert").show(); }, 3000); 
         $(".alert").attr("style", "display: block;");


// Show the div in 5s
// $(".alert").delay(3000).fadeOut(500);
      }

    }

});



});
</script>

<script>
    $("#enq_city").change(function(){
   
   var city=$("#enq_city").val();
 
   $.ajax({
         type: "POST",
         url: "dir_enq_city.php",
         data: {city:city}, 
         success: function(data)
         {
          $('#enq_earea').html(data);
         }
     });
 
 });

</script>