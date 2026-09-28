<?php include('config/setup.php');?>

<?php 


 $area=$_POST['area'];
  $total_member=$_POST['total_member'];
// $key2=$_POST['key2'];
// $area=array_merge($area1,$area2);
// $key=array_merge($key,$key2);
//  print_r($area);
//  print_r($key);

foreach($area as $area)
{
    $key=$_POST['key'];
    foreach($key as $key)
    {
      
        $ss="SELECT count(vender_area1) as total FROM `biding_vender` INNER join vender_keyword on biding_vender.vender_id=vender_keyword.venderid where vender_package1='".$_POST['packid']."' and vender_area1='$area' and vender_key='$key'";

        $main_cate1=mysqli_query($config,$ss);
        if (mysqli_num_rows($main_cate1) > 0) {
        $macate3=mysqli_fetch_object($main_cate1);
        if(  $total_member > $macate3->total)
        {
            //  echo  $data ='1';


        }else{
            $s="SELECT * FROM `vender_keyword`INNER JOIN biding_area_master ON biding_area_master.area_id=vender_keyword.vender_area1 INNER JOIN biding_post ON biding_post.post_id=vender_keyword.vender_key where area_id='$area' and post_id='$key' ";

            $main_cate2=mysqli_query($config,$s);
            if (mysqli_num_rows($main_cate2) > 0) {
            $macate2=mysqli_fetch_object($main_cate2);
             
              $data .= "<span>This Keyword(".$macate2->keyword.") not available on (".$macate2->area_name.") base</span>";
            }
        }
    }
    }

}
echo $data;

?>