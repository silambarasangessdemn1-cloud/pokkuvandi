<?php include('config/setup.php');?>

 <?php include('session.php');
	?>


<?php

// $mid=$_POST['mid'];
 $sid= $_SESSION['sid'];
 $mid= $_SESSION['mid'];

  $_POST['area'];
 $_SESSION['area'] = $_POST['area'];
$current_Date=date('Y-m-d');
                   
                          if($_POST['area'] == 1){

                            echo $or="SELECT * FROM `create_post` WHERE ((`loader_from_date` >= '$current_Date' and loader_status ='1' and disable_status='0' and city_id = '".$_SESSION["city"]."' and category_id = '$mid' and subcategory_id='$sid' and delete_approval_status ='0' and expiry_date >= '$current_Date')) OR ((`loader_to_date` >= '$current_Date' and loader_status ='1' and disable_status='0' and city_id = '".$_SESSION["city"]."' and category_id = '$mid' and subcategory_id='$sid' and delete_approval_status ='0' and expiry_date >= '$current_Date') )  and loader_status ='1' and disable_status='0' and city_id = '".$_SESSION["city"]."' and category_id = '$mid' and subcategory_id='$sid' and delete_approval_status ='0'  and expiry_date >= '$current_Date' ORDER BY post_id DESC ";

                           //  $or="SELECT * FROM `create_post` WHERE ((`loader_from_date` >= '$current_Date') AND (`loader_to_date` <= '$current_Date'))    OR   ((`loader_from_date` >= '$current_Date') AND (`loader_to_date` <= '$current_Date')) and loader_status ='1' and disable_status='0' and city_id = '".$_SESSION["city"]."' and category_id = '$mid' and subcategory_id='$sid' and delete_approval_status ='0' ORDER BY post_id DESC ";
                            
                          }else{
                             echo $or="SELECT * FROM `create_post`  WHERE  ((`loader_from_date` >= '$current_Date'  and loader_status ='1' and disable_status='0' and city_id = '".$_SESSION["city"]."' and area_id='".$_POST['area']."' and category_id = '$mid' and subcategory_id='$sid' and delete_approval_status ='0' and status='1' and expiry_date >= '$current_Date' )) OR ((`loader_to_date` >= '$current_Date'  and loader_status ='1' and disable_status='0' and city_id = '".$_SESSION["city"]."' and area_id='".$_POST['area']."' and category_id = '$mid' and subcategory_id='$sid' and delete_approval_status ='0' and status='1' and expiry_date >= '$current_Date'))   ";
                                        
                         }
                         $maincate3=mysqli_query($config,$or);
                                                $ldata[]= mysqli_num_rows($maincate3);
                                                while($mac3__=mysqli_fetch_object($maincate3))    
                                                {

                                                  $loader_to_date= $mac3__->loader_to_date;
                                                  $loader_to_time= $mac3__->loader_to_time;
                                                  $loader_from_date= $mac3__->loader_from_date;
                                                  $loader_from_time= $mac3__->loader_from_time;
                                                  $post_id= $mac3__->post_id;

                                                    $from_date_time = date('Y-m-d H:i', strtotime("$loader_from_date $loader_from_time"));
                                                    $to_date_time = date('Y-m-d H:i', strtotime("$loader_to_date $loader_to_time"));

                                                  $from_date_time__ = date('d-m-Y h:i a', strtotime("$loader_from_date $loader_from_time"));
                                                  $to_date_time__ = date('d-m-Y h:i a', strtotime("$loader_to_date $loader_to_time"));

                                                  date_default_timezone_set('Asia/Kolkata');
                                                     $date_time=date('Y-m-d H:i');
                                                   


                                                  // if(($from_date_time >= $date_time) OR ($to_date_time <= $date_time ))
                                                  if(($date_time >= $from_date_time) OR ($date_time <= $to_date_time))
                                                  {
                                                    $or_item="SELECT * FROM `create_post` WHERE post_id='$post_id'  ORDER BY post_id DESC  ";
                                                   
                                                 
                                                  
                                                  $maincate3__=mysqli_query($config,$or_item);
                                                  $ldata[]= mysqli_num_rows($maincate3__);
                                                  $mac3=mysqli_fetch_object($maincate3__);   

                                                    $city_id= $mac3->city_id;
                                                    $night_duty = $mac3->night_duty;
                                                    // if($night_duty == 2)
                                                    // {
                                                    //   $night="Night Duty";
                                                    // }
                                                   $or_="SELECT * FROM `dir_city_master` where dir_city_id  ='$city_id' Order by dir_city_id   DESC ";
                                                   $maincate3_=mysqli_query($config,$or_);       
                                                   $mac3_=mysqli_fetch_object($maincate3_);  


                                                   $area_id= $mac3->area_id;      
                                                   $orarea_="SELECT * FROM `dir_area_master` where dir_area_id ='$area_id' Order by dir_area_id   DESC ";
                                                   $orarea3_=mysqli_query($config,$orarea_);       
                                                   $area3__=mysqli_fetch_object($orarea3_);

                                                   $vehicle_type_id= $mac3->vehicle_type_id;   
                                                   $orvehicle_="SELECT * FROM `vehicle_type` where Vehicle_type_id ='$vehicle_type_id' Order by Vehicle_type_id   DESC ";
                                                   $orvehicle_type=mysqli_query($config,$orvehicle_);       
                                                   $orvehicle___=mysqli_fetch_object($orvehicle_type);  
                                              

                               
 $data .=' <div class="card" style="width: 100%; padding: 0%;margin-bottom:2px;">
 <div class="card-body" style="padding:1px">
   
      <div class="row">
      
        <div class="col-4 d-flex">
      
          <img src="../photos/vehicle/'. $mac3->vehicle_photo.'" style="width: 100px;height: 100px;margin: auto;">
        </div>
        <div class="col-8">   
        <div class="row">

        <div class="col-6">  
        </div>
        <div class="col-6 mt-2">  
        <p  style="text-align: center;
        color: gray;
        background: #199b37;
        color: white;
        border-radius: 50%;" >'.$night .' </p>
        </div>

        
        </div>
          <h6 class="mt-2" style="color:blue;font-weight: 700;"> '.$mac3->vehicle_name.'</h6>
          <p style="text-transform: capitalize;color: #000;font-weight: 500;"><i class="fas fa-car-side"></i> '. $mac3->vehicle_no.' </p>
            <p style="text-transform: capitalize;"> <span style="color: #000;font-weight: 400;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;">'.$orvehicle___->Vehicle_type_name.'</span></p>
                <!-- Get Detail -->
                <p style="text-transform: capitalize;"> <span style="color: #000;font-weight: 400;">'. $vehicle_no.'</span></p>

                ';
                if($mac3->category_id =='1')  
                {
                  $data .='   <p style="text-transform: capitalize;color: #000;font-weight: 500;">Tonnage - '.$mac3->tonnage.'</p>';
                }

                $data .='  
                <p style="text-transform: capitalize;"> <span style="color: #000;font-weight: 400;">From Place : '.$mac3->loader_from_place.'</span></p>
                <p style="text-transform: capitalize;"> <span style="color: #000;font-weight: 400;">To Place : '.$mac3->loader_to_place.'</span></p>
                <p style="text-transform: capitalize;"> <span style="color: #000;font-weight: 400;">From Date & time : '.$from_date_time__.'</span></p>
                <p style="text-transform: capitalize;"> <span style="color: #000;font-weight: 400;">To Date & time : '.$to_date_time__.'</span></p>
                <p style="text-transform: capitalize;color: #000;font-weight: 500;">Available Space - '.$mac3->loader_space.'</p>
                <p style="text-transform: capitalize;color: #000;font-weight: 500;">Stand Name - '.$mac3->stand_name.'</p>
                 <p style="text-transform: capitalize;color: #000;font-weight: 500;">Active Current Location - '.$mac3->Add_location.'</p>
                <p style="text-transform: capitalize;color: #000;font-weight: 500;color:blue">'. $mac3_->dir_city_name.','. $area3__->dir_area_name.'</p>
                <p style="text-transform: capitalize;color: blue;font-weight: 800;font-size: 14px;"><i class="fa fa-phone"></i>  '. $mac3->whatsapp_no.'</p>
        </div>
      </div>
  
  </div>
</div>';
 }   }

 if((($ldata[0] == 0) && ($ldata[1] == 0)) && (($ldata[2] == 0)&&($ldata[3] == 0)))
{
  $data .='<img src="data1.png" style="width: 100%;">';
 }


 echo $data ;?>


