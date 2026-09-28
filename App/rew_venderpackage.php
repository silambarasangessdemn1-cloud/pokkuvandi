<?php include('config/setup.php');?>


 <?php include('session.php');


 


	?>


<?php


 $ms="SELECT * FROM `membership_list` where user_id='$session_id'";


 $msql=mysqli_query($config,$ms);


 $msqld=mysqli_fetch_object($msql);


if($msqld->user_id)


{


  


   // header("location:membershipdetails.php");


   // die;


}


?>


<!DOCTYPE html>


<html lang="en">


   <head>


      <meta charset="utf-8">


      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


      <meta name="description" content="">


      <meta name="author" content="">


      <link rel="icon" type="image/png" href="<?php 


            


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


            


            ?>">


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


            


            ?></title>


<?php



				 



$about=mysqli_query($config,"select * from biding_script");







$del=mysqli_fetch_object($about);







?>         

<meta name="twitter:card" content="summary" />



<meta name="twitter:site" content="https://callinfo.in/App/venderpackage.php" />

<meta name="twitter:creator" content="callinfo" />

<meta property="og:image" content="https://callinfo.in/<?php  echo  $new_str = str_replace('../','', $ms);

 ?>" />			

<meta property="og:title" content="<?php echo $del->Title;

   ?>"/> 

    <meta name="author" content="<?php  

     echo $del->scrTitleipt;

       ?>">

             <meta property="og:url" content="https://<?php echo $_SERVER['SERVER_NAME'] ?>/App/venderpackage.php" />



<meta property="og:type" content="website" />

<meta property="og:description" content="<?php echo $del->Title;  ?>"/>

 <meta name="description" content="<?php echo $del->Title;  ?>">
      <!-- Slick Slider -->


      <link rel="stylesheet" type="text/css" href="vendor/slick/slick.min.css"/>


      <link rel="stylesheet" type="text/css" href="vendor/slick/slick-theme.min.css"/>


      <!-- Icofont Icon-->


      <link href="vendor/icons/icofont.min.css" rel="stylesheet" type="text/css">


      <!-- Bootstrap core CSS -->


      <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


      <!-- Custom styles for this template -->


      <link href="css/style.css" rel="stylesheet">


      <!-- Sidebar CSS -->


      <link href="vendor/sidebar/demo.css" rel="stylesheet">


   </head>


   <body>


      <div class="theme-switch-wrapper">


         <label class="theme-switch" for="checkbox">


            <input type="checkbox" id="checkbox" />


            <div class="slider round"></div>


            <i class="icofont-moon"></i>


         </label>


         <em>Enable Dark Mode!</em>


      </div>


      <div class="osahan-help">


         <div class="p-3 border-bottom bg-white">


            <div class="d-flex align-items-center">


               <a class="font-weight-bold text-success text-decoration-none" href="Bidding.php">


               <i class="icofont-rounded-left back-page"></i></a>


               <h6 class="font-weight-bold m-0 ml-3">Vendor Package</h6>


               <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>


            </div>


         </div>


      </div>


      <?php


		if($session_id){

        } else{
            header( 'Location: signin.php' );
            die;
        }


				


                 ?>

<link rel="stylesheet" type="text/css" href="src/example-styles.css">
    <link rel="stylesheet" type="text/css" href="demo-styles.css">
  
      <div class="container mt-4" style="margin-bottom: 76%;">
      <form id='idForm' method="GET" action="rew_packagepay.php" target="_parent" >
      <div class="form-group">

<?php 



   $sq5v="SELECT * FROM `biding_vender` where vender_id='".$_GET['vid']."' ";
$maincate5v=mysqli_query($config,$sq5v);
$noofkeyv=mysqli_fetch_object($maincate5v);

?>

<label for="exampleInputName1">Company Name</label>



<input required type="text" value="<?php echo $noofkeyv->c_name ?>" class="form-control" id="exampleInputName1" name="c_name" >



</div>
<div class="form-group">



<label for="exampleInputName1">GST</label>



