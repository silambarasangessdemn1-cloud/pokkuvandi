<?php include('config/setup.php');?>
<?php $id=$_POST['id'];
 $i=0;
 $or="SELECT * FROM `job_search_post` where job_search_id='$id' Order by job_search_id DESC ";
 $maincate3=mysqli_query($config,$or);             
 $mac3=mysqli_fetch_object($maincate3);




?>
 <form id="edit_form_id">
 <input type="hidden" class="form-control" id="email2" name="id" placeholder="Comapny Name" value="<?php echo $mac3->job_search_id?>">


    <div class="row p-3">         <?php if($mac3->job_category_id == 2) {?>
                                           

                                              <div class="form-group col-md-6">
    <label for="exampleFormControlSelect1">State</label>
    <select required class="form-control" id="state" name="state" onchange="loadDistricts(this.value)">
        <option value="">---SELECT---</option>
        <?php
        $state_query = mysqli_query($config, "SELECT * FROM dir_state_master");
        while($state = mysqli_fetch_object($state_query)) {
            $selected = ($state->state_id == 24) ? 'selected="selected"' : '';
            echo "<option value='{$state->state_id}' {$selected}>{$state->name}</option>";
        }
        ?>
    </select>
</div>

<div class="form-group col-md-6">
        <label for="city">District</label>
        <select required class="form-control" id="city_dis" name="dis_city">
            <option value="">---SELECT---</option>
            <?php
            $district_query = mysqli_query($config, "SELECT * FROM dir_city_master");
            while($district = mysqli_fetch_object($district_query)) {
                $selected = ($district->dir_city_id ==  $mac3->city_id) ? 'selected="selected"' : '';
                echo "<option value='{$district->dir_city_id}' {$selected}>{$district->dir_city_name}</option>";
            }
            ?>
        </select>
    </div>
<input type="hidden" id="selected_area_id" value="<?= isset($mac3->area_id) ? $mac3->area_id : '' ?>">

                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">City</label>
                                                        <div id="area">
                                                          <?php 
                                                            $_SESSION['Add_area'];
                                                          
                                                          if($_SESSION['Add_area']!='') { ?>
                                                        <select id="" name="Add_area" class="form-select form-control form-select-lg mb-3" aria-label=".form-select-lg example">

                                                            <?php

                                                             $wuei="SELECT * FROM `dir_area_master` where dir_cityid='".$_SESSION['Add_city']."' ORDER BY `dir_area_master`.`dir_area_name` ASC ";

                                                                                $main_cate3_area=mysqli_query($config,"SELECT * FROM `dir_area_master` where dir_cityid='".$_SESSION['Add_city']."' ORDER BY `dir_area_master`.`dir_area_name` ASC ");

                                                                                while($macate3_area=mysqli_fetch_object($main_cate3_area))

                                                                                {

                                                                                ?>
                                                            <option  <?php if($macate3_area->dir_area_id == $_SESSION['Add_area']) {?>selected="selected"<?php }?>  value="<?php echo $macate3_area->dir_area_id ?>"><?php echo $macate3_area->dir_area_name ?></option>
                                                            <?php }?>
                                                            </select> 
                                                            <?php } ?>
                                                        </div>
                                                </div>

                                              
                                                <div class="form-group col-md-6">    
                                                    <label for="email2"> Location Name</label>
                                                    <input type="text"  class="form-control" id="job_location" name="job_location" value="<?php echo $mac3->job_location?>">                                                   
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="email2">Salary Amount(Per day/Per hour)</label>
                                                    <input type="text" class="form-control" id="email2" name="salary_range" placeholder="Salary Range...." value="<?php echo $mac3->salary_range?>">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="email2"> Mobile No</label>
                                                    <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Contact No...." value="<?php echo $mac3->contact_no?>">
                                                </div>

                                                 <div class="form-group col-md-6">
                                                    <label for="email2">Licence No</label>
                                                    <input type="text" class="form-control" id="email_id" name="licence_no" placeholder="Licence No...." value="<?php echo $mac3->licence_no?>">
                                                </div>
                                             <div class="form-group col-md-6">
                                                    <label for="email2">Total Driving Experience(In years)</label>
                                                    <input type="text" class="form-control" id="experiences" name="experiences" placeholder="Experiences...." value="<?php echo $mac3->experiences?>">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="email2"> Vehicle Names(Experience)</label>
                                                    <input required="" type="text" class="form-control" id="email_id" name="vehicle_type" placeholder="Vehicle Brand Names" value="<?php echo $mac3->vehicle_type?>">
                                                </div>
                                                <div class="form-group col-md-6">    
                                                            <label for="email2">License Expiry Date</label>
                                                            <input required="" type="date" class="form-control" id="last_date" name="last_date" value="<?php echo $mac3->last_date?>">
                                                    </div>
                                                  <div class="form-group col-md-6">    
    <label for="email2">House Address</label>
    <textarea required class="form-control" id="email2" name="address"><?php echo $mac3->address; ?></textarea>
</div>

                                                          <div class="form-group col-md-6">    
    <label for="email2">Driving Previous Experience Details</label>
    <textarea required class="form-control" id="email2" name="Add_remarks" placeholder="Driving Experience Details"><?php echo isset($mac3->remarks) ? htmlspecialchars($mac3->remarks) : ''; ?></textarea>
</div>

                                             <?php } else if($mac3->job_category_id == 1) {?>

                                                <div class="form-group col-md-6">
                                                    <label for="email2">Company Name</label>
                                                    <input type="text" class="form-control" id="email2" name="company_name" placeholder="Comapny Name" value="<?php echo $mac3->company_name?>">
                                                    
                                                </div>

                                            <div class="form-group col-md-6">    
                                                    <label for="email2">Job Name</label>
                                                    <input type="text"  class="form-control" id="job_name" name="job_name" value="<?php echo $mac3->job_name?>">                                                   
                                                </div>
                                              
                                                <div class="form-group col-md-6">    
                                                    <label for="email2">Job Location</label>
                                                    <input type="text"  class="form-control" id="job_location" name="job_location" value="<?php echo $mac3->job_location?>">                                                   
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="email2">Salary Range</label>
                                                    <input type="text" class="form-control" id="email2" name="salary_range" placeholder="Salary Range...." value="<?php echo $mac3->salary_range?>">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="email2">Contact No</label>
                                                    <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Contact No...." value="<?php echo $mac3->contact_no?>">
                                                </div>

                                               
                                                <div class="form-group col-md-6">
                                                    <label for="email2">Qualification</label>
                                                    <input type="text" class="form-control" id="qualification" name="qualification" placeholder="Qualification...." value="<?php echo $mac3->qualification?>">
                                                </div>


                                                
                                                <?php } else { ?>

                                                <?php } ?>
                                               
    <div class="form-group p-3">
        <button class="btn btn-success"  type="submit">Update</button>
        <!-- <button class="btn btn-success"  type="submit" name="edit" >Update</button> -->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       </div>
