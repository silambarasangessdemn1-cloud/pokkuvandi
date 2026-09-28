<?php include('config/setup.php');?>
<?php
$cheackkey=$_POST['cheackkey'];

$ckey= implode(',',$cheackkey);
   $sql5="SELECT * FROM `biding_post` where NOT post_id IN ($ckey)   order by keyword ASC ";
$main_cate5=mysqli_query($config,$sql5);

$data .='<select class="form-select form-control  keywords" id="key1" onchange="getval(this);"  multiple aria-label="multiple select example" name="key[]">';

while($macate5=mysqli_fetch_object($main_cate5))

{


          $data .='<option value="'. $macate5->post_id.'">'.$macate5->keyword.'</option>';
 }
       $data .=' </select>';

       echo    $data;