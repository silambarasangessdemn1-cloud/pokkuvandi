<?php include('config/setup.php');?>

<?php 


$sql2="SELECT * FROM `biding_enq_pay` WHERE ve_id='".$_POST['vender_id']."' and biding_enq='".$_POST['enq_id']."'";
$about=mysqli_query($config,$sql2);

if (mysqli_num_rows($about) > 0) {
while($coun=mysqli_fetch_object($about))

{
  if($coun->count_biding)
  {
    $data.='

 
  
  <div class="message-orange">
  <h5 style="color: red;|" class="message-content">Rs.'.$coun->b_amount.'</h5>
  <p class="message-content">'.$coun->b_desc.'</p><br>
  <div class="message-timestamp-right">'.$coun->updated_msg.'</div>
</div>';
if($coun->b_desc2)
{
  $data.='

 
  
  <div class="message-orange">
  <h5 style="color: red;|" class="message-content">Rs.'.$coun->b_amount2.'</h5>
  <p class="message-content">'.$coun->b_desc2.'</p><br>
  <div class="message-timestamp-right">'.$coun->updated_msg.'</div>
</div>';
}

}
}
echo $data;
}