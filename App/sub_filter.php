<?php include('config/setup.php');?>

 <?php include('session.php');
	?>


<?php

$mid=$_POST['mid'];
$area=$_POST['area'];
                                                if($area =='')
                                                {
                                                    $or="SELECT * FROM `create_post` order by post_id ";                                          
                                            
                                                }
                                                else{
                                                    $or="SELECT * FROM `sub_category_filter` INNER JOIN `create_post` ON `create_post`.`subcategory_id` = `sub_category_filter`.Sub_Category_id  where filter_id= '$area' GROUP BY `sub_category_filter`.`filter_id` ";                                          
                                                
                                                }
                                               $maincate3=mysqli_query($config,$or);
                                                $ldata[]= mysqli_num_rows($maincate3);
                                                while($mac3=mysqli_fetch_object($maincate3))
    
                                                {

                                                  $city_id= $mac3->city_id;
        
                                                  $or_="SELECT * FROM `dir_area_master` where dir_cityid ='$city_id' Order by dir_cityid  DESC ";
                                                  $maincate3_=mysqli_query($config,$or_);       
                                                  $mac3_=mysqli_fetch_object($maincate3_);  
                                                     



 $data .=' <div class="card" style="width: 100%; padding: 0%;margin-bottom:2px;">
 <div class="card-body" style="padding:1px">
   
      <div class="row">
        <div class="col-4">
          <img src="../photos/vehicle/'. $mac3->vehicle_photo.'" style="width: 100px;height: 100px;margin: auto;">
        </div>
        <div class="col-8">
          <h6 class="mt-2" style="color: #000;">'.$mac3->vehicle_name.'</h6>
            <p style="text-transform: capitalize;"> <span style="color: #000;font-weight: 400;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;">'.$mac3->driver_name.'</span></p>
                <!-- Get Detail -->
                <p style="text-transform: capitalize;"> <span style="color: #000;font-weight: 400;">'. $mac3->phone_no.','. $mac3_->dir_area_name.'</span></p>
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


