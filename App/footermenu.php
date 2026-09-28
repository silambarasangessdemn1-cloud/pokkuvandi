<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 

<div class="osahan-menu-fotter fixed-bottom bg-white text-center border-top">

         <div class="row m-0">

            <a href="Directory.php" class="text-dark iconm small col font-weight-bold text-decoration-none p-2 ">

               <p class="h5 m-0"><i class=" icofont-grocery"></i></p>

              Home

            </a>
<!-- 
            <a href="Bidding.php" class="text-dark iconm small col font-weight-bold text-decoration-none p-2 ">

               <p class="h5 m-0"><i class="fa fa-bullhorn"></i></p>

               Buy Sale

            </a>
           -->
            <a href="<?php if ($session_id != NULL) {
               echo 'my_account.php';
            } else {
               echo 'signin.php';} ?>" class="text-muted iconm col small text-decoration-none p-2">

               <p class="h5 m-0"><i class="fa fa-group"></i></p>

               My Account

            </a>
            <?php

$sqln="SELECT * FROM `dir_vender` where cust_id='$session_id'";
 $mainmcate4=mysqli_query($config,$sqln);

if($mainmcate4->num_rows > 0)
{
   $mainmcate=mysqli_fetch_object($mainmcate4);
   $nn="SELECT count(dir_com_id) as total FROM `dir_com_enq` INNER JOIN dir_com_vender_enq ON dir_com_vender_enq.com_enq_id=dir_com_enq.dir_com_id where com_vid='$mainmcate->dir_vender_id' and stat='0' and view_enq_re='0' order by (dir_com_id) DESC ";            
$abountm=mysqli_query($config,$nn);
$delkk=mysqli_fetch_object($abountm);
          

      $delm=mysqli_fetch_object($abount);
      $n2b="SELECT count(dir_bu_id) as total FROM `dir_bussness` where vid='$mainmcate->dir_vender_id' and e_status='0' and enq_view='0' order by (dir_bu_id) DESC ";            
      $aboutb=mysqli_query($config,$n2b);
      
                      
      
         $delb=mysqli_fetch_object($aboutb);                    
      
      ?>
 


<a href="Business_Enquiry.php" class="text-muted small iconmv col text-decoration-none p-2 <?php 
   //   echo $del->rtotal;

   
    if($delkk->total == 0)
    {
      
    }else{
echo 'selected';
    }?>">

<p class="h5 m-0"><i class="fa fa-comment"></i></p>

Leads<span style="color: red;
    position: absolute;
    top: 8%;" class='leds'><?php 
   //   echo $del->rtotal;

   
    if($delkk->total == 0)
    {
      
    }else{
echo $delkk->total;
    }?></span>

</a>
<?php }?>



           
   <a href="help_support.php" class="text-muted col iconm small text-decoration-none p-2">

<p class="h5 m-0"><i class="fa fa-newspaper-o"></i></p>

Contact us
</a>
<!-- <a class="toggle ml-3 text-muted col iconm small text-decoration-none p-2" href="#"><i class="icofont-navigation-menu"></i>
Menu
</a> -->

<a href="#" class="text-muted col iconm small text-decoration-none p-2 toggle">

<p class="h5 m-0"><i class="fa fa-bars" aria-hidden="true"></i>
</p>
<p style="
    font-size: 15px;margin-top: 8px;
">Menu</p>
</a>
            
<!-- <a href="state_type_choose.php" class="text-muted col iconm small text-decoration-none p-2">

<p class="h5 m-0"><i class="fa fa-car"></i></p>
Pokkuvandi 
</a> -->
        
         </div>

      </div>

      <style>
         .osahan-menu-fotter{
            background-color: #199b37   !important;
         }
         .iconm{
            color: #000000!important;
         }
         .iconmv.selected{
            color: var(--red) !important;
         }
      </style>