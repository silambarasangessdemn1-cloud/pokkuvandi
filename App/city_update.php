<?php include('config/setup.php');

$id=$_POST['id'];

?>
<!-- Modal -->
<?php 
$data='';
$data .='

 <div class="form-group col-md-6">
    <label for="exampleFormControlSelect1">State</label>
    <select required class="form-control" id="state" name="state" onchange="loadDistricts(this.value)">
        <option value="">---SELECT---</option>';
        
        $state_query = mysqli_query($config, "SELECT * FROM dir_state_master");
        while($state = mysqli_fetch_object($state_query)) {
            $selected = ($state->state_id == 24) ? 'selected="selected"' : '';
            $data .= "<option value='{$state->state_id}' {$selected}>{$state->name}</option>";
        }
        
$data .= '
    </select>
</div>
<div class="form-group col-md-6">

<label for="exampleFormControlSelect1">District</label>
    <select required class="form-control" id="city" name="Add_city"><option>---SELECT---</option>';
        
    $main_cate__=mysqli_query($config,"select * from create_post where post_id=$id ");
    $addsubcate__=mysqli_fetch_object($main_cate__);

    $main_cate=mysqli_query($config,"select * from dir_city_master");
    while($addsubcate=mysqli_fetch_object($main_cate))
    {  
       // $data.='';
        $data.= '<option value="'. $addsubcate->dir_city_id.'"> '.$addsubcate->dir_city_name.'</option>';
    }                                                                             
    $data.='</select></div>';

    $data.='<div class="form-group col-md-6">
    <label for="exampleInputEmail1">City</label>
        <div id="area">';

        $data.='</div></div>';


        // $data.='<div class="form-group col-md-6">
        // <label for="exampleInputEmail1">Area</label>
        //     <div id="subarea1">';

        //     $data.='</div></div>';

        $data.='<div>';
        $data.='<input type="hidden" class="form-control" value="'.$id .'" name="post_id" id="post_id"';
        $data.='</div>';

        $data.='<div class="form-group col-md-12">
    <label for="edit_location">Vehicle Active Current Location Is</label>
    <input required type="text" class="form-control" name="edit_location" id="edit_location" value="'.$addsubcate__->Add_location.'">
</div>';

echo  $data;
?>

<script>
      $('#city').on('change', function() {
              
                var id =this.value;
                var kmid =$('#kmid').val();
            
            $.ajax({
                type: "POST",
                url: "area_post.php",
                data:{id:id,kmid:kmid}, 
                success: function(data)
                {
                  
                $('#area').html(data);

                console.log(data);
                }
            });
            });

            
    
function updatecheck() {
        // $('#exampleModal').modal('show');
        var state = $('#state').val();

        var city = $('#city').val();
        var area1 = $('#area1').val();
        var post_id = $('#post_id').val();
        var subarea = $('#subarea').val();
        var edit_location = $('#edit_location').val();
       // alert(subarea);
        $.ajax({
            type: "POST",
            url: 'city_update_insert.php',
            data: {
              city: city,
              area1:area1,
              subarea:subarea,
              post_id:post_id,
              state:state,
              edit_location: edit_location
             
            },
            success: function(data) {
             // alert(data);
            if(data == 1)
            {
              Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'City & area Updated Successfully',
                showConfirmButton: false,
                timer: 1500
                })


                    
                  // $(".alertreg").attr("style", "display: block;padding:20px;");
                  // $(".alertreg").delay(1000).fadeOut(500);
                
                  // $('.msgreg').html("City & Area Updated Successfully ");           

                  // setTimeout(function() {
                  //   $('#exampleModalupdate').modal('hide');
                  //   }, 1000);
                  setTimeout(() => { 
                      location.reload();
              }, 2000);


            }
            //$("#exampleModalupdate").hide();
            $('#exampleModalupdate').dialog('close');

         

            }
            
        }); 
 
 
   
    }


    </script>

<script>
function loadDistricts(stateId) {
  localStorage.setItem('stateId', stateId); // Save the mobile number in localStorage
  $("#area1").html('<option value="">---SELECT---</option>');

  
    if(stateId) {
        $.ajax({
            type: "POST",
            url: "fetch_districts.php",
            data: { state_id: stateId },
            success: function(response) {
                $("#city").html(response);
            }
        });
    } else {
        $("#city").html('<option value="">---SELECT---</option>');
    }
}
</script>