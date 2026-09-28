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


               <h6 class="font-weight-bold m-0 ml-3">Vender History</h6>


               <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>


            </div>


         </div>


      </div>
      <?php


				 


				
$sql5="SELECT * FROM `biding_vender` where cust_id='$session_id'  ";
$maincate5=mysqli_query($config,$sql5);

$macate5=mysqli_fetch_object($maincate5);
$sql8="SELECT * FROM `biding_package` where packid='$macate5->vender_package'  ";
$maincate8=mysqli_query($config,$sql8);

$macate8=mysqli_fetch_object($maincate8);

                ?>
      <div class="card">
  <div class="card-body row">
    <div class="col-3"><img style="width: 64px;" src="timetable.png"></div>

    <div class="col-9"> <h5 style="color:red;">Expiry date : <?php echo  $macate5->ex_date?> </h5>
    <h6 style="color:green;">Payment Id  : <b><?php echo  $macate5->pay_id?></b> </h6>
    <span style="color:green;">Package Plan : <b><?php echo  $macate8->title?></b> </span>
</div>
  </div>
</div>

<hr>
     

<link rel="stylesheet" type="text/css" href="src/example-styles.css">
    <link rel="stylesheet" type="text/css" href="demo-styles.css">
  
      <div class="container mt-4" style="margin-bottom: 36%;">


<hr>

    <?php 
    $sql7="SELECT * FROM `vender_keyword` INNER JOIN biding_area_master ON vender_keyword.vender_area1=biding_area_master.area_id

   where venderid='$macate5->vender_id'  GROUP BY (vender_area1) ";
    $mainarea=mysqli_query($config,$sql7);
    while($b_area=mysqli_fetch_object($mainarea))
    { ?>

    <h5 style='color:red;'><b>
Your Services Area <span style="color: green;">(<?php echo $b_area->area_name?>)</span></b>

</h5><br>
<h6><b>Services Keys :</b></h6><hr>
<div class="card">
  <div class="card-body">
<div class='row'>
<?php 
    $sql9="SELECT * FROM `vender_keyword` INNER JOIN biding_post ON biding_post.post_id=vender_keyword.vender_key where venderid='$macate5->vender_id' and vender_area1='$b_area->vender_area1'  ";
    $maina=mysqli_query($config,$sql9);
    while($barea=mysqli_fetch_object($maina))
    { ?>

  <span class="keys"><?php echo $barea->keyword?></span>

<?php }?>
</div>
</div>

</div>
     
    <?php }?>




      <form id='idForm' method="POST" action="addkeypay.php" target="_parent" >
         <div class="form-group">







<input readonly type="hidden" class="form-control" id="exampleInputName1" name="customername" value="<?php echo $session__username;?>">



</div>



<div class="form-group">






<input readonly type="hidden" class="form-control" id="exampleInputNumber1" name="customerphone" value="<?php echo $session__phone; ?>">



</div>



<div class="form-group">





<?php
 

   $sql4="SELECT * FROM `biding_area_master` where  cityid='$macate5->vender_city'  ";
$main_cate4=mysqli_query($config,$sql4);
?>

<input readonly type="hidden" class="form-control" id="exampleInputEmail1" name="customermail" value="<?php echo $session__mail;?>">
<input  type="hidden" class="form-control" id="exampleInputEmail1" name="vid" value="<?php echo  $macate5->vender_id?>">

<input  type="hidden" class="form-control" id="exampleInputEmail1" name="packid" value="<?php echo  $macate5->vender_package?>">
<input  type="hidden" class="form-control" id="" name="sessionid" value="<?php echo $session_id ?>" >


</div>

<div class="form-group">
<label for="exampleInputEmail1">Area</label>

<select  id="area1" name="area[]" class="form-select form-control keywords" multiple  aria-label="Default select example" required>

 <?php
while($macate4=mysqli_fetch_object($main_cate4))

{

?>
  <option value="<?php echo $macate4->area_id ?>"><?php echo $macate4->area_name?></option>
<?php }?>
</select>
</div>


<?php

   $sq5="SELECT * FROM `biding_package` where packid='".$macate5->vender_package."' ";
$maincate5=mysqli_query($config,$sq5);
$noofkey=mysqli_fetch_object($maincate5);
?>
<input  type="hidden" class="form-control" id="" name="total_member" value="<?php echo $noofkey->total_member ?>" >

