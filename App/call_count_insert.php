<?php include('config/setup.php');
 include('session.php');
 
 $id=$_POST['id'];
 $phono_number=$_POST['phone_number'];
 date_default_timezone_set('Asia/Kolkata'); 
 $current_date = date("Y-m-d h:i a"); // time in India 

     $or__="SELECT * FROM `create_post` where  post_id='$id' Order by post_id DESC ";
   $maincate__=mysqli_query($config,$or__);
   $mac__=mysqli_fetch_object($maincate__);
   
        $posted_id =$mac__->post_id;
        $city_id = $mac__->city_id;
        $area_id = $mac__->area_id;
        $sub_area_id = $mac__->sub_area_id;

        if($mac__)
        {
             $query="insert into call_click_count(post_id,district,city,area,click_date) values('$posted_id','$city_id','$area_id','$sub_area_id','$current_date')";
            $addmaincate=mysqli_query($config,"insert into call_click_count(post_id,district,city,area,click_date,phone_number) values('$posted_id','$city_id','$area_id','$sub_area_id','$current_date','$phono_number')");	
        }
        echo "1";

        ?>