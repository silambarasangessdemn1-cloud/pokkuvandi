<?php include('../config/setup.php'); ?>

<?php

if (isset($_POST['edit']))
 {

    $sql = "UPDATE biding_vender SET status='" . $_POST['status'] . "',topupamount=topupamount+'" . $_POST['topupamount'] . "' WHERE vender_id='" . $_POST['id'] . "'";
    mysqli_query($config, $sql);
} ?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <title><?php



            $leename = mysqli_query($config, "select Name,Name_status from lee_master");

            while ($lee = mysqli_fetch_array($leename)) {

                $namestatus = $lee[1];

                if ($namestatus == 1) {

                    echo  $lee[0];
                } else {

                    echo "Need Name";
                }
            }



            ?> </title>

    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

    <link rel="icon" href="<?php



                            $inro_logo = mysqli_query($config, "select Logo_Path,logo_status from lee_master");

                            while ($logo = mysqli_fetch_array($inro_logo)) {

                                $logstatus = $logo[1];

                                if ($logstatus == 1) {



                                    $ms = substr($logo[0], 3);

                                    echo  $ms;
                                } else {

                                    echo "../../photos/logo/no_logo.png";
                                }
                            }



                            ?>" type="image/x-icon" />



    <!-- Fonts and icons -->

    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>

    <script>
    WebFont.load({

        google: {
            "families": ["Lato:300,400,700,900"]
        },

        custom: {
            "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                "simple-line-icons"
            ],
            urls: ['../assets/css/fonts.min.css']
        },

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

            <?php include('logo.php'); ?>

            <!-- End Logo Header -->



            <!-- Navbar Header -->

            <?php include('topbar.php'); ?>

            <!-- End Navbar -->

        </div>

        <!-- Sidebar -->

        <?php include('sidebar.php'); ?>





        <div class="main-panel">

            <div class="content">

                <div class="page-inner">

                    <div class="page-header">

                        <h4 class="page-title">VENDER ACC ADD </h4>



                    </div>

                    <div class="row">

                        <div class="col-md-12">

                            <div class="card">

                                <div class="card-header">
                                  
                                </div>

                                <div class="card-body">

                                <?php


 $ms="SELECT * FROM `customer_master` where Customer_Phone_No LIKE '%".$_GET['c_phone']."%'";


$msql=mysqli_query($config,$ms);


$msqld=mysqli_fetch_object($msql);?>



                                <form id='idForm' method="GET" action="packagepaysuccess.php" target="_parent" >
      <div class="form-group">



<label for="exampleInputName1">Company Name</label>



<input required type="text" class="form-control" id="com_name" name="c_name" >


<span style="color: red;" id="c_name_error"></span>
</div>
<div class="form-group">



<label for="exampleInputName1">GST</label>



<input  onKeyPress="if(this.value.length==15) return false;"  type="text" class="form-control" id="exampleInputName1" name="gst" >

<input  type="hidden" class="form-control" id="exampleInputName1" name="rid" value="<?php echo  $_GET['rid'] ?>">



</div>
      
      
      <div class="form-group">



<label for="exampleInputName1">Full Name</label>



<input readonly type="text" class="form-control" id="exampleInputName1" name="customername" value="<?php echo $msqld->Customer_Name;?>">



</div>



<div class="form-group">



<label for="exampleInputNumber1">Mobile Number</label>



<input readonly type="number"  onKeyPress="if(this.value.length==10) return false;" class="form-control" id="exampleInputNumber1" name="customerphone" value="<?php echo $msqld->Customer_Phone_No;?>">



</div>



<div class="form-group">



<label for="exampleInputEmail1">Email</label>



<input readonly type="email" class="form-control" id="exampleInputEmail1" name="customermail" value="<?php echo $msqld->Customer_Mail_id;?>">

<input  type="hidden" class="form-control" id="exampleInputEmail1" name="packid" value="<?php echo $_GET['pid'];?>">
<input  type="hidden" class="form-control" id="" name="sessionid" value="<?php echo $msqld->Customer_Id;?>" >


</div>

<div class="form-group">
<label for="exampleInputEmail1">City</label>
<?php

   $sql4="SELECT * FROM `biding_city_master`  ";
$main_cate4=mysqli_query($config,$sql4);
?>
<select id='city' name="city" class="form-select form-control"  aria-label="Default select example">
<option selected>Select </option>
 <?php
while($macate4=mysqli_fetch_object($main_cate4))

{

?>
  <option value="<?php echo $macate4->city_id ?>"><?php echo $macate4->city_name?></option>
<?php }?>
</select>
</div>
<?php

   $sq5="SELECT * FROM `biding_package` where packid='".$_GET['pid']."' ";
$maincate5=mysqli_query($config,$sq5);
$noofkey=mysqli_fetch_object($maincate5);
?>
<div class="form-group">
<label for="exampleInputEmail1">Area </label><small style="margin-left: 3%;"><b>You can select upto <?php echo $noofkey->noofarea ?> Area only</b></small>
<div id="area">

</div>
<span style="color: red;" id="sarea"></span>
</div>
<div class="form-group" id="addonarea">
<label for="exampleInputEmail1">Add On Area</label>
<div id="area2_">

</div>
</div>
<button id="addarea" onclick="addareas();" style="float: right;" type="button" class="btn mb-2 btn-warning btn-sm"><i class="fa fa-plus"></i> Add More Area Rs.<?php echo $noofkey->addonarea_amount ?></button><br>


<input  type="hidden" class="form-control" id="" name="total_member" value="<?php echo $noofkey->total_member ?>" >

<input  type="hidden" class="form-control" id="nofokey" name="nofokey" value="<?php echo $noofkey->noofkey ?>" >
<input  type="hidden" class="form-control" id="nofoarea" name="nofoarea" value="<?php echo $noofkey->noofarea ?>" >
<input  type="hidden" class="form-control" id="nofokeyamount" name="nofokeyamount" value="<?php echo $noofkey->addonkey_amount ?>" >
<input  type="hidden" class="form-control" id="nofoareaamount" name="nofoareaamount" value="<?php echo $noofkey->addonarea_amount	 ?>" >
<br>
<div class="form-group">
<label for="exampleInputEmail1">Keyword</label><small style="margin-left: 3%;"><b>You can select upto <?php echo $noofkey->noofkey ?> Keys only</b></small><br>
<?php

   $sql5="SELECT * FROM `biding_post` order by keyword ASC ";
$main_cate5=mysqli_query($config,$sql5);
?>
<select required class="form-select form-control keywords" id='key' multiple aria-label="multiple select example" name="key[]" >
<?php
while($macate5=mysqli_fetch_object($main_cate5))

{

?>
            <option value="<?php echo $macate5->post_id?>"><?php echo $macate5->keyword?></option>
         <?php }?>
        </select>
        <span id="skey" style="color:red"></span>
</div>
<button id="addkey" onclick="addkeys();" style="float: right;" type="button" class="btn mb-2 btn-warning btn-sm"><i class="fa fa-plus"></i> Add More keys Rs.<?php echo $noofkey->addonkey_amount ?></button><br>
<div class="form-group" id="addonkey">
<label for="exampleInputEmail1">Add On Keyword</label><br>
<div id="ckey">
<?php

   $sql5="SELECT * FROM `biding_post` order by keyword ASC ";
$main_cate5=mysqli_query($config,$sql5);
?>
<select class="form-select form-control  keywords" id='key1' onchange="getval(this);"  multiple aria-label="multiple select example" name="key[]">
<?php
while($macate5=mysqli_fetch_object($main_cate5))

{

?>
            <option value="<?php echo $macate5->post_id?>"><?php echo $macate5->keyword?></option>
         <?php }?>
        </select>
</div>
</div>
<div class="form-group">
    <div id="result"></div>
</div>

  <div class="form-check">
  <input  type="hidden" class="form-control" id="total" name="total" value="<?php echo $noofkey->amount ?>" >

  <input  type="hidden" class="form-control" id="totalpay" name="totalpay" value="<?php echo $noofkey->amount ?>" >
   
  <button disabled  id="sub" type="submit" class="btn btn-outline-success" style="width: 100%;">Pay <span id="pay">Rs.<?php echo $noofkey->amount ?></span></button>

  </div>
</form>

                                </div>


                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Modal -->

  












   

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
<style>
#addonarea{
    display: none;
}
#addonkey{
    display: none;
}
</style>
    <script>
    $(document).ready(function() {

        $('#basic-datatables').DataTable({

        });









    });
    </script>