</form>
       <script>

        
$("#edit_form_id").submit(function(e) {
    e.preventDefault();    
    var formData = new FormData(this);

    $.ajax({
        url: "job_insert_edit.php",
        type: 'POST',
        data: formData,
        success: function (data) {

            // alert(data);
                              Swal.fire({
                                  position: 'center',
                                  icon: 'success',
                                  title: 'Successfully Updated',
                                  showConfirmButton: false,
                                  timer: 1500
                                  })


                                  setTimeout(function() {
                                    $('#exampleModaledit').modal('hide');
                                    }, 1000);
                                    setTimeout(() => { 
                                             location.reload();
                                    }, 2000);

        },
        cache: false,
        contentType: false,
        processData: false
    });
}); 
          
function edit_insert_(id){
                    var id;
                    var Add_vehicle_photo = $('#Add_vehicle_photo').val();
                    var edit_whatsapp_no = $('#edit_whatsapp_no').val();
                    var edit_address = $('#edit_address').val();
                    var edit_stand_name = $('#edit_stand_name').val();
                    var night_duty = $('#night_duty').val();
                    var checkboxValue = $('#night_duty').is(':checked') ? 2 : 0;
                    var edit_location = $('#edit_location').val();
                    var edit_insurance_exp_date = $('#edit_insurance_exp_date').val();
                    

                      
                    //alert(checkboxValue);
                    $.ajax({
                        type: "POST",
                        url:'insert_edit.php',
                        data:  $('#edit_form_id').serialize(), // serializes the form's elements.
                             contentType: false,
                            cache: false,
                            processData: false,
                        success: function(data)
                        {	
                          alert(data);	
                            console.log(data);	
                        //    $('#loaderupdate').html(data);
                        Swal.fire({
                                  position: 'center',
                                  icon: 'success',
                                  title: 'Successfully Updated',
                                  showConfirmButton: false,
                                  timer: 1500
                                  })


                                  setTimeout(function() {
                                    $('#exampleModaledit').modal('hide');
                                    }, 1000);
                                    setTimeout(() => { 
                                            // location.reload();
                                    }, 2000);
                        }			
                    });	
                    

                }


                // $("#night_duty").change(function() {

                //     if($(this).prop('checked')) {
                //         var night_duty = 2;
                //         alert(night_duty);
                //     } else {
                //         var night_duty = 1;
                //         alert(night_duty);
                //     }


                //  });



            $("#main_city").change(function(){
    $('#exampleModalcity').modal('toggle');
  var city=$("#main_city").val();
  var city_name=$("#main_city :selected").text();
  $.ajax({
        type: "POST",
        url: "se_city.php",
        data: {city:city,city_name:city_name}, 
        success: function(data)
        {
         $('#city_name').html( city_name);
        }
    });

});
$(document).ready(function() {
    function loadAreas() {
        var id = $('#city_dis').val();
        var kmid = $('#kmid').val();
        var selectedAreaId = $('#selected_area_id').val(); // existing selected area

        if (id) { // Only run if a city is selected
            $.ajax({
                type: "POST",
                url: "area_post.php",
                data: { id: id, kmid: kmid, selected_area: selectedAreaId }, 
                success: function(data) {
                    $('#area').html(data);

                    // After replacing dropdown, set the selected value if it exists
                    if (selectedAreaId) {
                        selectedAreaId = selectedAreaId.toString().trim();
                        $('#area select option').each(function() {
                            if ($(this).val().trim() === selectedAreaId) {
                                $(this).prop('selected', true);
                            }
                        });
                    }
                }
            });
        }
    }

    // Run when city changes
    $('#city_dis').on('change', loadAreas);

    // Run once on page load if city already selected
    loadAreas();
});

        </script>