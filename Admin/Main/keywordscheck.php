<?php include('../config/setup.php');?>

<?php 

  
 $area=$_POST['area'];
  $total_member=$_POST['total_member'];
// $key2=$_POST['key2'];
// $area=array_merge($area1,$area2);
// $key=array_merge($key,$key2);
//  print_r($area);
//  die;
//  print_r($key);

foreach($area as $area)
{
    $key=$_POST['key'];
    foreach($key as $key)
    {
      
        $ss="SELECT count(dir_vender_area) as total FROM `dir_vender` INNER join dir_keyword on dir_vender.dir_vender_id=dir_keyword.dir_vender_id where dir_vender_pack='".$_POST['packid']."' and dir_vender_area='$area' and dir_vender_key='$key'";

        $main_cate1=mysqli_query($config,$ss);
        if (mysqli_num_rows($main_cate1) > 0) {
        $macate3=mysqli_fetch_object($main_cate1);
        if(  $total_member > $macate3->total)
        {
            //  echo  $data ='1';


        }else{
            $s="SELECT * FROM `dir_keyword`INNER JOIN dir_area_master ON dir_area_master.dir_area_id=dir_keyword.dir_vender_area INNER JOIN dir_post ON dir_post.dir_post_id=dir_keyword.dir_vender_key where dir_area_id='$area' and dir_post_id='$key' ";

            $main_cate2=mysqli_query($config,$s);
            if (mysqli_num_rows($main_cate2) > 0) {
            $macate2=mysqli_fetch_object($main_cate2);
             
              $data .= "<span>This Keyword(".$macate2->dir_keyword.") not available on (".$macate2->dir_area_name.") base</span>";
            }
        }
    }
    }

}
echo $data;

?>