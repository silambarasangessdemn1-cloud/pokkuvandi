<?php include('config/setup.php');
 include('session.php');
 
 $id=$_POST['id'];
 date_default_timezone_set('Asia/Kolkata'); 
 $current_date = date("Y-m-d"); // time in India 

     $or__="SELECT * FROM `create_post` where  post_id='$id' Order by post_id DESC ";
   $maincate__=mysqli_query($config,$or__);
   $mac__=mysqli_fetch_object($maincate__);
   
        $whatsapp_no =$mac__->whatsapp_no;
        $city_id = $mac__->city_id;
        $area_id = $mac__->area_id;
        $sub_area_id = $mac__->sub_area_id;

        if($mac__)
        {
            //  $query="insert into call_click_count(post_id,district,city,area,click_date) values('$posted_id','$city_id','$area_id','$sub_area_id','$current_date')";
            // $addmaincate=mysqli_query($config,"insert into call_click_count(post_id,district,city,area,click_date) values('$posted_id','$city_id','$area_id','$sub_area_id','$current_date')");	
        }
        $data='';

        $data .='<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
        <label for="email2">Phone Number</label>
        <input required type="number" class="form-control"  id="phone_number" name="phone_number" placeholder="Phone Number " onkeypress="if(this.value.length==10) return false;"  >
        </div>
        </div></div>
        <div class="modal-footer" style="border-top: 1px solid #ffffff;">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <a  style="color:white" onclick="call_insert('.$id.','.$whatsapp_no.')" class="btn btn-primary">Submit </a>';
        
                     echo  $data;
        
 ?>

 