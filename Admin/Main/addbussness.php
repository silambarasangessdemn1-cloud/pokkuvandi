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

					<div class="page-header">

						<h4 class="page-title">ADD BUSINESS	</h4>

						 

					</div>

					<div class="row">

						<div class="col-md-12">

							<div class="card">

								

								<div class="card-body">
             <form id="adddetails" method="POST" action="dir_add.php" enctype="multipart/form-data">
  <div class="row">
  <div class="col-md-6">
    <label for="exampleInputEmail1">Registered Customer Phone Number</label>
    <input class="form-control" autocomplete="off" list="browsers" name="cust_id" id="browser" value="<?php echo $_GET['phone'];?>">
  <datalist id="browsers">
  <?php 



$maincate=mysqli_query($config,"SELECT * FROM `customer_master`");

while($macat=mysqli_fetch_object($maincate))

{

?>
    <option  data-value="<?php echo $macat->Customer_Id ?> "><?php echo $macat->Customer_Phone_No ?>
<?php }?>
  </datalist>
  
  </div>
  <div class="col-md-6">
    <label for="exampleInputEmail1">PACKAGE MASTER</label>

    <select id="pack" name="packid"  class="form-control" style="border: 1px solid red;">
    <option selected value="">Select</option>
   <?php 

$mc=1;

$main_cate=mysqli_query($config,"SELECT * FROM `dir_package`");

while($macate=mysqli_fetch_object($main_cate))

{

?>

 <option value="<?php echo $macate->dir_packid?>"><?php echo $macate->dir_title?></option>
 <?php }?>
</select>
    </div>
  

    <div class="col-md-6">
    <label for="exampleInputEmail1">COMPANY NAME</label>

      <input type="text" name="c_name" class="form-control" required >
    </div>
    <div class="col-md-6">
    <label for="exampleInputEmail1">EMAIL ID </label>
      <input type="email" name="c_email" autocomplete="off" class="form-control" required >
    </div>
    <div class="col-md-6">
    <label for="exampleInputEmail1">PHONE NUMBER </label>
      <input type="number" name="c_phone" class="form-control" required >
    </div>
    <div class="col-md-6">
    <label for="exampleInputEmail1">WEBSITE LINK </label>
      <input type="text" name="site_link" class="form-control" required >
    </div>
    <div class="col-md-6">
    <label for="exampleInputEmail1">LOGO  </label>
      <input id="" type="file" name="logo" class="form-control "  required>
    </div>
    <div class="col-md-6">
    <label for="exampleInputEmail1">GALLERY  </label>
      <input  multiple

  max="10" id="file" type="file" name="image[]" class="form-control multi" >
  <span style="color: red;" id="filetext"></span>
    </div>
    <div class="col-md-6">
    <label for="exampleInputEmail1">ABOUT US (DESCRIPTION) </label>
      <textarea type="text" name="about" class="form-control" ></textarea>
    </div>
    <div class="col-md-6">
    <label for="exampleInputEmail1">FEATURES KEYWORD </label>
      <textarea type="text" name="fkeys" class="form-control" ></textarea>
    </div>
    <div class="col-md-6">
    <label for="exampleInputEmail1">ADDRESS  </label>
      <textarea type="text" name="c_address" class="form-control" ></textarea>
    </div>
    <div class="col-md-6">
    <label for="exampleInputEmail1">City  </label>
    

    <select name="c_city" class="form-control" id="c_city">
    <option>Select</option>
    <?php $maine=mysqli_query($config,"SELECT * FROM `dir_city_master`");

while($macateb=mysqli_fetch_object($maine))

