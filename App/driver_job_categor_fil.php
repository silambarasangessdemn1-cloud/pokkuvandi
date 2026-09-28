

<?php 
include('config/setup.php');

$id=$_POST['id']; 


$main_cate_search=mysqli_query($config,"select * from job_search_category where Main_Category_id = '$id' ");
											$macate_search=mysqli_fetch_object($main_cate_search);
										
                                            $package_days=$macate_search->days;

                                            $current_Date=date('Y-m-d');

                                            $futureDate = date("d-m-Y", strtotime($current_Date . " +$package_days days")); 
                                           
                                           
if($id == 1 )
{
    ?>
    
<div class="row" style="padding: 15px;background: #faeed9;">
<div class="form-group col-md-6">    
                                                    <label for="email2">Location</label>
                                                    <input type="text" value="<?php echo  $job_location?>" class="form-control" id="job_location" name="job_location" >                                                   
                                                </div>
                                                <div class="form-group col-md-6">    
                                                    <label for="email2">Experiences</label>
                                                   
                                                    <input type="text" value="<?php echo  $exprinace ?>" class="form-control" id="experiences" name="experiences">
                                                </div>
                                                <div class="form-group col-md-6">    
                                                    <label for="email2">Education Qualification</label>
                                                    <input type="text" value="<?php echo  $qualification ?>" class="form-control" id="qualification" name="qualification" placeholder="Education Qualification" >                                                   
                                                </div>
                                               
                                              
                                                <div class="form-group col-md-6">
                                                    <label for="email2">Company Name</label>
                                                    <input  type="text" class="form-control" id="email2" name="company_name" placeholder="Comapny Name" >
                                                </div>
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
                                                        <div id="area ">

                                                        </div>
                                                </div>

                                                <div class="form-group col-md-6" style="display:none">
                                                    <label for="exampleInputEmail1">Area</label>
                                                        <div id="subarea ">

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
                                                            <label for="email2">Last Date for Apply</label>
                                                            <input  type="date" class="form-control" id="last_date" name="last_date"  >
                                                    </div>
                                                    
                                                    <div class="form-group col-md-6" >    
                                                            <label for="email2">Contact Address</label>
                                                            <textarea type="text" class="form-control" id="email2" name="Contact Address"  ></textarea>
                                                            </div>
                                                <div class="form-group col-md-6" >    
                                                            <label for="email2">General Remarks</label>
                                                            <textarea type="text" class="form-control" id="email2" name="Add_remarks"  ></textarea>
                                                    </div>	

                                                    <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Exp Date</label>
                                                <input readonly type="text" value="<?php echo $futureDate ?>" class="form-control" id="exp_date" name="exp_date">
                                                </div>


                                                    <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Amount</label>
                                                        <div id="amount_job">
                                                        <input readonly type="text" value="<?php echo  $macate_search->amount ?>" class="form-control" id="amount" name="amount">
                                                        </div>
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
                                                    <input required type="text" value="<?php echo  $job_location?>" class="form-control" id="job_location" name="job_location" placeholder="Area Name">                                                   
                                                </div>

                                            

                                                <div class="form-group col-md-6" >
                                                    <label for="email2">Salary Amount(Per day/Per hour)</label>
                                                    <input required type="text" class="form-control" id="email2" name="salary_range" placeholder="Salary Range...."  >
                                                </div>
                                               
                                                <div class="form-group col-md-6" >
                                                    <label for="email2">Mobile Number</label>
                                                    <input required type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Contact No...."  >
                                                </div>
                                                <div class="form-group col-md-6" >
                                                    <label for="email2">Licence No</label>
                                                    <input required type="text" class="form-control" id="email_id" name="licence_no" placeholder="Licence No...."  >
                                                </div>

                                                <div class="form-group col-md-6" >
                                                    <label for="email2"> Vehicle Names(Experience)</label>
                                                    <input required type="text" class="form-control" id="email_id" name="vehicle_type" placeholder="Vehicle Brand Names"  >
                                                </div>

                                                <div class="form-group col-md-6">    
                                                    <label for="email2">Total Driving Experience(In years)</label>
                                                   
                                                    <input required type="text"  class="form-control" id="experiences" name="experiences" placeholder="Total Years">
                                                </div>


                                                <div class="form-group col-md-6" >    
                                                            <label for="email2">License Expiry Date</label>
                                                            <input required  type="date" class="form-control" id="last_date" name="last_date"  >
                                                    </div>
                                                    
                                                    <div class="form-group col-md-6" >    
                                                            <label for="email2">House Address</label>
                                                            <textarea required type="text" class="form-control" id="email2" name="address"  ></textarea>
                                                            </div>
                                                <div class="form-group col-md-6" >    
                                                            <label for="email2">Driving Previous Experience Details</label>
                                                            <textarea required type="text" class="form-control" id="email2" name="Add_remarks"  placeholder="Driving Experience Details"></textarea>
                                                    </div>	
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Exp Date</label>
                                                <input readonly type="text" value="<?php echo $futureDate ?>" class="form-control" id="exp_date" name="exp_date">
                                                </div>

                                                    <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Amount</label>
                                                        <div id="amount_job_secound">
                                                        <input readonly type="text" value="<?php echo  $macate_search->amount ?>" class="form-control" id="amount" name="amount">
                                                        </div>
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



            
        //     function amount_filter(id){
              
     
        //       var id =id;      
          
        
         
        //   $.ajax({
        //                type: "POST",
        //                url: "driver_job_categor_fil.php",
        //                data:{id:id}, 
        //                success: function(data)
        //                {
                        
        //                $('#cat_filter').html(data);
                  
        //                console.log(data);
        //                }
        //            });
         
        //            $.ajax({
        //       type: "POST",
        //       url: "job_amount.php",
        //       data:{id:id}, 
        //       success: function(data)
        //       {
        //         //alert(data);
        //       $('#amount_job').html(data);
         
        //       console.log(data);
        //       }
        //   });
         
                   
        //   }
         
         

            </script>