<input  type="hidden" class="form-control" id="nofokey" name="nofokey" value="<?php echo $noofkey->noofkey ?>" >
<input  type="hidden" class="form-control" id="nofoarea" name="nofoarea" value="<?php echo $noofkey->noofarea ?>" >
<input  type="hidden" class="form-control" id="nofokeyamount" name="nofokeyamount" value="<?php echo $noofkey->addonkey_amount ?>" >
<input  type="hidden" class="form-control" id="nofoareaamount" name="nofoareaamount" value="<?php echo $noofkey->addonarea_amount	 ?>" >

<input  type="hidden" class="form-control" id="keys" name="keyamount" value="" >

<div class="form-group" >
<label for="exampleInputEmail1">Add On Keyword</label><br>
<?php

   $sql5="SELECT * FROM `biding_post` order by keyword ASC ";
$main_cate5=mysqli_query($config,$sql5);
?>
<select required class="form-select form-control  keywords" id='key' onchange="getval(this);"  multiple aria-label="multiple select example" name="key[]">
<?php
while($macate5=mysqli_fetch_object($main_cate5))

{

?>
            <option value="<?php echo $macate5->post_id?>"><?php echo $macate5->keyword?></option>
         <?php }?>
        </select>

</div>
<div class="form-group">
    <div id="result"></div>
</div>

  <div class="form-check">
  <input  type="hidden" class="form-control" id="total" name="total" value="<?php echo $noofkey->amount ?>" >

  <input  type="hidden" class="form-control" id="totalpay" name="totalpay" value="<?php echo $noofkey->amount ?>" >
   
  <button id="sub" type="submit" class="btn btn-outline-success" style="width: 100%;"><span id="totalamount">Submit</span></button>

  </div>
</form>
<a href="vender_add_key.php" style="margin-top: 6%;
    width: 100%;" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Add More Area & Keys</a>
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
// $(document).ready(function(){

//     $('#key').on('change', function() {
//         var key= $("#nofokey").val();
//         var c=$("#key :selected").length;
//         // var c=c-1;
//         // console.log(c);
//         if (key >= c)
//         {
//          $('#skey').html('');
//          $('#sub').removeAttr('disabled');
//         }
//         else {
//         // $(".key").removeAttr("checked");
//         $(this).removeAttr("selected");
//         // alert('You can select upto '+key+' options only');
//         $('#skey').html('You can select upto '+key+' keys only')
//         $('#sub').attr('disabled','disabled');
//     }
// });


  $("#more").click(function(){

      $(".teaser").attr("style", "display: none;");


      $(".complete").attr("style", "display: block;");


      $("#more").attr("style", "display: none;");


      });

});


</script>
<!-- <script>
    
$(document).ready(function(){

$('#area').on('change', function() {
    var key= $("#nofoarea").val();
    var c=$("#area select option:checked").length;
    // var c=c-1;
    //  console.log(c);
    if (key >= c)
    {
     $('#sarea').html(' ');
     $('#sub').removeAttr('disabled');
    }
    else {
    // $(".key").removeAttr("checked");
    $(this).removeAttr("selected");
    // alert('You can select upto '+key+' options only');
    $('#sarea').html('You can select upto '+key+' keys only')
    $('#sub').attr('disabled','disabled');
  }
});
});
</script> -->
<script>
  $('#city').on('change', function() {
    var id =this.value;
 
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

<style>
    .keys{
        border: 1px solid rgb(4, 170, 109);
    padding: 2%;
    margin: 1%;
    background: rgb(4, 170, 109);
    border-radius: 23px;
    color: white;
    font-weight: 700;
    }
</style>



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
 
    var area=$("#area1 :selected").length;
    var areaamount=$("#nofoareaamount").val();
    var total= area * areaamount;
    console.log(total);
var msg='';

    var form = '#idForm';
    $.ajax({
    type: "POST",
    dataType: 'json',
    url: "addkeywordscheck.php",
    data: $('#idForm').serialize(), 
    success: function(data)
    {
        // alert(data);
        var t=parseInt(data[0])+parseInt(total);
        if(isNaN(t))
        {

        }else{
$('#totalamount').html('Rs.'+t);}
        // $('#result').html(data);
    //     if(data ==0)
    //     {
    //         $('#result').html('');
            
    //     }else{
    //         msg +='<div class="alert alert-danger" role="alert">'+data+' <a href="vendor.php" class="alert-link">Keyword available in other package</a></div>';
    //  $('#result').html(msg);
    // }
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

<style>
    #idForm{
        display: none;
    }
</style>