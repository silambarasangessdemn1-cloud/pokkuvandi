<?php include('config/setup.php');?>

<?php include('session.php');

// Check if user is logged in
if (!isset($session_id) || empty($session_id)) {
    // Redirect to login page if not logged in
    header("Location: signin.php");
    exit();
}

$mid=$_REQUEST['mid'];
$session__phone; 

 $sqln_="SELECT *  FROM `create_post` inner join call_click_count on call_click_count.post_id = create_post.post_id where create_post.customer_id='$session_id' ";
$mainmcate__=mysqli_query($config,$sqln_);
while($mainmcate_=mysqli_fetch_object($mainmcate__))
{
 $post_id= $mainmcate_->post_id;
 $addmaincate=mysqli_query($config,"update call_click_count set status_read='1' where post_id='".$post_id."'");
    

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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
     
            <script src="
      https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js
      "></script>
      <link href="
      https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css
      " rel="stylesheet">

   </head>
   

   <body>
   <style>
.owl-prev {
    position: absolute;
    top: 48%;
    color: blue !important;
    display: none;
}
.owl-next {
    position: absolute;
    left: 96%;
    color: blue !important;    
    top: 49%;
    display: none;
}
.heading_webkit
{
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
     overflow: hidden;
}


.switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 18px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 10px;
    width: 18px;
    left: 8px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
.post_text
{
  background: #e9ecef;
}
</style>
<?php include('Directory_topmenu.php');?>
   
        <div class="mt-3 mb-3" >
            <!-- <center> 
                <a href="create_post.php" class="btn btn-success">
                    <i class="fas fa-plus"></i>   Create Post
                </a>
            </center> -->
        </div>

       
         <div class="osahan-body">

         
                   
                     <div class="row p-2">
                     <?php
                     $current_Date=date('Y-m-d');
                            $i=0;
                            $or="SELECT * FROM `create_post` inner join call_click_count on call_click_count.post_id = create_post.post_id   where create_post.customer_id='$session_id' Order by call_click_count.call_count_id DESC limit 10";
                            $maincate3=mysqli_query($config,$or);             
                            while($mac3=mysqli_fetch_object($maincate3))
                            {                   
                              $originalDate = $mac3->click_date;
                          $newDate = date("d-m-Y h:i a", strtotime($originalDate));
                        ?>  
                    <div class="col-12 col-sm-12 col-md-12">                      
                        <h6 style="color:blue;font-weight: 700;" class="heading_webkit">Customer Phone Number - <?php echo $mac3->phone_number?> </h6>
                        <p style="font-weight: 600;">Date - <?php echo $newDate ;?></p>
                        <hr>
                    </div>
                     
                    <?php } ?>
                </div>    
               
              
                            
        
                                  
        </div>                            
       
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


        <?php
                    $pro_page = '3';
                include('footermenu.php');?>
                <?php include('menu.php');?> 

     <?php include('menu.php');?> <!-- Bootstrap core JavaScript -->

      <script src="vendor/jquery/jquery.min.js"></script>

      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

      <!-- slick Slider JS-->

      <script type="text/javascript" src="vendor/slick/slick.min.js"></script>

      <!-- Sidebar JS-->

      <script type="text/javascript" src="vendor/sidebar/hc-offcanvas-nav.js"></script>

      <!-- Custom scripts for all pages-->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
      
      <script src="js/osahan.js"></script>
      <script>
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        autoplay: true,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });
    $(".owl-prev").html('<i class="fa fa-chevron-left"></i>');
     $(".owl-next").html('<i class="fa fa-chevron-right"></i>');

    </script>
    





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


<script>


  $("#main_city").change(function(){
    $('#exampleModalcity').modal('toggle');
  var city=$("#main_city").val();
  var city_name=$("#main_city :selected").text();
  $.ajax({
        type: "POST",
        url: "se_city.php",
        data: {city:city,city_name:city_name}, 
        success: function(data)
        {
         $('#city_name').html( city_name);
        }
    });

});
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

$( document ).ready(function() {

var id=$('#set_city').val();
if(id == 0){
//   $('#exampleModalcity').modal('show'); 
}else{

}
});



function openedit(id){
                    var id;
                   //alert(id);
             
                    $.ajax({
                        type: "POST",
                        url:'post_edit_field.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                           //alert(data);		
                        $('#postform').html(data);
                        
                        }		
                        	
                    });	
                    

                }

                

                function deletepost(id){
                    var id;
                  // alert(id);
             
                    $.ajax({
                        type: "POST",
                        url:'delete_popup.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                            //alert(data);		
                        $('#deletepopup').html(data);
                        
                        }		
                        	
                    });	
                    

                }




               




            function openPopup(id){
                    var id;
                   //alert(id);
             
                    $.ajax({
                        type: "POST",
                        url:'city_update.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                           // alert(data);		
                        $('#citypopup').html(data);
                        
                        }		
                        	
                    });	
                    

                }

                function diablePopup(id){
                    var id;
                   //alert(id);
             
                    $.ajax({
                        type: "POST",
                        url:'disable_update.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                           // alert(data);		
                        $('#diablepopup').html(data);
                        
                        }		
                        	
                    });	
                    

                }


                function loader(id)
                {
                  var id;
                  $.ajax({
                        type: "POST",
                        url:'loader_popup.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                           //alert(data);		
                           $('#loaderupdate').html(data);
                        }			
                    });	

                }
                function loaderpopup(id){
                  var id;
                   //alert(id);
                   var loader_from_date = $('#loader_from_date').val();
                   var loader_to_date = $('#loader_to_date').val();
                   var loader_from_place = $('#loader_from_place').val();
                   var loader_to_place = $('#loader_to_place').val();
                   var loader_space = $('#loader_space').val();
                   var loader_remarks = $('#loader_remarks').val();
                   var post_id = $('#post_id').val()
                    $.ajax({
                        type: "POST",
                        url:'loader_popup_insert.php',
                        data: {id:id,loader_from_date:loader_from_date,loader_to_date:loader_to_date,loader_from_place:loader_from_place,loader_to_place:loader_to_place,post_id:post_id,loader_space:loader_space,loader_remarks:loader_remarks}, // serializes the form's elements.
                        success: function(data)
                        {	
                           //alert(data);		
                          //console.log(data);
                           if(data == 1)
                            {
                                    
                                  // $(".alertload").attr("style", "display: block;padding:20px;");
                                  // $(".alertload").delay(1000).fadeOut(500);
                                
                                  // $('.msgload').html("Loader Updated ");   
                                  
                                  Swal.fire({
                                  position: 'center',
                                  icon: 'success',
                                  title: 'Loader Details Updated',
                                  showConfirmButton: false,
                                  timer: 1500
                                  })


                                  setTimeout(function() {
                                    $('#exampleModalloader').modal('hide');
                                    }, 1000);
                                    setTimeout(() => { 
                                            location.reload();
                                    }, 2000);

                            }
                        }			
                    });	
                }



              
                function sub_area(id){
                //alert();
                var id =id;
                var kmid =$('#kmid').val();
            
            $.ajax({
                type: "POST",
                url: "sub_area_post.php",
                data:{id:id,kmid:kmid}, 
                success: function(data)
                {
                  //alert(data);
                $('#subarea1').html(data);

                console.log(data);
                }
            });
            }
</script>


   </body>

</html>
