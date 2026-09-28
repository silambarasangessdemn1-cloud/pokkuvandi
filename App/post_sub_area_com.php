<?php include('config/setup.php');?>

 <?php include('session.php');
	?>


<?php

$mid=$_POST['mid'];

$sid= $_SESSION['sid'];
$mid= $_SESSION['mid'];     
  $_main_area = $_SESSION['area'];

  date_default_timezone_set('Asia/Kolkata'); 
$current_date = date("Y-m-d"); // time in India

					
                        if($_POST['area']){
                              $or="SELECT * FROM `create_post`  WHERE  status ='1' and disable_status='0' and sub_area_id='".$_POST['area']."' and city_id = '".$_SESSION["city"]."' and category_id = '$mid' and subcategory_id='$sid' and area_id= '$_main_area' and delete_approval_status ='0' and status='1' and expiry_date >= '$current_date' ORDER BY post_id DESC  ";
                                        
                         }else{
                          //$or="SELECT * FROM `create_post` where status ='1' and disable_status='0' ORDER BY post_id DESC  ";
  
                         }
                         $maincate3=mysqli_query($config,$or);
                                                $ldata[]= mysqli_num_rows($maincate3);
                                                while($mac3=mysqli_fetch_object($maincate3))
    
                                                {

                                                    $city_id= $mac3->city_id;
                                                    $night_duty = $mac3->night_duty;
                                                    if($night_duty == 2)
                                                    {
                                                      $night="Night Duty";
                                                    }
                                                   $or_="SELECT * FROM `dir_city_master` where dir_city_id  ='$city_id' Order by dir_city_id   DESC ";
                                                   $maincate3_=mysqli_query($config,$or_);       
                                                   $mac3_=mysqli_fetch_object($maincate3_);  

                                                   $vehicle_type_id= $mac3->vehicle_type_id;   
                                                   $orvehicle_="SELECT * FROM `vehicle_type` where Vehicle_type_id ='$vehicle_type_id' Order by Vehicle_type_id   DESC ";
                                                   $orvehicle_type=mysqli_query($config,$orvehicle_);       
                                                   $orvehicle___=mysqli_fetch_object($orvehicle_type); 

                                                   $area_id= $mac3->area_id;      
                                                   $orarea_="SELECT * FROM `dir_area_master` where dir_area_id ='$area_id' Order by dir_area_id   DESC ";
                                                   $orarea3_=mysqli_query($config,$orarea_);       
                                                   $area3__=mysqli_fetch_object($orarea3_);

                               
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
        <div style="line-height: 23px;"> 
            <h6 class="mt-2" style="color:blue;font-weight: 700;"> '.$mac3->vehicle_name.'</h6>
          <span style="text-transform: capitalize;color: #000;font-weight: 500;"><i class="fas fa-car-side"></i> '. $mac3->vehicle_no.' </span><br>
            <span style="text-transform: capitalize;"> <span style="color: #000;font-weight: 400;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;">'.$orvehicle___->Vehicle_type_name.'</span></span>
                <!-- Get Detail -->
                <span style="text-transform: capitalize;"> <span style="color: #000;font-weight: 400;">'. $vehicle_no.'</span></span>
                
                ';
                if($mac3->category_id =='4' OR $mac3->category_id =='5')  
                {
                  $data .=' <h6 class="mt-2" style="color:blue;font-weight: 700;"> '.$mac3->shop_name.'</h6>
                  <span style="text-transform: capitalize;"> <span style="color: #000;font-weight: 400;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;">'.$mac3->shop_address.'</span></span>
                  ';
                  
                }

                if($mac3->category_id =='1')  
                {
                  // if($mac3->subcategory_id >='5' && $mac3->subcategory_id <='10') 
                  // {
                  //   $data .='   <p style="text-transform: capitalize;color: #000;font-weight: 500;">Specification - '.$mac3->space.'</p>';
                  // }
                  // else
                  // {
                    $data .='   <span style="text-transform: capitalize;color: #000;font-weight: 500;">Tonnage - '.$mac3->tonnage.'</span><br>';
                  // }
                  
                }
                if($mac3->category_id =='6')  
                {
                  $data .='   <span style="text-transform: capitalize;color: #000;font-weight: 500;">Specification - '.$mac3->space.'</span><br>';
                }

                if($mac3->category_id =='2')  
                {
                  $data .='   <span style="text-transform: capitalize;color: #000;font-weight: 500;">No Of Seats - '.$mac3->seating_capacity.'</span><br>';
                }

                if($mac3->category_id =='3')  
                {
                  $data .='   <span style="text-transform: capitalize;color: #000;font-weight: 500;">Facilities in Ambulance - '.$mac3->facilities.'</span><br>';
                }

                if($mac3->category_id !='4' and $mac3->category_id !='5')  
                {
                $data .='   <span style="text-transform: capitalize;color: #000;font-weight: 500;">Stand Name - '.$mac3->stand_name.'</span><br>';
                }


                $data .='  <span style="text-transform: capitalize;color: #000;font-weight: 500;">Active Current Location - '.$mac3->Add_location.'</span><br>';
                
                if($mac3->category_id == '4' OR $mac3->category_id =='5')  
                {
                $data .='   <span style="text-transform: capitalize;color: #000;font-weight: 500;">Work Nature - '.$mac3->work_nature.'</span><br>';
                $data .='   <span style="text-transform: capitalize;color: #000;font-weight: 500;">General Remarks  - '.$mac3->remarks.'</span>';
                }
                $data .=' 
                <span style="text-transform: capitalize;color: #000;font-weight: 500;color:blue">'. $mac3_->dir_city_name.','. $area3__->dir_area_name.'</span>
                <div  class="mb-3 mt-2" style="
                background: #199b37;
                width: 30%;
                padding: 7px;
                text-align: center;
                /* color: white; */
                border-radius: 7px;
            "><a  target="_blank"  data-toggle="modal" data-target="#exampleModal_call" onclick="call_count('.$mac3->post_id.','.$mac3->whatsapp_no.');"  href = "tel:'.$mac3->whatsapp_no.'"  style="text-transform: capitalize;color: white;font-weight: 800;font-size: 14px;"><i class="fa fa-phone text-white"></i> Call  </a></div>
      </div>
        </div>
      </div>
      </div>
  </div>
</div>';
 } 
 if((($ldata[0] == 0) && ($ldata[1] == 0)) && (($ldata[2] == 0)&&($ldata[3] == 0)))
{
  $data .='<img src="data1.png" style="width: 100%;">';
 }


 echo $data ;?>