{ ?>
      <option value="<?php echo $macateb->dir_city_name ?>"><?php echo $macateb->dir_city_name ?></option>
    <?php }?>
    </select>
    </div>
    <div class="col-md-6">
    <label for="exampleInputEmail1">Area  </label>
    <!-- <input type="text" name="c_area" class="form-control" > -->

    <div id="c_area_c">

    </div>

    </div>
    <div class="col-md-6">
    <label for="exampleInputEmail1">LOCATION MAP (Iframe Link)  </label>
    <input type="text" name="map" class="form-control" >
    </div>
    <div class="col-md-6">
    <label for="exampleInputEmail1">VIDEO (Iframe Link)</label>
    <input type="text" name="video" class="form-control" >
    </div>
    <div class="col-md-6">
    <label for="exampleInputEmail1">WHATSAPP NUMBER  </label>
    <input type="text" name="whatsapp" class="form-control" >
    </div>
    <div class="col-md-6">
    <label for="exampleInputEmail1">FACEBOOK </label>
    <input type="text" name="fb" class="form-control" >
    </div>
    <div class="col-md-6">
    <label for="exampleInputEmail1">INSTAGRAM </label>
    <input type="text" name="instagram" class="form-control" >
    </div>
    <div class="col-md-6">
    <label for="exampleInputEmail1">TWITTER </label>
    <input type="text" name="twitter" class="form-control" >
    </div>
    <div class="col-md-6">
    <label for="exampleInputEmail1">WORKING WEEKLY DAY </label>
    <div class="form-group form-check">
        
    <input type="checkbox"  name="weeks[]" value="Monday" class="form-check-input" id="">
    <label class="form-check-label" for="exampleCheck1">Monday   <span style="margin-left: 2%;">From :</span> <input type="time" id="appt" name="formtime[]"><span>To:</span><input type="time" id="appt" name="totime[]"></label><br>


    <input type="checkbox" value="Tuesday" name="weeks[]" class="form-check-input" id="">
    <label class="form-check-label" for="exampleCheck1">Tuesday <span style="margin-left: 2%;">From :</span> <input type="time" id="appt" name="formtime[]"> <span>To: </span><input type="time" id="appt" name="totime[]"></label><br>
    <input type="checkbox" value="Wednesday" name="weeks[]" class="form-check-input" id="">
    <label class="form-check-label" for="exampleCheck1">Wednesday <span style="margin-left: 2%;">From :</span> <input type="time" id="appt" name="formtime[]"> <span>To: </span><input type="time" id="appt" name="totime[]"></label><br>
    <input type="checkbox" value="Thursday" name="weeks[]" class="form-check-input" id="">
    <label class="form-check-label" for="exampleCheck1">Thursday <span style="margin-left: 2%;">From :</span> <input type="time" id="appt" name="formtime[]"> <span>To: </span><input type="time" id="appt" name="totime[]"></label><br>
    <input type="checkbox" value="Friday" name="weeks[]" class="form-check-input" id="">
    <label class="form-check-label" for="exampleCheck1">Friday <span style="margin-left: 2%;">From :</span> <input type="time" id="appt" name="formtime[]"> <span>To: </span><input type="time" id="appt" name="totime[]"></label><br>
    <input type="checkbox" value="Saturday" name="weeks[]" class="form-check-input" id="">
    <label class="form-check-label" for="exampleCheck1">Saturday <span style="margin-left: 2%;">From :</span> <input type="time" id="appt" name="formtime[]"> <span>To: </span><input type="time" id="appt" name="totime[]"></label><br>
    <input type="checkbox" value="Sunday" name="weeks[]" class="form-check-input" id="">
    <label class="form-check-label" for="exampleCheck1">Sunday <span style="margin-left: 2%;">From :</span> <input type="time" id="appt" name="formtime[]"> <span>To: </span><input type="time" id="appt" name="totime[]"></label><br>
  </div>
    </div>
   
    <div class="col-md-6">
    <label for="exampleInputEmail1">NO.OF DURATION (DAYS) </label>
    <input id="package_valid" name="package_valid" type="number" class="form-control" >
    </div>
    <input id="dir_commission" name="com" type="hidden" class="form-control" >
    <input id="dir_commission" name="rid" type="hidden" class="form-control" value="<?php echo $_GET['rid'] ?>" >

    <input id="dir_amount" name="damount" type="hidden" class="form-control"  >

    <input id="" name="c_id" type="hidden" class="form-control" value="<?php echo $_GET['cid']; ?>" >

                              
					
          
	</div>

  <button style="float: right;" type="submit" class="btn btn-primary"><span id="fsubmit">Submit</span></button>
            </form>
				</div>

			</div>

			

			<!-- Modal -->



  </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="path/to/your/jquery.MultiFile.js" type="text/javascript" language="javascript"></script>
