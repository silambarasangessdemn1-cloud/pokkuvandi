<?php include('../config/setup.php');?>

<!DOCTYPE html>

<html lang="en">

<head>

	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<title><?php 

            

            $leename=mysqli_query($config,"select Name,Name_status from lee_master");

            while($lee=mysqli_fetch_array($leename))

            {

                 $namestatus=$lee[1];

if($namestatus == 1)

{

    echo  $lee[0];

}else{

    echo "Need Name";



}



            }

            

            ?> </title>

	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

	<link rel="icon" href="<?php 

            

            $inro_logo=mysqli_query($config,"select Logo_Path,logo_status from lee_master");

            while($logo=mysqli_fetch_array($inro_logo))

            {

                 $logstatus=$logo[1];

if($logstatus == 1)

{

	

	 $ms=substr($logo[0],3);

				  echo  $ms;

	

     

}else{

    echo "../../photos/logo/no_logo.png";



}



            }

            

            ?>" type="image/x-icon"/>

	

	<!-- Fonts and icons -->

	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>

	<script>

		WebFont.load({

			google: {"families":["Lato:300,400,700,900"]},

			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},

			active: function() {

				sessionStorage.fonts = true;

			}

		});

	</script>



	<!-- CSS Files -->

	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">

	<link rel="stylesheet" href="../assets/css/atlantis.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->

	<link rel="stylesheet" href="../assets/css/demo.css">

</head>

<body>

	<div class="wrapper">

		<div class="main-header">

			<!-- Logo Header -->

			 <?php include('logo.php');?>

			<!-- End Logo Header -->



			<!-- Navbar Header -->

			<?php include('topbar.php');?>

			 <!-- End Navbar -->

		</div>

		<!-- Sidebar -->

		<?php include('sidebar.php');?>

        <div class="main-panel">