<input  type="number" class="form-control" value="<?php echo $noofkeyv->GST ?>" id="exampleInputName1" name="gst" >

<input  type="text" class="form-control" id="exampleInputName1" name="vid" value="<?php echo  $_GET['vid'] ?>">



</div>
      
      
      <div class="form-group">



<label for="exampleInputName1">Full Name</label>



<input readonly type="text" class="form-control" id="exampleInputName1" name="customername" value="<?php echo $session__username;?>">



</div>



<div class="form-group">



<label for="exampleInputNumber1">Mobile Number</label>



<input readonly type="number" class="form-control" id="exampleInputNumber1" name="customerphone" value="<?php echo $session__phone; ?>">



</div>



<div class="form-group">



<label for="exampleInputEmail1">Email</label>



<input readonly type="email" class="form-control" id="exampleInputEmail1" name="customermail" value="<?php echo $session__mail;?>">

<input  type="text" class="form-control" id="exampleInputEmail1" name="packid" value="<?php echo $_GET['pid'];?>">
<input  type="hidden" class="form-control" id="" name="sessionid" value="<?php echo $session_id ?>" >


</div>

<div class="form-group">
<label for="exampleInputEmail1">City</label>
<?php

   $sql4="SELECT * FROM `biding_city_master`  ";
$main_cate4=mysqli_query($config,$sql4);
?>
<select id='city' name="city" class="form-select form-control"  aria-label="Default select example">
<option selected> select </option>
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
<div id="area2">

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
     $('#area2').html(data);
    }
});
    }
});
});
</script>
      <style>


    .complete{


    display:none;


}


.boxs


   {


    box-shadow: 0 3px 10px rgb(0 0 0 / 20%);


    padding: 15px;


}


}


.more{


    background:lightblue;


    color:navy;


    font-size:13px;


    padding:3px;


    cursor:pointer;


}


body {


    font-family: 'Ubuntu', sans-serif;


    font-size: 13px;


    background-color:white;


}


iframe{


   width:100%;


   height: 300px;


}
#addonkey{
   display:none; 
}
#addonarea{
    display: none;
}


</style>


         <?php include('promo_footermenu.php');?>


      <?php include('menu.php')?> 


    


      <!-- Bootstrap core JavaScript -->


      <script src="vendor/jquery/jquery.min.js"></script>


      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


      <!-- slick Slider JS-->


      <script type="text/javascript" src="vendor/slick/slick.min.js"></script>


      <!-- Sidebar JS-->


      <script type="text/javascript" src="vendor/sidebar/hc-offcanvas-nav.js"></script>


      <!-- Custom scripts for all pages-->


      <script src="js/osahan.js"></script>


   </body>


</html>





<script type="text/javascript" src="src/jquery-2.2.4.min.js"></script>
    <script type="text/javascript" src="src/jquery.multi-select.js"></script>
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


<style>
    body {
    font-family: sans-serif;
    font-size: 16px;
    line-height: 1.4;
    padding: 0 !important;
}
.multi-select-button {
    display: inline-block;
    font-size: 0.875em;
    padding: 0.2em 68px !important;
    max-width: 16em;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    vertical-align: -0.5em;
    background-color: #fff;
    border-bottom: 1px solid #aaa !important;
    border-radius: 4px;
    box-shadow: 0 0px 0px rgb(0 0 0 / 20%) !important;
    cursor: default;
    border: none;
    margin-left: 12%;
}
</style>




<script>
    
$(document).ready(function(){

$('.keywords').on('change', function() {
    var area1= $("#area1").val();
    var area2= $("#area2").val();
    var key= $("#key").val();
    var key2= $("#key1").val();
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
    // $('#area2').on('change', function() {
      
    //     var c=$("#area2 :selected").length;
    //     console.log(c);
    //     var amount=$('#nofoareaamount').val();
    //     var pay=$('#total').val();
    //     var total = (c*amount);
    //     var gt=(parseInt(pay)+parseInt(total));
    //     $('#totalpay').val(gt);
        
    // });
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