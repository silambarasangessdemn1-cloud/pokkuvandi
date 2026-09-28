<?php include('config/setup.php');?>
<?php $id=$_POST['id'];
 $i=0;
 $or="SELECT * FROM `create_post` where post_id='$id' Order by post_id DESC ";
 $maincate3=mysqli_query($config,$or);             
 $mac3=mysqli_fetch_object($maincate3);




?>
 <form id="edit_form_id">
    <div class="row p-3">
                                                <div class="form-group col-md-6">
                                                <img style="height: 100px !important; width: 100px;"class="img-fluid slider-eff" src="../photos/vehicle/<?php echo $mac3->vehicle_photo?>" alt="..." />

                                                    <label for="email2">Photo(Size 250 X 250 px)</label>
                                                    <input  type="file" class="form-control" id="Add_vehicle_photo" name="Add_vehicle_photo">
                                                </div>
                                              
                                                <div class="form-group col-md-6">
                                                    <label for="email2">Mobile Number</label>
                                                    <input  type="hidden" class="form-control" id="email2" name="id" placeholder="Whatsapp No" value="<?php echo $id?>"  >
                                                    <input  type="text" class="form-control" id="edit_whatsapp_no" name="edit_whatsapp_no" placeholder="Whatsapp No" value="<?php echo $mac3->whatsapp_no?>" onkeypress="if(this.value.length==10) return false;" >
                                                </div>
                                                <div class="form-group col-md-6" style="display:none">
                                                    <label for="email2">Address</label>
                                                    <textarea type="text" class="form-control" id="edit_address" name="edit_address"   placeholder="Address...."  ><?php echo $mac3->address?></textarea>
                                                </div>

                                                <?php if($mac3->category_id == 2) {?>
                                                <div class="form-group col-md-6"  >  
                                                        <!-- <input class="form-check-input" type="checkbox" value="1" name="day_duty" checked  > Day Duty -->
                                                        <span style="margin-left:30px"><input class="form-check-input" type="checkbox"  id="night_duty"  name="night_duty" <?php if($mac3->night_duty == 2){ ?>checked <?php } else { } ?> > Night Duty</span>
                                                        
                                                </div>
                                             <?php } else { ?>
                                                <?php }?>


                                                <?php if($mac3->category_id == 4) {?>

                                                    <?php } else if($mac3->category_id == 5){ ?>
                                                        <?php } else { ?>
                                                <div class="form-group col-md-6">    
                                                            <label for="email2">Stand Name</label>
                                                            <input type="text" class="form-control" id="edit_stand_name" name="edit_stand_name" value="<?php echo $mac3->stand_name?>" >
                                                </div>
                                               <?php } ?>

                                             

                                                    <?php if($mac3->category_id == 1 OR $mac3->category_id == 2 OR $mac3->category_id == 3 OR $mac3->category_id == 6)  {?>
                                                    <div class="form-group col-md-6">    
                                                            <label for="email2">Vehicle Insurance Expiry Date</label>
                                                            <input  type="date" class="form-control"  name="edit_insurance_exp_date" id="edit_insurance_exp_date" value="<?php echo $mac3->Add_insurance_exp_date?>">
                                                    </div>
                                                    <?php } ?>

                                                <!-- Vehicle Model Name (Sub Category) -->
                                                <div class="form-group col-md-6">    
                                                    <label for="email2">Sub Category Name
                                                    </label>
                                                    <div id="edit_sc">
                                                        <select required class="form-control" onchange="editSubcateg(this.value);" name="edit_sub_category" id="edit_sub_cate_Name">
                                                            <option value="">---Select---</option>
                                                            <?php 
                                                            $shop_master_ = mysqli_query($config, "select * from sub_category where Main_Category='".$mac3->category_id."' and Sub_Category_Status=1");
                                                            while($sm_ = mysqli_fetch_object($shop_master_)) {
                                                            ?>
                                                            <option <?php if($mac3->subcategory_id == $sm_->Sub_Category_id) {?>selected="selected"<?php }?> value="<?php echo $sm_->Sub_Category_id ?>"><?php echo $sm_->Sub_Category_Name ?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Vehicle Type -->
                                                <div class="form-group col-md-6" id="edit_vt">
                                                    <label for="email2">Vehicle Type</label>
                                                    <?php if($mac3->subcategory_id) { ?>
                                                        <select required class="form-control" name="edit_vehicle_type_id" id="edit_vehicle_type">
                                                            <option value="">---Select---</option>
                                                            <?php 
                                                            $shop_master_ = mysqli_query($config, "select * from vehicle_type where status=1 and Sub_Category_id='".$mac3->subcategory_id."'");
                                                            while($sm_ = mysqli_fetch_object($shop_master_)) {
                                                            ?>
                                                            <option <?php if($mac3->vehicle_type_id == $sm_->Vehicle_type_id) {?>selected="selected"<?php }?> value="<?php echo $sm_->Vehicle_type_id;?>"><?php echo $sm_->Vehicle_type_name;?></option>
                                                            <?php }?>
                                                            <option value="0" <?php if($mac3->vehicle_type_id == 0) {?>selected="selected"<?php }?>>Others</option>
                                                        </select>
                                                        <div id="edit_other_vehicle_type_field" style="display:<?php echo ($mac3->vehicle_type_id == 0) ? 'block' : 'none'; ?>;">
                                                            <label for="edit_other_vehicle_type" style="margin-top: 10px;">Please Enter Vehicle Model Name</label>
                                                            <input type="text" id="edit_other_vehicle_type" name="edit_other_vehicle_type" class="form-control" value="<?php echo $mac3->other_vehicle_type ?? ''; ?>" />
                                                        </div>
                                                    <?php } else { ?>
                                                        <select required class="form-control" name="edit_vehicle_type_id" id="edit_vehicle_type">
                                                            <option value="">---Select Vehicle Model First---</option>
                                                        </select>
                                                    <?php } ?>
                                                </div>

                                              

         
    </div>
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
        url: "insert_edit.php",
        type: 'POST',
        data: formData,
        success: function (data) {

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



        </script>
        <script>
            function editSubcateg(id) {
                if (!id) {
                    $('#edit_vt').html('<label for="email2">Vehicle Type</label><select required class="form-control" name="edit_vehicle_type_id" id="edit_vehicle_type"><option value="">---Select Vehicle Model First---</option></select>');
                    return;
                }
                
                $.ajax({
                    type: "POST",
                    url: 'vehicle_type.php',
                    data: {id: id},
                    success: function(data) {
                        $('#edit_vt').html('<label for="email2">Vehicle Type</label>' + data);
                        $('#edit_vt').append(`
                            <div id="edit_other_vehicle_type_field" style="display:none;">
                                <label for="edit_other_vehicle_type" style="margin-top: 10px;">Please Enter Vehicle Model Name</label>
                                <input type="text" id="edit_other_vehicle_type" name="edit_other_vehicle_type" class="form-control" />
                            </div>
                        `);
                        
                        var vehicleTypeDropdown = document.getElementById('edit_vehicle_type');
                        if (vehicleTypeDropdown) {
                            vehicleTypeDropdown.addEventListener('change', function() {
                                if (vehicleTypeDropdown.value == "0") {
                                    $('#edit_other_vehicle_type_field').show();
                                } else {
                                    $('#edit_other_vehicle_type_field').hide();
                                }
                            });
                        }
                    }
                });
            }
            
            // Handle vehicle type change for "Others" option
            $(document).on('change', '#edit_vehicle_type', function() {
                if ($(this).val() == "0") {
                    $('#edit_other_vehicle_type_field').show();
                } else {
                    $('#edit_other_vehicle_type_field').hide();
                }
            });
        </script>