<div class="content">

    <div class="page-inner">
        <div class="card">

        <form action="expiry_report.php " method="post">
            <div class="form-group row">
              <label for="staticEmail" class="col-sm-1 col-form-label">From Date</label>
              <div class="col-sm-2">
                <input type="date"  class="form-control" id="email2" name="from_date"  >
              </div>
              
              <label for="staticEmail" class="col-sm-1 col-form-label">To Date</label>
              <div class="col-sm-2">
                <input type="date"  class="form-control" id="email2" name="to_date"  >
              </div>
              <label for="staticEmail" class="col-sm-1 col-form-label">Main Category </label>
              <div class="col-sm-2">
                 
                    <select  class="form-control" name="main_cate_Name" id="main_cate_Name">
                     <option value="0">---SELECT---</option>
                    <?php                            
                    $main_cate=mysqli_query($config,"select * from main_category where Main_Category_Status=1");
                                                                        while($addsubcate=mysqli_fetch_object($main_cate))
                    {            
                                               
                   ?>
                                        
                   <option value="<?php echo $addsubcate->Main_Category_id;?>"><?php echo $addsubcate->Main_Category_Name;?></option>
                  <?php } ?>
                                    
                 </select>
              </div>

              <label for="staticEmail" class="col-sm-1 col-form-label">District </label>
              <div class="col-sm-2">
                 
                    <select  class="form-control" name="district" id="district" onchange="area(this.value);">
                     <option value="0">--SELECT--</option>
                    <?php                            
                    $main_disct=mysqli_query($config,"select * from dir_city_master");
                     while($main_disct__=mysqli_fetch_object($main_disct))
                    {            
                                               
                   ?>
                                        
                   <option value="<?php echo $main_disct__->dir_city_id  ;?>"><?php echo $main_disct__->dir_city_name;?></option>
                  <?php } ?>
                                    
                 </select>
              </div>
              </div>      
                    <div class="form-group row">     
              <label for="staticEmail" class="col-sm-1 col-form-label">City</label>
              <div class="col-sm-2" id="area">
                  
                   
              </div>
              <label for="staticEmail" class="col-sm-1 col-form-label">Area</label>
              <div class="col-sm-2" id="sa">
                 
                   
              </div>

              <div class="col-sm-12">
                 <button class="btn btn-primary btn-lg btn-block" name="date_filter" >Submit</button>
              </div>

            </div>
        </form>
                    <hr>

                             <div class="card-body">
                             <h4 class="page-title">Expiry Report</h4>
                             <table id="dtHorizontalExample" class="table table-striped table-bordered table-sm" cellspacing="0"
  width="100%">
                                     <thead>
                                         <tr>
                                             <th scope="col">#</th>
                                             <th scope="col">Customer</th>
                                             <th scope="col">Category</th>
                                            <th scope="col">Sub category</th>
                                             <th scope="col">Driver Name</th>
                                             <th scope="col">Vehicle Name</th>                                             
                                            <th scope="col">Create On</th>
                                            <th scope="col">Expiry Date</th>
                                            <th scope="col">District</th>
                                            <th scope="col">City</th>
                                            <th scope="col">Area</th>
                                            <th scope="col">Referred By Mobile No</th>
                                            <th scope="col">Referred By Name</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                 <?php 
                                  $x=0;

                                 if(isset($_POST['date_filter']))
                                 {
                                  $from_date=$_POST['from_date'];
                                    $to_date=$_POST['to_date'];
                                     $main_category=$_POST['main_cate_Name'];
                                     $district=$_POST['district'];
                                     $city=$_POST['city'];
                                     $area=$_POST['area'];
                                 
                                  if($from_date!='' && $to_date!='' && $main_category =='0' && $district =='0' && $city =='' && $area =='')
                                  {        
                                   // echo "1"  ;
                                // echo $query="select * from create_post where expiry_date >='$from_date' and  expiry_date <='$to_date' order by post_id  DESC ";
                                  $Recent_customer=mysqli_query($config,"select * from create_post where expiry_date >='$from_date' and  expiry_date <='$to_date' order by post_id  DESC ");
                                  }
                                  else if($from_date!='' && $to_date!='' && $main_category!='' && $district =='0' && $city =='' && $area =='')
                                  {
                                    $Recent_customer=mysqli_query($config,"select * from create_post where expiry_date >='$from_date' and  expiry_date <='$to_date' and category_id='$main_category' order by post_id  DESC ");
                                  }
                                  else if($district!='' && $main_category =='0' && $city =='' && $area =='')
                                  {
                                    $Recent_customer=mysqli_query($config,"select * from create_post where expiry_date >='$from_date' and  expiry_date <='$to_date' and city_id='$district' order by post_id  DESC ");
                                  }
                                  else if($from_date!='' && $to_date!='' && $main_category!='' )
                                  {
                                  //  echo $query="select * from create_post where  expiry_date >='$from_date' and  expiry_date <='$to_date' and category_id='$main_category' order by post_id  DESC ";
                                    $Recent_customer=mysqli_query($config,"select * from create_post where  expiry_date >='$from_date' and  expiry_date <='$to_date' and category_id='$main_category' order by post_id  DESC ");
                                  }
                                  else if($district !=''  && $from_date !='' && $to_date !='' && $main_category !='' && $city !='' && $area !='')
                                  {
                                  
                                    $Recent_customer=mysqli_query($config,"select * from create_post where expiry_date >='$from_date' and  expiry_date <='$to_date' and area_id='$city' and city_id='$district' and sub_area_id='$area' order by post_id  DESC ");
                                  }
                                  else
                                  {
                                    echo "";
                                  }
                                
                                 }
                                 else
                                 {
                                  // echo $query="select * from create_post where expiry_date >='$from_date' and  expiry_date <='$to_date' order by post_id  DESC";
                                  $Recent_customer=mysqli_query($config,"select * from create_post where expiry_date >='$from_date' and  expiry_date <='$to_date' order by post_id  DESC ");
                                 }

                                         
                                         
                                         while($recent_cust=mysqli_fetch_object($Recent_customer))
                                         {
                                            $x++;
                                           // echo $query="select * from post_main_category where Main_Category_id='$recent_cust->main_cate_id' order by Main_Category_id  DESC";
                                            $Recent_customer_=mysqli_query($config,"select * from main_category where  Main_Category_id='$recent_cust->category_id' order by Main_Category_id  DESC ");
                                            $recent_cust__=mysqli_fetch_object($Recent_customer_);

                                            $customer_=mysqli_query($config,"select * from sub_category where  Sub_Category_id='$recent_cust->subcategory_id' order by Sub_Category_id  DESC ");
                                            $cust__=mysqli_fetch_object($customer_);

                                              $cus_=mysqli_query($config,"select * from customer_master where Customer_Phone_No='$recent_cust->phone_no' ");
                                            $cust___=mysqli_fetch_object($cus_);

                                            $cus_city=mysqli_query($config,"select * from dir_city_master where dir_city_id='$recent_cust->city_id' ");
                                            $cus_city__=mysqli_fetch_object($cus_city);

                                            $cus_area=mysqli_query($config,"select * from dir_area_master where dir_area_id='$recent_cust->area_id' ");
                                            $cus_area__=mysqli_fetch_object($cus_area);


                                            $cus_sub=mysqli_query($config,"select * from sub_area_master where sub_area_id='$recent_cust->sub_area_id' ");
                                            $cus_sub__=mysqli_fetch_object($cus_sub);

                                            $cus_=mysqli_query($config,"select * from customer_master where Customer_Phone_No='$recent_cust->phone_no' ");
                                            $cust___=mysqli_fetch_object($cus_);
                                         ?>
                         
                         
                             <tr>
                                             <td><?php echo $x; ?></td>

                                             
                                             <td><?php echo $cust___->Customer_Name; ?></td>
                                                 <td><?php echo $recent_cust__->Main_Category_Name; ?></td>
                                                 <td><?php echo $cust__->Sub_Category_Name; ?></td>
                                                 <td><?php echo $recent_cust->driver_name; ?></td>
                                                 <td><?php echo $recent_cust->vehicle_name; ?></td>
                                             <td><?php  
                                             
                                                 $main_cate_date = strtotime($recent_cust->create_on);
           echo  date('d-m-Y',$main_cate_date).'<br>';
        //    echo  date('h:m a',$main_cate_date);
                                             
                                             ?></td>
                                              <td><?php  
                                             
                                             $main_cate_date = strtotime($recent_cust->expiry_date);
                                             echo  date('d-m-Y',$main_cate_date).'<br>';  
                                         
                                         ?></td>
                                             <td><?php echo $cus_city__->dir_city_name; ?></td>
                                             <td><?php echo $cus_area__->dir_area_name; ?></td>
                                             <td><?php echo $cus_sub__->sub_area_name; ?></td>
                                                 
                                             <td><?php echo $recent_cust->reffered_by_phone_no; ?></td>
                                             <td><?php echo $recent_cust->reffered_by_name; ?></td>
                                                 
                                                 
                                         </tr>
                                          <?php  $cid++;} ?>
                                     </tbody>
                                 </table>
                          
                          
                             </div>
                             </div>                        
                             </div>
                        </div>                            

            </div>
			 <?php include('footer.php');?>

		</div>

		

		 

		<!-- End Custom template -->

	</div>

	<!--   Core JS Files   -->

	<script src="../assets/js/core/jquery.3.2.1.min.js"></script>

	<script src="../assets/js/core/popper.min.js"></script>

	<script src="../assets/js/core/bootstrap.min.js"></script>

	<!-- jQuery UI -->

	<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>

	<script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

	

	<!-- jQuery Scrollbar -->

	<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

	<!-- Datatables -->

	<script src="../assets/js/plugin/datatables/datatables.min.js"></script>

	<!-- Atlantis JS -->

	<script src="../assets/js/atlantis.min.js"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->

	<script src="../assets/js/setting-demo2.js"></script>

	<script >

		$(document).ready(function() {

			$('#basic-datatables').DataTable({

			});



		 

 

			 

		});

	</script>

