<?php include('config/setup.php');?>

 <?php include('session.php');
	?>


<?php

$mid=$_POST['mid'];

                     
			
                       
if($_POST["city"] == 1)
{
  
   $or__="SELECT * FROM `customer_pokkuvandi_entry` where update_status='0'  Order by cus_pokkuvandi_entry_id DESC";                                          

}
else 
{
 
   $or__="SELECT * FROM `customer_pokkuvandi_entry` where update_status='0' and district='".$_POST["city"]."' Order by cus_pokkuvandi_entry_id DESC";                                          
}                           
   $maincate__=mysqli_query($config,$or__);
   while($mac__=mysqli_fetch_object($maincate__))
   {
     $exp_date = $mac__->expiry_date;
     $post_id  = $mac__->post_id ;
   $current_Date=date('Y-m-d');
   $exp_date = $mac__->exp_date;
   $editon=date('Y-m-d');


   $originalDate = $mac__->from_date;
   $newDate = date("d-m-Y H:i a", strtotime($originalDate));


   $main_cate=mysqli_query($config,"select * from dir_city_master where dir_city_id='$mac__->from_district' ");
   $addsubcate=mysqli_fetch_object($main_cate);
   
   $main_cate_to=mysqli_query($config,"select * from dir_city_master where dir_city_id='$mac__->to_district' ");
   $addsubcate_to=mysqli_fetch_object($main_cate_to);

   


   if($exp_date > $editon)
   {

    


 $data .=' <div class="card" style="width: 100%; padding: 0%;margin-bottom:2px;">
 <div class="card-body" style="padding:1px">            
      <div class="row"> 
        <div class="col-12 text-center"> 

       
      <table class="table table-bordered" style="text-align: left;">
   
    <tbody>
    <th scope="row">State Type</th>'; ?>
    <?php if($mac__->state == 1) { 

    $data.='<td>Tamil Nadu Trip </td>';
   } else { 
      $data.='<td>Other State Trip </td>';
     } 
    
    $data.=' </tr>
  <tr>
    <th scope="row">Load Pick Up Place</th>
    <td>'.$mac__->place.'('.$addsubcate->dir_city_name.' District)</td>
  </tr>

  <tr>
    <th scope="row">Load Delivery Place</th>
    <td>'.$mac__->to_place.'('.$addsubcate_to->dir_city_name.' District)</td>
  </tr>

      <tr>
        <th scope="row">Vehicle Model</th>
        <td> '.$mac__->vehicle_type.'</td>
      </tr>
      <tr>
        <th scope="row">Trip Date</th>
        <td>'.$newDate.'?></td>
      </tr>

      <tr>
        <th scope="row">Customer Name</th>
        <td>'.$mac__->Customer_Name.'</td>
      </tr>
      <tr>
        <th scope="row">Contact number</th>
        <td>'. $mac__->Customer_Phone_No.'</td>
      </tr>

      <tr>
        <th scope="row">Load Details</th>
        <td>'.$mac__->general_remarks.'</td>
      </tr>

    </tbody>
  </table>
  <a data-toggle="modal" data-target="#exampleModaldiable" onclick="diablePopup('.$mac3->post_id.')" class="btn btn-primary btn-lg btn-block text-white">
               Update</a>

      </div>
      </div>
  </div>
</div>';
 }

 if(((!$mac__) ))
 {
   $data .='<img src="data1.png" style="width: 100%;">';
  }}
 
 echo $data ;?>


