<?php include('config/setup.php');?>


 <?php include('session.php');


 


	?>


<?php


 $ms="SELECT * FROM `membership_list` where cuser_id='$session_id'";


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


               <h6 class="font-weight-bold m-0 ml-3">Referral Downline</h6>


               <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>


            </div>


         </div>


      </div>


      <?php

$start=$_GET["start"];

$end=$_GET["end"];
$fromdate1=date('Y-m-d', strtotime($start));
$enddate1=date('Y-m-d', strtotime($end));

$fromdate=date('Y-m-d H:i:s', strtotime($start));
				 
$enddate=date('Y-m-d H:i:s', strtotime($end));

				


                 ?>

<link rel="stylesheet" type="text/css" href="src/example-styles.css">
    <link rel="stylesheet" type="text/css" href="demo-styles.css">
  
      <div class="container mt-4" style="">
      <form>
  <div class="row">
    <div class="col-4">
    <label for="exampleInputEmail1">From Date</label>
      <input type="date" name="start" class="form-control" value="<?php echo $_GET["start"] ?>" placeholder="First name">
    </div>
    <div class="col-4">
    <label for="exampleInputEmail1">End Date</label>

      <input type="date" name="end" class="form-control" value="<?php echo $_GET["end"]  ?>" placeholder="Last name">
    </div>
    <div class="col-4">
    <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
      </div>
<div style="margin-bottom: 10%;">
<?php
 if(isset($_GET['start'])){

$main_cate = mysqli_query($config, "SELECT * FROM `dir_vender` INNER JOIN dir_commistion ON dir_vender.dir_vender_id=dir_commistion.dir_down where (created_vender BETWEEN '$fromdate' AND '$enddate') and dir_com_cid='$session_id'");
 }else{
    $main_cate = mysqli_query($config, "SELECT * FROM `dir_vender` INNER JOIN dir_commistion ON dir_vender.dir_vender_id=dir_commistion.dir_down where dir_com_cid='$session_id'");
 
 }
                

                while($del=mysqli_fetch_object($main_cate))

                {?>

<div class="card" style="width: 100%;margin-top:2px;margin-bottom:2px;">
            <div class="card-body">
                <div class="row">
                <div class="col-3">
                        <img width="100px" src="img/dir_logo/<?php echo $del->c_logo ?>">
                    </div>
                    <div class="col-9">
                   
                          <h5 style="color: green;margin-bottom: 1px !important;"><?php echo $del->c_name?>   </h5>
                        <span style="color:black;font-size:17px;"> <?php echo $del->c_phone ?></span><br>
                        
                      
                        <span > <?php  $del->created_at_time;
                         $date = $del->created_vender; 
                        echo date(' d/m/Y h:i: a', strtotime($date));?></span><br>

                    </div>
                </div>
            </div>
</div>
                <?php }?>
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
</script>
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
    url: "addkeywordscheck.php",
    data: $('#idForm').serialize(), 
    success: function(data)
    {
        // $('#result').html(data);
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