</body>

</html>





<script>
   $(document).ready(function() {
  var counter = 2;
  $("#addButton").click(function() {
    if (counter < 2) {
      alert("Add more textbox");
      return false;
    }

    var newTextBoxDiv = $(document.createElement('div'))
      .attr("id", 'TextBoxDiv' + counter).attr("class", 'TextBoxDiv');
       
    newTextBoxDiv.after().html('<label>Area ' + counter + ' : </label>' +
      '<input type="text"  class="form-control" id="email2" name="area[]" id="textbox' + counter + '"  placeholder="Enter area Name"  >' +
      '<input type="button" name="button' + counter +
      '" class="removeButton btn btn-danger btn-sm" value="Remove Area">');
    newTextBoxDiv.appendTo("#TextBoxesGroup");
  
    counter++;
  });

  $("body").on("click", ".removeButton", function() {
    if (counter <= 2) {
      alert("No more textbox to remove");
      return false;
    }

    $(this).closest('.TextBoxDiv').remove();
  });
});
</script>


<style>
    .btn-danger {
    background: #f25961!important;
    border-color: #f25961!important;
    margin-top: 7px;
    margin-bottom: 4px;
}
</style>

<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel"></h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

        <form action="Function/dir_area_master.php" method="POST" enctype="multipart/form-data">
		<div class="form-group">

<label for="email2">City Name</label>



<select name="cate" class="form-select form-control" aria-label="Default select example">
  <option selected>Select </option>
  <?php 

										

											$main_cate1=mysqli_query($config,"select * from dir_city_master ");

											while($macate1=mysqli_fetch_object($main_cate1))

											{

											?>
  <option value="<?php echo $macate1->dir_city_id?>"><?php echo $macate1->dir_city_name?></option>
 <?php }?>
</select>
</div>  
	
	
		<div class="form-group" >
      
		

			<input type="file"   class="form-control" id="email2" name="excel"  placeholder="Enter area Name"  > <br>
			<small> <b style="color: red;">Only For CSV Format  File <b></small>
            </div>
			<div class="form-group" >
				<a href="Area_demo.csv"  download="Area_demo.csv" >Demo Csv File Download</a>
	  </div>
      </div>
	  <div class="form-group" >
	  </div>
      <div class="modal-footer">

      <button class="btn btn-primary" type="submit" name="exsubmit">Submit</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	</form>
        

      </div>

    </div>

  </div>

</div>

<script>



function sub_area(id){
                     var id;
                   //alert(id);
             
                    $.ajax({
                        type: "POST",
                        url:'sub_area_post.php',
                        data: {id:id}, // serializes the form's elements.
                        success: function(data)
                        {	
                            //alert(data);		
                            console.log(data)
                        $('#sa').html(data);
                        
                        }			
                    });	
                    
                  }

 function area(id) {
               
  var id =id;

            $.ajax({
                type: "POST",
                url: "area_post.php",
                data:{id:id}, 
                success: function(data)
                {
                
                $('#area').html(data);

                console.log(data);
                }
            });
            }

            $(document).ready(function () {
  $('#dtHorizontalExample').DataTable({
    "scrollX": true
  });
  $('.dataTables_length').addClass('bs-select');
});

  </script>