<?php include('config/setup.php')?>

<?php
$key=$_POST['key'];

$main_cate33=mysqli_query($config,"select * from main_category where Main_Category_Name  LIKE '$key%' order by (Main_Category_id) DESC  ");                                
$macate33=mysqli_fetch_object($main_cate33);

$main_cate33__=mysqli_query($config,"select * from create_post where vehicle_name  LIKE '$key%' order by (post_id) DESC  ");                                
$macate33__=mysqli_fetch_object($main_cate33__);

$main___=mysqli_query($config,"select * from create_post where meta_keyword LIKE '$key%' order by (post_id) DESC  ");                                
$main3__=mysqli_fetch_object($main___);

$sub___=mysqli_query($config,"select * from sub_category where Sub_Category_Name  LIKE '$key%' order by (Sub_Category_id) DESC");                                
$sub__=mysqli_fetch_object($sub___);

                               if($macate33!='')
                               {
                               // echo $query="select * from main_category where Main_Category_Name  LIKE '$key%' order by (Main_Category_id) DESC";
                                 $main_cate3=mysqli_query($config,"select * from main_category where Main_Category_Name  LIKE '$key%' order by (Main_Category_id) DESC  ");
                              
                               
                          			while($macate3=mysqli_fetch_object($main_cate3))
											{
                                 
  $data .='<div class="col-4 p-1">

      <div class="bg-white shadow-sm rounded text-center  px-2 py-3 c-it">

         <a href="Directory.php?mid='.$macate3->Main_Category_id.'&keyword='. $macate3->Main_Category_Name.'">

            <img src="photos/Category/'.$macate3->Main_Category_image.'" class="img-fluid px-2">

            <p class="m-0 pt-2 text-muted text-center">'.$macate3->Main_Category_Name.'</p>

         </a>

      </div>

   </div>';
 }
}
 elseif($macate33__ != '')
                               {
                                 //echo $query="select * from create_post where vehicle_name LIKE '$key%' order by (post_id) DESC  ";
                                 $main_cate3__=mysqli_query($config,"select * from create_post where vehicle_name LIKE '$key%' order by (post_id) DESC  ");
                                 
                          			while($macate3__=mysqli_fetch_object($main_cate3__))
                                   {
                                   
    $data .='<div class="col-4 p-1">
  
        <div class="bg-white shadow-sm rounded text-center  px-2 py-3 c-it">
  
           <a href="post_list.php?mid='.$macate3__->subcategory_id.'">
  
              <img src="../photos/vehicle/'.$macate3__->vehicle_photo.'" class="img-fluid px-2">
  
              <p class="m-0 pt-2 text-muted text-center">'.$macate3__->vehicle_name.'</p>
  
           </a>
  
        </div>
  
     </div>';
   }
   
}
else if($main3__!='')
{
   //echo $query="select * from create_post where meta_keyword LIKE '$key%' order by (post_id) DESC  ";
  $main_cate_post3=mysqli_query($config,"select * from create_post where meta_keyword LIKE '$key%' order by (post_id) DESC  ");
   while($macate_post3__=mysqli_fetch_object($main_cate_post3))
    {
                                 
  $data .='<div class="col-4 p-1">

      <div class="bg-white shadow-sm rounded text-center  px-2 py-3 c-it">

         <a href="post_list.php?mid='.$macate_post3__->subcategory_id.'">

            <img src="../photos/vehicle/'.$macate_post3__->vehicle_photo.'" class="img-fluid px-2">

            <p class="m-0 pt-2 text-muted text-center">'.$macate_post3__->vehicle_name.'</p>

         </a>

      </div>

   </div>';
 }
 }
 else
 {
   //echo $query="select * from sub_category where Sub_Category_Name  LIKE '$key%' order by (Sub_Category_id) DESC";
                                 $sub_cate3=mysqli_query($config,"select * from sub_category where Sub_Category_Name  LIKE '$key%' order by (Sub_Category_id) DESC");
                          			while($sub_cate3_=mysqli_fetch_object($sub_cate3))
											{
                                 
  $data .='<div class="col-4 p-1">

      <div class="bg-white shadow-sm rounded text-center  px-2 py-3 c-it">

         <a href="post_list.php?mid='.$sub_cate3_->Sub_Category_id.'">

            <img src="photos/Sub_Category/'.$sub_cate3_->Sub_Category_image.'" class="img-fluid px-2">

            <p class="m-0 pt-2 text-muted text-center">'.$sub_cate3_->Sub_Category_Name.'</p>

         </a>

      </div>

   </div>';
 }
 }


 echo $data;
 
 
 ?>