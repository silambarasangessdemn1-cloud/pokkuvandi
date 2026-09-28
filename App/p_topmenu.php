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

      //  echo  $lee[0];
      echo 'Promotion';

   }else{

       echo "Need Name";

   

   }

   

               }

               

               ?> </h6>

               </a>

               <p class="ml-auto m-0">

                  

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
                  <div  class="input-group mt-3 rounded shadow-sm overflow-hidden bg-white">
                  <input style="background-color: white;" list="heroes" type="text" id="catesearch1" class="shadow-none border-0 form-control pl-0 " placeholder=" &nbsp;&nbsp;Choose  Category.." aria-label="" aria-describedby="basic-addon1">
<datalist id="heroes" style="overflow-y: scroll;height:100px;">
<?php 

$mc=1;

$main_cates=mysqli_query($config,"SELECT * FROM `promote_category` order by title ASC");

while($macates=mysqli_fetch_object($main_cates))

{

?>
  <option value="<?php echo $macates->title?>">
 <?php }?>
     
</datalist></div>
                  <br>
                  <div style='display:none;' class="alert alert-success" role="alert">
                <b>  Thank you for getting in touch! </b>

We appreciate you contacting us callinfo . One of our colleagues will get back in touch with you soon!Have a great day!
</div>

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
            .fixed-bottom-padding .theme-switch-wrapper {
    bottom: 70px;
    display: none;
}
            </style>