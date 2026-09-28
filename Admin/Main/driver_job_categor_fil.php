

<?php 
include('../config/setup.php');

$id=$_POST['id']; 

$main_cate_search=mysqli_query($config,"select * from job_search_category where Main_Category_id = '$id' ");
											$macate_search=mysqli_fetch_object($main_cate_search);
                                            $package_days=$macate_search->days;
                                            $current_Date=date('Y-m-d');

                                            $futureDate = date("Y-m-d", strtotime($current_Date . " +$package_days days")); 
      

if($id == 1 )
{
    ?>
    
<div class="row" style="padding: 15px;background: #faeed9;">
<div class="form-group col-md-6">    
                                                    <label for="email2">Job Name</label>
                                                    <input type="text" value="<?php echo  $job_name ?>" class="form-control" id="job_name" name="job_name" >                                                   
                                                </div>

                                               

                                                <div class="form-group col-md-6">    
                                                    <label for="email2">Experiences</label>
                                                   
                                                    <input type="number" value="<?php echo  $exprinace ?>" class="form-control" id="experiences" name="experiences">
                                                </div>
                                                <div class="form-group col-md-6">    
                                                    <label for="email2">Qualification</label>
                                                    <input type="text" value="<?php echo  $qualification ?>" class="form-control" id="qualification" name="qualification"  >                                                   
                                                </div>
                                               
                                              
                                                <div class="form-group col-md-6">
                                                    <label for="email2">Company Name</label>
                                                    <input  type="text" class="form-control" id="email2" name="company_name" placeholder="Comapny Name" >
                                                </div>
                                                <div class="form-group col-md-6" style="display:none">
                                                    <label for="exampleFormControlSelect1">District</label>
                                                        <select class="form-control" id='city' name="Add_city">
                                                            <option value="">---SELECT---</option>
                                                            <?php
                                                            $main_cate=mysqli_query($config,"select * from dir_city_master");
                                                            while($addsubcate=mysqli_fetch_object($main_cate))
                                                            {  
                                                            ?>
                                                            <option value="<?php echo $addsubcate->dir_city_id ;?>"><?php echo $addsubcate->dir_city_name;?></option>
                                                            <?php } ?>                                                        
                                                        </select>
                                                </div>
                                                <div class="form-group col-md-6" style="display:none">
                                                    <label for="exampleInputEmail1">City</label>
                                                        <div id="area">

                                                        </div>
                                                </div>

                                                <div class="form-group col-md-6" style="display:none">
                                                    <label for="exampleInputEmail1">Area</label>
                                                        <div id="subarea">

                                                        </div>
                                                </div>

                                                <div class="form-group col-md-6" >
                                                    <label for="email2">Salary Range</label>
                                                    <input type="text" class="form-control" id="email2" name="salary_range" placeholder="Salary Range...."  >
                                                </div>
                                               
                                                <div class="form-group col-md-6" >
                                                    <label for="email2">Contact No</label>
                                                    <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Contact No...."  >
                                                </div>
                                                <div class="form-group col-md-6" >
                                                    <label for="email2">Email Id</label>
                                                    <input type="text" class="form-control" id="email_id" name="email_id" placeholder="email_id...."  >
                                                </div>
                                                <div class="form-group col-md-6" >    
                                                            <label for="email2">Last Date</label>
                                                            <input  type="date" class="form-control" id="last_date" name="last_date"  >
                                                    </div>
                                                    
                                                    <div class="form-group col-md-6" >    
                                                            <label for="email2">Address</label>
                                                            <textarea type="text" class="form-control" id="email2" name="address"  ></textarea>
                                                            </div>
                                                <div class="form-group col-md-6" >    
                                                <label for="email2">Driving Previous Experience Details</label>
                                                            <textarea type="text" class="form-control" id="email2" name="Add_remarks"  ></textarea>
                                                    </div>	

                                                    <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Exp Date</label>
                                                <input readonly type="text" value="<?php echo $futureDate ?>" class="form-control" id="exp_date" name="exp_date">
                                                </div>

                                                    <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Amount</label>
                                                    <input readonly type="text" class="form-control" id="amount" name="amount" value="<?php echo $macate_search->amount ?>">
                                                        <!-- <div id="amount_job">

                                                        </div> -->
                                                </div>
                                                    <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Days</label>
                                                <input readonly type="text" value="<?php echo  $macate_search->days ?>" class="form-control" id="days" name="days">
                                                </div>
                                              
                                               
                                           </div>

<?php
} else{
?>

<div class="row" style="padding: 15px;background: #faeed9;">

<div class="form-group col-md-6">    
                                                    <label for="email2">Location Name</label>
                                                    <input required="" type="text" value="" class="form-control" id="job_location" name="job_location" placeholder="Area Name">                                                   
                                                </div>

<!-- <input type="hidden" value="<?php echo  $macate_search->days ?>" class="form-control" id="days" name="days"> -->
                                                <div class="form-group col-md-6" style="display:none">
                                                    <label for="exampleFormControlSelect1">District</label>
                                                        <select  class="form-control" id='city' name="Add_city">
                                                            <option value="">---SELECT---</option>
                                                            <?php
                                                            $main_cate=mysqli_query($config,"select * from dir_city_master");
                                                            while($addsubcate=mysqli_fetch_object($main_cate))
                                                            {  
                                                            ?>
                                                            <option value="<?php echo $addsubcate->dir_city_id ;?>"><?php echo $addsubcate->dir_city_name;?></option>
                                                            <?php } ?>                                                        
                                                        </select>
                                                </div>
                                                <div class="form-group col-md-6" style="display:none">
                                                    <label for="exampleInputEmail1">City</label>
                                                        <div id="area">

                                                        </div>
                                                </div>

                                                <div class="form-group col-md-6" style="display:none">
                                                    <label for="exampleInputEmail1">Area</label>
                                                        <div id="subarea">

                                                        </div>
                                                </div>

                                                <div class="form-group col-md-6" >
                                                <label for="email2">Salary Amount(Per day/Per hour)</label>
                                                <input type="text" class="form-control" id="email2" name="salary_range" placeholder="Salary Range...."  >
                                                </div>
                                               
                                                <div class="form-group col-md-6" >
                                                <label for="email2">Mobile Number</label>
                                                <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Contact No...."  >
                                                </div>
                                                <div class="form-group col-md-6" >
                                                    <label for="email2">Licence No</label>
                                                    <input type="text" class="form-control" id="email_id" name="licence_no" placeholder="Licence No...."  >
                                                </div>

                                                <div class="form-group col-md-6" >
                                                <label for="email2"> Vehicle Names(Experience)</label>
                                                <input type="text" class="form-control" id="email_id" name="vehicle_type" placeholder="Vehicle Brand Names"   >
                                                </div>
                                                <div class="form-group col-md-6">    
                                                    <label for="email2">Total Driving Experience(In years)</label>
                                                   
                                                    <input required="" type="text" class="form-control" id="experiences" name="experiences" placeholder="Total Years">
                                                </div>

                                                <div class="form-group col-md-6" >    
                                                <label for="email2">License Expiry Date</label>
                                                <input  type="date" class="form-control" id="last_date" name="last_date"  >
                                                    </div>
                                                    
                                                    <div class="form-group col-md-6" >    
                                                    House Address                                                            <textarea type="text" class="form-control" id="email2" name="address"  ></textarea>
                                                            </div>
                                           

                                                    <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Exp Date</label>
                                                <input readonly type="text" value="<?php echo $futureDate ?>" class="form-control" id="exp_date" name="exp_date">
                                                </div>


                                                    <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Amount</label>
                                                    <input readonly type="text" class="form-control" id="amount" name="amount" value="<?php echo $macate_search->amount ?>">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Days</label>
                                                <input readonly type="text" value="<?php echo  $macate_search->days ?>" class="form-control" id="days" name="days">
                                                </div>


                                                           
                                                        </div> 
<?php } ?>

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



            
            function job_category(id)
          {
            var id = id;


        




          $.ajax({
              type: "POST",
              url: "job_amount.php",
              data:{id:id}, 
              success: function(data)
              {
               
              $('#amount_job').html(data);
         
              console.log(data);
              }
          });

          $.ajax({
              type: "POST",
              url: "driver_job_categor_fil.php",
              data:{id:id}, 
              success: function(data)
              {
                // alert(data);
              $('#cat_filter').html(data);
         
            //   console.log(data);
              }
          });
          }

            </script>