<script>
$(document).ready(function(){
    $("#file").change(function() {
         var file = $("#file").val();
            var lg = file.files.length;
                console.log(lg);
        alert();
  
});
$("#dir_city").change(function(){
    var city=$('#dir_city').val();
    $.ajax({
        type: "POST",
        url: "dir_area_choose.php",
        data: {city:city}, // serializes the form's elements.
        success: function(data)
        {
         $('#dr_area').html(data);
         $('#more_area2').html(data);

        }
    });
});
$("#pack").change(function(){
  var id=$('#pack').val();
  $.ajax({
        type: "POST",
        url: "dir_package_check.php",
        data: {id:id},
        dataType: "json",
        success: function(data)
        {
        
          $('#fsubmit').html('Rs.'+data.dir_amount);
      $('#addonarea').val(data.add_on_area);
      $('#dir_commission').val(data.dir_commission);
      $('#noofkey').val(data.noofkey);
      $('#noofarea').val(data.noofarea);
      $('#total_member').val(data.total_member);
      $('#package_valid').val(data.package_valid);
      $('#dir_amount').val(data.dir_amount);
      $('#pack').css('border','1px solid #ebedf2');

        }
    });
  });


  $("#key").change(function(){
  
    var key=$("#key :selected").length;
    var cheackkey=$('#key').val();
var totalkey=$("#noofkey").val();
if(key > totalkey)
{
  $('#keytext').html('Please Select Max '+totalkey+'Keys ')
}else{
  $('#keytext').html('')

}


$.ajax({
    type: "POST",
    url: "checkkey.php",
    data:{cheackkey : cheackkey,}, // serializes the form's elements.
    success: function(data)
    {
       $('#addkey').html(data);
    //    alert(data);
    }
});

  });


  $('.checkstatus').on('change', function() {
    
var msg='';
$.ajax({
    type: "POST",
    // dataType: 'json',
    url: "keyword_price.php",
    data: {key2:key2,area2:area2},
    success: function(data)
    {
     var total=parseInt(data)+parseInt(gtotal);
     var total1=parseInt(data)+parseInt(gtotal)+parseInt(dir_amount);
     $('#finaltotal').val(total)
     $('#fsubmit').html('Rs.'+total1)
    
    }
});

    $.ajax({
    type: "POST",
    // dataType: 'json',
    url: "keywordscheck.php",
    data: $('#adddetails').serialize(), 
    success: function(data)
    {
        if(data ==0)
        {
            $('#result').html('');
            
        }else{
            msg +='<div class="alert alert-danger" role="alert">'+data+' <a href="vendor.php" class="alert-link">Keyword available in other package</a></div>';
     $('#result').html(msg);
    }
    }
});

});

});

</script>		
<script>
function  keys2() { 

  var key2=$('#key2').val();
  var area2=$('#dir_area2').val();
  var addonarea=$('#addonarea').val();
  var dir_amount=$('#dir_amount').val();
  var area2=$("#dir_area2 :selected").length;
  var gtotal=parseInt(addonarea)*parseInt(area2)
  var msg='';
  $.ajax({
    type: "POST",
    // dataType: 'json',
    url: "keywordscheck.php",
    data: $('#adddetails').serialize(), 
    success: function(data)
    {
        if(data ==0)
        {
            $('#result').html('');
            
        }else{
            msg +='<div class="alert alert-danger" role="alert">'+data+' <a href="vendor.php" class="alert-link">Keyword available in other package</a></div>';
     $('#result').html(msg);
    }
    }
});

  $.ajax({
    type: "POST",
    // dataType: 'json',
    url: "keyword_price.php",
    data: {key2:key2,area2:area2},
    success: function(data)
    {
     var total=parseInt(data)+parseInt(gtotal);
     var total1=parseInt(data)+parseInt(gtotal)+parseInt(dir_amount);
     $('#finaltotal').val(total)
     $('#fsubmit').html('Rs.'+total1)
    
    }
});


}
function dir_key2()
{
   var key2=$('#key2').val();
  var area2=$('#dir_area2').val();
  var addonarea=$('#addonarea').val();
  var dir_amount=$('#dir_amount').val();
  var area2=$("#dir_area2 :selected").length;
  var gtotal=parseInt(addonarea)*parseInt(area2)
  var msg='';
  $.ajax({
    type: "POST",
    // dataType: 'json',
    url: "keywordscheck.php",
    data: $('#adddetails').serialize(), 
    success: function(data)
    {
        if(data ==0)
        {
            $('#result').html('');
            
        }else{
            msg +='<div class="alert alert-danger" role="alert">'+data+' <a href="vendor.php" class="alert-link">Keyword available in other package</a></div>';
     $('#result').html(msg);
    }
    }
});

  $.ajax({
    type: "POST",
    // dataType: 'json',
    url: "keyword_price.php",
    data: {key2:key2,area2:area2},
    success: function(data)
    {
     var total=parseInt(data)+parseInt(gtotal);
     var total1=parseInt(data)+parseInt(gtotal)+parseInt(dir_amount);
     $('#finaltotal').val(total)
     $('#fsubmit').html('Rs.'+total1)
    
    }
});

}
function myFunction() {
  
  $('#more').css("display","none");
  $('#show').css("display","block");
}
function areamore() {
  
  $('#areamore2').css("display","none");
  $('#morearea2').css("display","block");
}
</script>
<script>
//     $("#file").change(function() {
//         // var file = $("#file").val();
//         //        var lg = file[0].files.length;
//         //        console.log(lg);
//         alert();
  
