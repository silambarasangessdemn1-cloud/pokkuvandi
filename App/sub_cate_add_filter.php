<?php include('config/setup.php');
$id=$_POST['id'];

//  echo $query="select * from sub_category_filter where Sub_Category_id='$id'";
?>

<?php 
$data='';

$shop_master_=mysqli_query($config,"select * from sub_category_filter where Sub_Category_id='$id' ");
while($sm_=mysqli_fetch_object($shop_master_))
{
$data .='<div class="sf" style="background: #f5dfee;padding-left: 37px;padding-top: 10px;">';

              
                $data .='    <input class="form-check-input" type="checkbox" value="'.$sm_->	filter_id.'" name="sub_cate_filter[]" >  <label class="form-check-label" for="flexCheckDefault">  '.$sm_->name.'</label><br>';
          
		
             $data .='</div>';

            }


          

          
             echo  $data;

             

?>
