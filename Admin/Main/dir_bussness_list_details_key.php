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

						<h4 class="page-title"><a href="bussness_list.php" class="b"><i class="fa fa-long-arrow-left"> </i></a>EDIT KEYWORD	</h4>

						 

					</div>

					<div class="row">

						<div class="col-md-12">

							<div class="card">

              <?php 
    $sql7="SELECT * FROM `dir_keyword` INNER JOIN dir_area_master ON dir_area_master.dir_area_id=dir_keyword.dir_vender_area where  dir_vender_id='".$_GET['eid']."' GROUP by(dir_area_id)";
    $mainarea=mysqli_query($config,$sql7);
    while($b_area=mysqli_fetch_object($mainarea))
    { ?>
<h5 style='color:red;    margin-left: 2%;
    margin-top: 2%;
    margin-bottom: 0%;font-size: 17px;'><b>
 Area <span style="color: green;">(<?php echo $b_area->dir_area_name?>)</span></b>

</h5>

<div class="card">
  <div class="card-body">
<div class='row'>
<?php 
     $sql9="SELECT * FROM `dir_keyword` INNER JOIN dir_post ON dir_keyword.dir_vender_key=dir_post.dir_post_id  INNER JOIN dir_package ON dir_package.dir_packid=dir_keyword.dir_vender_pack where  dir_vender_id='".$_GET['eid']."' and dir_vender_area='$b_area->dir_vender_area'";
    $maina=mysqli_query($config,$sql9);
    while($barea=mysqli_fetch_object($maina))
    { ?>

  <span class="keys"><?php echo $barea->dir_keyword?> &nbsp; <small style="color: red;"><?php  echo $barea->dir_title?></small> &nbsp; <a style="color: white;" href="vender_key_delete.php?id=<?php echo $barea->dirkeyid?>&eid=<?php echo $_GET['eid'] ?>&packid=<?php echo $_GET['packid'] ?>" onclick="return confirm('Are you confirm to delete this <?php echo $barea->dir_keyword?> in <?php echo $b_area->dir_area_name?>');"> <i class="fa fa-trash" aria-hidden="true"></i></a>  &nbsp;<a  data-toggle="modal" data-target="#exampleModalk<?php echo $barea->dirkeyid?>"><i class="fas fa-edit"></i>  </a>
</span>




<div class="modal fade" id="exampleModalk<?php echo $barea->dirkeyid?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="" method="POST" action="vender_key_delete.php">
      <div class="modal-body">
      <div class="form-group">
   
      <label for="exampleInputEmail1">City </label>
<input type="hidden" name="id" value="<?php echo $barea->dirkeyid?>">
<input type="hidden" name="eid" value="<?php echo $_GET['eid'];?>">
<input type="hidden" name="packid" value="<?php echo $_GET['packid'];?>">

      <select id="dir_city<?php echo $barea->dirkeyid?>" onchange="keyeditcity('<?php echo $barea->dirkeyid?>');" name="dir_city" class="form-control">
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
      <div class="form-group">
      <label for="exampleInputEmail1">Area </label>
      <div id="dr_area<?php echo $barea->dirkeyid?>">
    </div>
      </div>

      </div>

      <div class="form-group">
<label for="exampleInputEmail1">KEYWORDS </label>
<select name="keywords" id="keywordedit<?php echo $barea->dirkeyid?>"  onchange="keywedit('<?php echo $barea->dirkeyid?>');"  class="form-control checkstatus">

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
<div class="form-group" id="package<?php echo $barea->dirkeyid?>">
</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="editkeywordss" class="btn btn-primary">Edit</button>
</form>
      </div>
    </div>
  </div>
</div>



<?php }?>
</div>
</div>

</div>

<?php }?>

<div class="card">

<?php 

 $s="SELECT * FROM `dir_keyword` where dir_vender_id='".$_GET['eid']."'";
$main_cate=mysqli_query($config,$s);

$macate1=mysqli_fetch_object($main_cate);?>
								

								<div class="card-body" style="display: none;">
                <center><h4 style="
    font-weight: 600;
    color: red;
    font-size: 19px;
">Edit Keyword</h4></center>
             <form id="adddetails" method="POST" action="dir_edit.php" enctype="multipart/form-data">
  <div class="row">

  <div class="col-6">
  <label for="exampleFormControlSelect2">City</label>
  <input type="hidden" name="packid" value="<?php echo $macate1->dir_vender_pack?>"> 
  <input type="hidden" name="vid" value="<?php echo $macate1->dir_vender_id?>"> 

  <select id="" name="dir_city" class="form-control">

    <?php 

$mc=1;

$main_cate=mysqli_query($config,"select * from dir_city_master order by (dir_city_name) ASC ");

while($macate=mysqli_fetch_object($main_cate))