</body>

</html>

<script>
function check_vender(ph) {
    $.ajax({
        type: "POST",
        url: 'check_vender.php',
        data: {
            ph: ph
        }, // serializes the form's elements.
        success: function(data) {
            console.log(data);
            if (data == 1) {
                $('#error_c').html('Already exists Vender Acc');
            } else {
                $('#error_c').html('');
            }
        }
    });
}
</script>


<style>
.keys {
    border: 1px solid rgb(4, 170, 109);
    padding: 2%;
    margin: 1%;
    background: rgb(4, 170, 109);
    border-radius: 23px;
    color: white;
    font-weight: 700;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script>
      
function addkeys(){
    $('#addonkey').css('display', 'block');
    $('#addkey').css('display', 'none');

}
function addareas(){
    $('#addonarea').css('display', 'block');
    $('#addarea').css('display', 'none');

}
$(document).ready(function(){

    $('#key').on('change', function() {
        var key= $("#nofokey").val();
        var c=$("#key :selected").length;
        var cheackkey=$('#key').val();
        // var c=c-1;
        // console.log(c);
        if (key >= c)
        {
         $('#skey').html('');
         $('#sub').removeAttr('disabled');
        }
        else {
        // $(".key").removeAttr("checked");
        $(this).removeAttr("selected");
        // alert('You can select upto '+key+' options only');
        $('#skey').html('You can select upto '+key+' keys only')
        $('#sub').attr('disabled','disabled');
    }
    $.ajax({
    type: "POST",
    url: "checkkey.php",
    data:{cheackkey : cheackkey,}, // serializes the form's elements.
    success: function(data)
    {
       $('#ckey').html(data);
    //    alert(data);
    }
});
});


  $("#more").click(function(){

      $(".teaser").attr("style", "display: none;");


      $(".complete").attr("style", "display: block;");


      $("#more").attr("style", "display: none;");


      });

});


</script>
<script>
    
$(document).ready(function(){

$('#area').on('change', function() {
    var key= $("#nofoarea").val();
    var c=$("#area select option:checked").length;
    var cheackarea=$('#area1').val();
    var city=$('#city').val();
    // var c=c-1;
    // console.log(city);
    //   console.log(cheackarea);
    if (key >= c)
    {
     $('#sarea').html(' ');
     $('#sub').removeAttr('disabled');
    }
    else {
    // $(".key").removeAttr("checked");
    $(this).removeAttr("selected");
    // alert('You can select upto '+key+' options only');
    $('#sarea').html('You can select upto '+key+' Area only')
    $('#sub').attr('disabled','disabled');
  }
  $.ajax({
    type: "POST",
    url: "checkarea.php",
    data:{cheackarea : cheackarea,city:city}, // serializes the form's elements.
    success: function(data)
    {
       $('#area2').html(data);
    //    alert(data);
    }
});

});
});
</script>
<script>
  $('#city').on('change', function() {
    var id =this.value;
    $("#sub").removeAttr("disabled");
  $.ajax({
    type: "POST",
    url: "cityajax.php",
    data:{id : id}, // serializes the form's elements.
    success: function(data)
    {
     $('#area').html(data);
    //  $('#area2').html(data);
    $.ajax({
    type: "POST",
    url: "cityajax1.php",
    data:{id : id}, // serializes the form's elements.
    success: function(data)
    {
    //  $('#area').html(data);
     $('#area2_').html(data);
    }
});
    }
});
});
</script>




    <script type="text/javascript">
    $(function(){
        $('#people').multiSelect();
        $('#ice-cream').multiSelect();
        $('#line-wrap-example').multiSelect({
            positionMenuWithin: $('.position-menu-within')
        });
        $('#categories').multiSelect({
            noneText: 'All categories',
            presets: [
                {
                    name: 'All categories',
                    all: true
                },
                {
                    name: 'My categories',
                    options: ['a', 'c']
                }
            ]
        });
        $('#modal-example').multiSelect({
            'modalHTML': '<div class="multi-select-modal">'
        });
    });
    </script>






<script>
    
$(document).ready(function(){

$('.keywords').on('change', function() {
    var area1= $("#area1").val();
    var area2= $("#area2").val();
    var key= $("#key").val();
    var key2= $("#key2").val();
var msg='';
    var form = '#idForm';
    $.ajax({
    type: "POST",
    // dataType: 'json',
    url: "keywordscheck.php",
    data: $('#idForm').serialize(), 
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
    function getval(sel)
{
    // alert(sel.value);
        var key=$("#key1 :selected").length;
     var area2=$("#area2 :selected").length;
      

      var amount=$('#nofokeyamount').val();
   var keyamount = (key * amount);
   var amountarea=$('#nofoareaamount').val();
   var areaamount = (area2 * amountarea);

  var pay=$('#total').val();
//     var total = (c*amount);
     var gt=(parseInt(pay)+parseInt(keyamount)+parseInt(areaamount));
      
    $('#totalpay').val(gt);
    $('#pay').html(gt);

}

    $('.final').on('change', function() {
      
    //   var key=$("#key1 :selected").length;
      var area2=$("#area1 :selected").length;
      console.log(key);
      console.log(area2);
    //   var amount=$('#nofokeyamount').val();
    //   var pay=$('#total').val();
    //   var total = (c*amount);
    //   var gt=(parseInt(pay)+parseInt(total));
      
    //   $('#totalpay').val(gt);
      
  });
</script>
<script>
$(document).ready(function(){
  $("#com_name").change(function(){
    var tx=$('#com_name').val();
  
    
    var alphanumers = /^[a-zA-Z / /]+$/;
if(!alphanumers.test($("#com_name").val())){
    $('#c_name_error').html('Please avoid special characters in your Company  name')
}else{
    $('#c_name_error').html('');
}
  });
});
</script>
