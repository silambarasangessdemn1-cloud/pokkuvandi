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
             <form  method="POST" action="dir_add2.php" enctype="multipart/form-data">
  <div class="row">
  <?php 
  $maincatev=mysqli_query($config,"SELECT * FROM `dir_package` where dir_packid='".$_GET['packid']."'");

$macateh=mysqli_fetch_object($maincatev);
  ?>
    <input id="" name="vid" type="hidden" class="form-control" value="<?php echo $_GET['vid'];?>" >

  <input id="finaltotal" name="finaltotal" type="hidden" class="form-control" value="<?php echo $macateh->dir_amount ?>" >
    <input id="addonarea" name="addonarea" type="hidden" class="form-control"  value="<?php echo $macateh->add_on_area ?>"  >

    <input id="dir_amount" name="dir_amount" type="hidden" class="form-control" value="<?php echo $macateh->dir_amount ?>" >
    <input id="noofarea" name="noofarea" type="hidden" class="form-control" value="<?php echo $macateh->noofarea ?>" >
    <input id="noofkey"  name="noofkey" type="hidden" class="form-control" value="<?php echo $macateh->noofkey ?>"  >
    <input id="dir_commission"  name="dir_commission" type="hidden" class="form-control" value="<?php echo $macateh->dir_commission ?>" >
    <input id="areacost"  name="area_cost" type="hidden" class="form-control" value="" >
    <input id="keywordcost"  name="keyword_cost" type="hidden" class="form-control" value="" >

    
    <div class="col-md-6">
    <label for="exampleInputEmail1">City </label>
    <select id="dir_city" name="dir_city" class="form-control">
    <option selected value="">Select</option>
    <?php 

$mc=1;

$main_cate=mysqli_query($config,"select * from dir_city_master order by (dir_city_name) ASC ");

while($macate=mysqli_fetch_object($main_cate))

{

?>

  <option value="<?php echo $macate->dir_city_id?>"><?php echo $macate->dir_city_name?></option>
  <?php }?>
</select>
    </div>
    <div class="col-md-6">
    <label for="exampleInputEmail1">AREA (Package Allowed <?php echo $macateh->noofarea ?> Area) & (Add On Area Rs.<?php echo $macateh->add_on_area ?>)</label>
    <div id="dr_area">

    </div>

    </div>

   
   
    </div>

    <div class="col-md-6">
    <label for="exampleInputEmail1">ADD ON KEYWORDS (Package Allowed <?php echo $macateh->noofkey ?> Keyword)</label>
    <select id="key" name="key[]" multiple class="form-control checkstatus">
   
    <?php 

$mc=1;

$main_cate=mysqli_query($config,"select * from dir_post order by (dir_keyword) ASC ");

while($macate=mysqli_fetch_object($main_cate))

{

?>

  <option value="<?php echo $macate->dir_post_id?>"><?php echo $macate->dir_keyword?></option>
  <?php }?>
</select>
    </div>
    
    <div class="col-md-12" id="keyselect">
        
    </div>
  </div>



  <button style="float: right;" type="submit" class="btn btn-primary"><span id="fsubmit">Submit</span></button>
            </form>

                                </div>
							</div>
            
						</div>
          
	</div>

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
    var addarea=$("#dir_area1 :selected").length;
    var addonarea=$('#addonarea').val();

    var acost=parseInt(addonarea)*parseInt(addarea);

    var cheackkey=$('#key').val();
    var key2=$('#key').val();
    var totalamount=$('#dir_amount').val();
var area=$("#dir_area1").val();

// if(key > totalkey)
// {
//   $('#keytext').html('Please Select Max '+totalkey+'Keys ')
// }else{
//   $('#keytext').html('')

// }


$.ajax({
    type: "POST",
    url: "dir_select_key.php",
    data:{cheackkey : cheackkey,area:area}, // serializes the form's elements.
    success: function(data)
    {
  $('#keyselect').html(data);
    //    alert(data);
    }
});

$.ajax({
    type: "POST",
    // dataType: 'json',
    url: "keyword_price.php",
    data: {key2:key2},
    success: function(data)
    {
    //  var total=parseInt(data)+parseInt(gtotal);
    //  var total1=parseInt(data)+parseInt(gtotal)+parseInt(dir_amount);
  $('#keywordcost').val(data)
    //  $('#fsubmit').html('Rs.'+total1)
    
   
    var keywordcost=$('#keywordcost').val();

    var final_amount=parseInt(acost)+parseInt(keywordcost)+parseInt(totalamount);
    $('#finaltotal').val(final_amount);
    $('#fsubmit').html('Submit (Area: '+acost+')+(Key: '+keywordcost+')+(Pack: '+totalamount+') =Rs.'+final_amount);
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
  var areacost=$("#addonarea").val();

  
  var cheackarea=$("#dir_area1").val();
  var city=$("#dir_city").val();
  if(area1 > totalarea)
  {
    var totalarea=(parseInt(area1)) -(parseInt(totalarea));
    var totalamount= totalarea *areacost;

    $('#areacost').val(totalamount);
  }else{
    $('#areacost').val(0);

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
    


</script>

<style>
    .form-check-label, .form-radio-label {
    margin-right: 71px;
    margin-left: 9px;
}
</style>