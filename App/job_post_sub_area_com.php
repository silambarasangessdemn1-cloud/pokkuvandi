<?php include('config/setup.php');?>

 <?php include('session.php');
	?>


<?php

// $mid=$_POST['mid'];
 $sid= $_SESSION['sid'];
 $mid= $_SESSION['mid'];

  $_POST['area'];
  $_main_area = $_SESSION['area'];
										
                   
date_default_timezone_set('Asia/Kolkata'); 
$current_date = date("Y-m-d"); // time in India

                          if($_POST['area']){
                              $or="SELECT * FROM `job_search_post`  WHERE  status ='0' and disable_status='0' and district_id = '".$_SESSION["city"]."' and city_id='$_main_area' and area_id= '".$_POST['area']."' and job_category_id = '$sid'  and last_date >= '$current_date'   ORDER BY job_search_id DESC  ";
                             
                          }else{
                          //  $or="SELECT * FROM `job_search_post`  WHERE  status ='0' and disable_status='0' and district_id = '".$_SESSION["city"]."' and city_id='".$_POST['area']."' and area_id= '$_main_area' and job_category_id = '$sid'  and last_date >= '$current_date'   ORDER BY job_search_id DESC  ";
                                        
                         }

                         $maincate3=mysqli_query($config,$or);
                                                $ldata[]= mysqli_num_rows($maincate3);
                                                while($mac3=mysqli_fetch_object($maincate3))
    
                                                {
                                                  
                                                    $city_id= $mac3->district_id;
                                                   
                                                   $or_="SELECT * FROM `dir_city_master` where dir_city_id  ='$city_id' Order by dir_city_id   DESC ";
                                                   $maincate3_=mysqli_query($config,$or_);       
                                                   $mac3_=mysqli_fetch_object($maincate3_);  


                                                   $area_id= $mac3->city_id;      
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
        <div class="col-12">   
        <div style="margin-left: 15px;">  
        
          <h6 class="mt-2" style="color:blue;font-weight: 700;"> '.$mac3->job_name.'</h6>
         
                
                ';
               

                if($mac3->job_category_id =='1')  
                {
                  // if($mac3->subcategory_id >='5' && $mac3->subcategory_id <='10') 
                  // {
                  //   $data .='   <p style="text-transform: capitalize;color: #000;font-weight: 500;">Specification - '.$mac3->space.'</p>';
                  // }
                  // else
                  // {
                    $data .='   <p style="text-transform: capitalize;color: #000;font-weight: 500;"><i class="fas fa-car-side"></i> '. $mac3->company_name.' </p>
                   
                        <!-- Get Detail -->
                        <p style="text-transform: capitalize;"> <span style="color: #000;font-weight: 400;">Experiences -'.$mac3->experiences.' ,  Qualification - '. $mac3->qualification.'</span></p>
                         <p style="text-transform: capitalize;color: #000;font-weight: 500;">Salary Range - '.$mac3->salary_range.'</p>';
                  // }
                  
                }
                if($mac3->job_category_id =='2')  
                {
                  $data .='   <p style="text-transform: capitalize;color: #000;font-weight: 500;"><i class="fas fa-car-side"></i> '. $mac3->company_name.' </p>
                  <p style="text-transform: capitalize;"> <span style="color: #000;font-weight: 400;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;">Licence No- '.$mac3->licence_no.'</span></p>
                      <!-- Get Detail -->
                      
                       <p style="text-transform: capitalize;color: #000;font-weight: 500;">Salary Range- '.$mac3->salary_range.'</p>';
                }

               
                $data .=' 
                <p style="text-transform: capitalize;color: #000;font-weight: 500;color:blue">'. $mac3_->dir_city_name.','. $area3__->dir_area_name.'</p>
              <div  class="mb-3" style="
                  background: #199b37;
                  width: 95%;
                  padding: 7px;
                  text-align: center;
                  /* color: white; */
                  border-radius: 7px;
              "><a  target="_blank"  href = "tel:'.$mac3->contact_no.'"  style="text-transform: capitalize;color: white;font-weight: 800;font-size: 14px;"><i class="fa fa-phone text-white"></i> Call  </a></div>
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


