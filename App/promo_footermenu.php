<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 

<div class="osahan-menu-fotter fixed-bottom text-center border-top">

         <div class="row m-0">

            <a href="Directory.php" class="text-dark iconm small col font-weight-bold text-decoration-none py-1 px-1">

               <p class="h5 m-0"><i class=" icofont-grocery"></i></p>

           Home

            </a>

           
            <a href="<?php if ($session_id != NULL) {
               echo 'my_account.php';
            } else {
               echo 'signin.php';} ?>" class="text-muted iconm col small text-decoration-none py-1 px-1">

               <p class="h5 m-0"><i class="fa fa-group"></i></p>

               Account

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
 


<a href="Business_Enquiry.php" class="text-muted small iconmv col text-decoration-none py-1 px-1 <?php 
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



           
   <a href="help_support.php" class="text-muted col iconm small text-decoration-none py-1 px-1">

<p class="h5 m-0"><i class="fa fa-newspaper-o"></i></p>

Contact us
</a>

            

         </div>

      </div>

      <style>
         .osahan-menu-fotter{
            background-color: #199b37 !important;
            height: auto !important;
            min-height: 48px !important;
            padding-top: 3px !important;
            padding-bottom: calc(env(safe-area-inset-bottom, 0px) + 3px) !important;
            z-index: 1040;
         }
         @media screen and (max-width: 768px) {
            .osahan-menu-fotter {
               height: auto !important;
               min-height: 48px !important;
               padding-top: 3px !important;
               padding-bottom: calc(env(safe-area-inset-bottom, 0px) + 3px) !important;
            }
         }
         @media all and (display-mode: standalone), all and (display-mode: fullscreen) {
            .osahan-menu-fotter {
               height: auto !important;
               min-height: 48px !important;
               padding-top: 3px !important;
               padding-bottom: calc(env(safe-area-inset-bottom, 0px) + 4px) !important;
            }
         }
         .is-standalone-app .osahan-menu-fotter {
            height: auto !important;
            min-height: 48px !important;
            padding-top: 3px !important;
            padding-bottom: calc(env(safe-area-inset-bottom, 0px) + 4px) !important;
         }
         .osahan-menu-fotter a.iconm,
         .osahan-menu-fotter a.iconmv {
            color: #000000 !important;
            padding: 3px 2px !important;
            font-size: 11px !important;
            line-height: 1.2 !important;
         }
         .osahan-menu-fotter a.iconm p,
         .osahan-menu-fotter a.iconmv p {
            font-size: 18px !important;
            line-height: 1.2 !important;
            margin-bottom: 2px !important;
         }
         .osahan-menu-fotter a.iconm p i,
         .osahan-menu-fotter a.iconmv p i {
            font-size: 18px !important;
         }
         .iconmv.selected{
            color: var(--red) !important;
         }
      </style>