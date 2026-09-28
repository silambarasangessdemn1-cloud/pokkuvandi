<?php include('config/setup.php');

$id=$_POST['id'];

?>

<?php 
$data='';

$data .='<select id="subarea" class="form-select form-control" onchange="sub_area_filter();"  aria-label="Default select example"> <option value=""  selected>Select  Area</option>';
              //  echo $query="select * from sub_area_master where dirarea_id='$id'";
              if($id == 1)
              {
                //$shop_master_=mysqli_query($config,"select * from sub_area_master ");
              }
              else
              {
                $shop_master_=mysqli_query($config,"select * from sub_area_master where dirarea_id='$id'");
              }
                while($sm_=mysqli_fetch_object($shop_master_))
                {
                $data .='<option  value="'.$sm_->sub_area_id.'">'.$sm_->sub_area_name.'</option>';
                }
		
             $data .='</select>';

             echo  $data;

?>
