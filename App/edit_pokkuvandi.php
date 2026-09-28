


<?php include('../config/setup.php');

$id=$_POST['id'];
?>

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
 <script src="
      https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js
      "></script>
      <link href="
      https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css
      " rel="stylesheet">
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
					<div class="page-header">
						<h4 class="page-title">Pokkuvandi Entry Edit</h4>
						 
					</div>
					<div class="row">
						<div class="col-md-12">

						<?php if(isset($_GET['msg']))
							{
								?>
							<div class="alert alert-primary" role="alert">
							Post Succesfully Added!!!
							</div>
							<?php }
							?>
							<?php if(isset($_GET['msgerror']))  {?>
							<div class="alert alert-primary" role="alert">
							Check The Post OR Date Will be Not Expiry!!!
							</div>
							
							<?php } ?>

							<div class="card">
								
								<div class="card-body">

<!-- Modal -->
<?php 


$i=0;
 $or_loader="SELECT * FROM `driver_pokkuvandi_entry`  where driver_pokkuvandi_entry_id='$id' Order by driver_pokkuvandi_entry_id DESC ";
$maincate3_loader=mysqli_query($config,$or_loader);             
$mac3_loader=mysqli_fetch_object($maincate3_loader);


$loader_to_date= $mac3_loader->loader_to_date;
$loader_to_time= $mac3_loader->loader_to_time;
$loader_from_date= $mac3_loader->loader_from_date;
$loader_from_time= $mac3_loader->loader_from_time;
date_default_timezone_set('Asia/Kolkata'); 
$from_date_time = date('Y-m-d H:i', strtotime("$loader_from_date $loader_from_time"));
$to_date_time = date('Y-m-d H:i', strtotime("$loader_to_date $loader_to_time"));
?>


<div class="form-group col-md-6">    
 <label for="email2">From Date</label>
 <input  value="<?php echo $from_date_time ?>" type="datetime-local" class="form-control" id="loader_from_date" name="loader_from_date"  >
</div>
<div class="form-group col-md-6">    
 <label for="email2">To Date</label>
 <input value="<?php echo $to_date_time ?>" type="datetime-local" class="form-control" id="loader_to_date" name="loader_to_date"  >
</div> 
<div class="form-group col-md-6">
    <label for="exampleFormControlSelect1">State</label>
        <select class="form-control" id="state_status" onchange="state_cha(this.value)" name="state_status">
        <option value="0">--SELECT--</option>
        <option value="1">Tamilnadu Trip</option>
        <option value="2">Other State Trip </option>                                                    
        </select>
 </div>


        


 <div id="state_field">

</div>


<div class="form-group col-md-6">    
 <label for="email2">To Place</label>
 <input value="<?php echo $mac3_loader->loader_to_place ?>"  type="text" class="form-control" id="loader_to_place" name="loader_to_place"  >
</div>   



<div class="form-group col-md-6">    
 <label for="email2">Available Space</label>
 <input value="<?php echo $mac3_loader->loader_space ?>"  type="text" class="form-control" id="loader_space" name="loader_space"  >
</div>  
<div class="form-group col-md-6">    
 <label for="email2">General Remarks</label>
 <input  value="<?php echo $mac3_loader->loader_remarks ?>" type="text" class="form-control" id="loader_remarks" name="loader_remarks"  >
</div>



<input  type="hidden" value="<?php echo $id ?>" class="form-control" id="post_id" name="post_id"  >
<?php 
if($mac3_loader)
{ ?>
   <div class="form-group">
 
    <a class="btn btn-success"  onclick="loaderpopup(<?php echo $id ?>)"  name="city_update">Update</a>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
   </div>
<?php } 
else
{?>
    <div class="form-group">
 
    <a class="btn btn-success"  onclick="loaderpopup(<?php echo $id ?>)"  name="city_update">submit</a>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
   </div>
<?php }?>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
</div>


<script> 
  function state_cha(id)
            {
            var id;
            // alert(id);
            // if(id == 1) {
              $.ajax({
                type: "POST",
                url: "state_field.php",
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