// });
// $(document).ready(function(){
// $("#file").change(function(){
//   alert("The text has been changed.");
// });
// });
</script>

			

			

			
<style>
    .form-control {
    font-size: 14px;
    border-color: #ebedf2;
    padding: 0.6rem 1rem;
    margin-top: 9px;
    margin-bottom: 22px;
    height: inherit!important;
}
.footer{
    display: none;
}
.form-check [type=checkbox]:checked, .form-check [type=checkbox]:not(:checked) {
    position: relative;
 left: 0px;
 margin-left: 2px;
}
</style>
			

			

			

			

			

			

			

			

			

		</div>

		

		 

		<!-- End Custom template -->

	</div>
    <?php include('footer.php');?>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script >

		$(document).ready(function() {

			$('#basic-datatables').DataTable({

			});



		 

 

			 

		});

	</script>

<script>
  $('#file').change(function(){
   //get the input and the file list
   var input = document.getElementById('file');
   if(input.files.length>10){
      alert('Please Select Max 10 Images');
      $('#filetext').html('Please Select Max 10 Images');
   }else{
    // alert('n');
   }
});

</script>
<script>
//   $(document).ready(function(){
// $('#area1').on('change', function() {
//   alert();
//   var area1=$("#area1 :selected").length;
//   var totalarea=$("#noofarea").val();
//   if(area1 > totalarea)
//   {
//     $('#area1text').html('Please Select Max '+totalarea+'Areas ')
//   }else{
//     $('#area1text').html('')

//   }
// });
// });
function getval(sel)
{
  var area1=$("#dir_area1 :selected").length;

  var totalarea=$("#noofarea").val();
  var cheackarea=$("#dir_area1").val();
  var city=$("#dir_city").val();
  if(area1 > totalarea)
  {
    $('#area1text').html('Please Select Max '+totalarea+'Areas ')
  }else{
    $('#area1text').html('')

  }
  $.ajax({
    type: "POST",
    url: "checkarea.php",
    data:{cheackarea : cheackarea,city:city}, // serializes the form's elements.
    success: function(data)
    {
       $('#more_area2').html(data);
    //    alert(data);
    }
});
$.ajax({
    type: "POST",
    // dataType: 'json',
    url: "keywordscheck.php",
    data: $('#adddetails').serialize(), 
    success: function(data)
    {
        if(data ==0)
        {
            $('#result').html('');
            
        }else{
            msg +='<div class="alert alert-danger" role="alert">'+data+' <a href="vendor.php" class="alert-link">Keyword available in other package</a></div>';
     $('#result').html(msg);
    }
    }
});
}
</script>
</body>

</html>

<script>
$(document).ready(function(){
  $("#c_city").change(function(){

    var city=$('#c_city').val();
    $.ajax({
        type: "POST",
        url: "addse_city.php",
        data: {city:city}, // serializes the form's elements.
        success: function(data)
        {
         $('#c_area_c').html(data);
        }
    });
  });
});
</script>