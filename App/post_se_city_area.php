<?php include('config/setup.php');

include('session.php');

 $data .='<select id="sarea" class="form-select form-control" aria-label="Default select example" onchange="sub_area(this.value);">
<option value=""  selected>Select Area</option><option value="1" >All</option>';
 $nn="SELECT * FROM `dir_area_master` where dir_cityid='".$_POST['city']."'";
$main_cate33=mysqli_query($config,$nn);
while($macate33=mysqli_fetch_object($main_cate33))
                    { 
$data .='<option value="'.$macate33->dir_area_id  .'">'.$macate33->dir_area_name.'</option>';
 }
$data .='</select>';

echo $data;



?>


<script>

$("#sarea").change(function(){

  
  var area=$('#sarea').val();
  
  var mid=$('#mid').val();
  $.ajax({

type: "POST",

url: 'post_area_com.php',

data: {area : area,mid:mid}, // serializes the form's elements.

success: function(data)

{
// alert(data);
 $('#arearesult').html(data);



}

});
 });


    </script>