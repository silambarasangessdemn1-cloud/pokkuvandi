<?php include('config/setup.php');

$id=$_POST['id'];

?>
<!-- Modal -->
<?php 
// <div class="form-group col-md-6">    
// <label for="email2">To Place</label>
// <input  value="'.$mac3_loader->loader_to_place.'" type="text" class="form-control" id="loader_to_place" name="loader_to_place"  >
// </div>  


$i=0;
 $or_loader="SELECT * FROM `create_post` where post_id='$id' and delete_id='0' and status= '1' and loader_status='1' Order by post_id DESC ";
$maincate3_loader=mysqli_query($config,$or_loader);             
$mac3_loader=mysqli_fetch_object($maincate3_loader);


$loader_to_date = $mac3_loader ? $mac3_loader->loader_to_date_ : '';
$loader_to_time = $mac3_loader ? $mac3_loader->loader_to_time_ : '';
$loader_from_date = $mac3_loader ? $mac3_loader->loader_from_date_ : '';
$loader_from_time = $mac3_loader ? $mac3_loader->loader_from_time_ : '';
date_default_timezone_set('Asia/Kolkata'); 
$from_date_time = ($loader_from_date && $loader_from_time) ? date('Y-m-d H:i', strtotime("$loader_from_date $loader_from_time")) : '';
$to_date_time = ($loader_to_date && $loader_to_time) ? date('Y-m-d H:i', strtotime("$loader_to_date $loader_to_time")) : '';

$loader_to_place = $mac3_loader ? $mac3_loader->loader_to_place_ : '';
$loader_space = $mac3_loader ? $mac3_loader->loader_space_ : '';
$loader_remarks = $mac3_loader ? $mac3_loader->loader_remarks_ : '';


 $data='';
 $data .='<div class="form-group col-md-6">    
 <label for="email2">From Date</label>
 <input  value="'.$from_date_time.'" type="datetime-local" class="form-control" id="loader_from_date" name="loader_from_date"  >
</div>
<div class="form-group col-md-6">    
 <label for="email2">To Date</label>
 <input value="'.$to_date_time.'" type="datetime-local" class="form-control" id="loader_to_date" name="loader_to_date"  >
</div> 
<div class="form-group col-md-6">
    <label for="exampleFormControlSelect1">State</label>
        <select class="form-control" id="state_status" onchange="state_cha(this.value)" name="state_status">
        <option value="0">--SELECT--</option>
        <option value="1">Within State Trip</option>
        <option value="2">Other State Trip </option>                                                    
        </select>
 </div>


        


 <div id="state_field">

</div>


<div class="form-group col-md-6">    
 <label for="email2">To Place</label>
 <input value="'.$loader_to_place.'"  type="text" class="form-control" id="loader_to_place" name="loader_to_place" placeholder="Location Name" >
</div>   



<div class="form-group col-md-6">    
 <label for="email2">Available Space</label>
 <input value="'.$loader_space.'"  type="text" class="form-control" id="loader_space" name="loader_space"  >
</div>  
<div class="form-group col-md-6">    
 <label for="email2">General Remarks</label>
 <input  value="'.$loader_remarks.'" type="text" class="form-control" id="loader_remarks" name="loader_remarks"  >
</div>';



 $data .='<input  type="hidden" value="'.$id.'" class="form-control" id="post_id" name="post_id"  >';
if($mac3_loader)
{
    $data.='<div class="form-group">
 
    <a class="btn btn-success"  onclick="loaderpopup('.$id.')"  name="city_update">submit</a>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
   </div>';
}
else
{
    $data.='<div class="form-group">
 
    <a class="btn btn-success"  onclick="loaderpopup('.$id.')"  name="city_update">submit</a>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
   </div>';
}
 

echo  $data;
?>


<script> 
  function state_cha(id)
            {
            var id;
            // alert(id);
            // if(id == 1) {
              $.ajax({
                type: "POST",
                url: "state_field_customer.php",
                data:{id:id}, 
                success: function(data)
                {
                //   alert(data);
                $('#state_field').html(data);

                console.log(data);
                }
            });
          // }
          // else
          // {
          //   $('#state_field').html('');
          // }

            }
</script>

<script>
function loadDistricts(stateId) {
    if(stateId) {
        $.ajax({
            type: "POST",
            url: "fetch_districts.php",
            data: { state_id: stateId },
            success: function(response) {
                $("#from_district").html(response);
            }
        });
    } else {
        $("#from_district").html('<option value="">---SELECT---</option>');
    }
}
function toloadDistricts(stateId) {
    if(stateId) {
        $.ajax({
            type: "POST",
            url: "fetch_districts.php",
            data: { state_id: stateId },
            success: function(response) {
                $("#to_district").html(response);
            }
        });
    } else {
        $("to_district").html('<option value="">---SELECT---</option>');
    }
}
</script>