{

?>

  <option <?php  if($macate1->dir_vender_city == $macate->dir_city_id){ echo 'selected';} ?> value="<?php echo $macate->dir_city_id?>"><?php echo $macate->dir_city_name?></option>
  <?php }?>
</select>
    </div>
    

    <div class="col-6">

    <label for="exampleFormControlSelect2">Area</label>
<select class="form-control checkstatus" name="area[]"   multiple>

<?php

    $m="SELECT * FROM `dir_keyword` INNER JOIN dir_area_master ON dir_area_master.dir_area_id=dir_keyword.dir_vender_area where dir_vender_id='".$_GET['eid']."' GROUP by (dir_keyword.dir_vender_area)";
$main_cate=mysqli_query($config,$m);

while($macate3=mysqli_fetch_object($main_cate))

{ 
  
    ?>



 <option selected value="<?php echo $macate3->dir_area_id?>"><?php echo $macate3->dir_area_name?></option>
 <?php } 
 
?>
</select>
    </div>
    <div class="col-6">

<label for="exampleFormControlSelect2">Keyword</label>
<select class="form-control checkstatus" name="key[]"   multiple>

<?php

$m="SELECT * FROM `dir_keyword` INNER JOIN dir_post ON dir_keyword.dir_vender_key=dir_post.dir_post_id where dir_vender_id='".$_GET['eid']."' GROUP BY(dir_vender_key)";
$main_cate=mysqli_query($config,$m);

while($macate3=mysqli_fetch_object($main_cate))

{ 

?>



<option selected value="<?php echo $macate3->dir_vender_key?>"><?php echo $macate3->dir_keyword?></option>
<?php } 

?>
</select>
    </div>
 

                                </div>
                                <button name="keyedit" style="float: right;" type="submit" class="btn btn-primary"><span id="fsubmit">Submit</span></button>
            </form>
							</div>
            
						</div>
          


			




      <div class="row">

<div class="col-md-12">

  <div class="card">
<center><h3 style="color: red;">Add New Keywords</h3></center>
    

    <div class="card-body">
 <form  method="POST" action="dir_add3.php" enctype="multipart/form-data">
<div class="row">
<?php 
$maincatev=mysqli_query($config,"SELECT * FROM `dir_package` where dir_packid='".$_GET['packid']."'");

$macateh=mysqli_fetch_object($maincatev);
?>
<input id="" name="vid" type="hidden" class="form-control" value="<?php echo $_GET['eid'];?>" >

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



<button style="float: right;" type="submit" class="btn btn-primary"><span id="fsubmit1">Submit</span></button>
</form>

                    </div>
  </div>

</div>

</div>

</div>

</div>
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
  
    var sarea=$("#dir_area1 :selected").length;

    var cheackkey=$('#key').val();
    var key2=$('#key').val();
    var totalamount=$('#dir_amount').val();
var area=$("#dir_area1").val();
var areacost=$('#addonarea').val();
// console.log(sarea);
// console.log(areacost);

$.ajax({
    type: "POST",
    url: "dir_select_key.php",
    data:{cheackkey : cheackkey,area:area}, // serializes the form's elements.
    success: function(data)
    {
  $('#keyselect').html(data);
  // alert(data);
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
    
   
  
    var totalarea=parseInt(areacost) * parseInt(sarea);
   
    var keywordcost=$('#keywordcost').val();

    var final_amount=parseInt(totalarea)+parseInt(keywordcost);
    $('#finaltotal').val(final_amount);
    
    $('#fsubmit1').html('Submit (Area: '+totalarea+')+(Key: '+keywordcost+')= Rs.'+final_amount);
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

function keyeditcity(id) {
var city=$('#dir_city'+id).val();
    $.ajax({
        type: "POST",
        url: "dir_keyarea.php",
        data: {city:city,id:id}, // serializes the form's elements.
        success: function(data)
        {
         $('#dr_area'+id).html(data);
        //  $('#more_area2').html(data);

        }
    });
}

function  keywedit(id) {

  var area=$("#areaedit"+id).val();
var cheackkey=$('#keywordedit'+id).val();
console.log(area);
console.log(cheackkey);
$.ajax({
    type: "POST",
    url: "dir_editkey_se.php",
    data:{cheackkey : cheackkey,area:area}, 
    success: function(data)
    {
    
  $('#package'+id).html(data);

    }
});
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
<style>
    .keys{
      border: 1px solid rgb(4, 170, 109);
    padding: 1%;
    margin: 1%;
    background: rgb(4, 170, 109);
    border-radius: 23px;
    color: white;
    font-weight: 400;
    }

    .editkey{
      margin-left: 4.75rem;
    }
    .editkd{
      margin-left: 0.75rem;
    }
</style>