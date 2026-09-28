
<?php include('config/setup.php');?>

<?php include('session.php');



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

    <link rel="stylesheet" type="text/css" href="vendor/slick/slick.min.css" />

    <link rel="stylesheet" type="text/css" href="vendor/slick/slick-theme.min.css" />

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

                <a class="font-weight-bold text-success text-decoration-none" href="bid_list.php">

                    <i class="icofont-rounded-left back-page"></i></a>

                <h6 class="font-weight-bold m-0 ml-3">Ticket Details </h6>

                <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>

            </div>

        </div>

    </div>

    <div class="p-3" style="margin-bottom: 60%;">

      
            <div id="d"><?php

  $m="SELECT * FROM `biding_enq_pay` WHERE  biding_enq='".$_GET['biding_enq_pay_id']."' ";
                $about=mysqli_query($config,$m);

                

                while($coun=mysqli_fetch_object($about))
                {
                    $deta=mysqli_query($config,"SELECT * FROM `biding_vender` where vender_id='$coun->ve_id'");
                    $coun11b=mysqli_fetch_object($deta);
                 if($coun->selecid == 0)
                 { 
?>
<div class="card" style="margin-bottom: 2%;">
<p style="text-align: center;
    text-transform: capitalize;    text-align: center;
    text-transform: capitalize;
    font-size: 17px;
    color: #007bff;
    margin-top: 4%;
    font-weight: 700;"><?php echo $coun11b->c_name?></p>
<?php 
             $eid=$coun->biding_enq;
              
              if($coun->count_biding)
  {
      $tid=$coun->biding_enq;
     $sql1="SELECT * FROM `biding_enq_pay` INNER JOIN biding_vender ON biding_enq_pay.ve_id=biding_vender.vender_id where biding_enq='".$_GET['biding_enq_pay_id']."' ";
    $details=mysqli_query($config,$sql1);
    $coun11=mysqli_fetch_object($details);
    
    $sql1="SELECT * FROM `customer_master` where Customer_Id='$coun11->cust_id' ";
    $details=mysqli_query($config,$sql1);
    $coun22=mysqli_fetch_object($details);
    ?>

 
  
  <div class="message-orange mt-2">
  <h5 style="color: red;|" class="message-content">Rs.<?php echo $coun->b_amount?></h5>
  <p class="message-content"><?php echo $coun->b_desc?></p><br>
  <div class="message-timestamp-right"><?php 
   $date = $coun->updated_msg; 
   echo date(' d/m/Y h:i: a', strtotime($date));?></div>
</div>
<?php if($coun->b_desc2)
{
?>

 
  
  <div class="message-orange">
  <h5 style="color: red;|" class="message-content">Rs.<?php echo $coun->b_amount2?>'</h5>
  <p class="message-content"><?php echo $coun->b_desc2 ?></p><br>
  <div class="message-timestamp-right"><?php  $date = $coun->updated_msg; 
   echo date(' d/m/Y h:i: a', strtotime($date));?></div>
</div>




             
<?php }
?>
<button onclick="tickrt(1,'<?php echo  $coun->biding_enq_pay_id;?>','<?php echo  $coun->biding_enq;?>','<?php echo  $coun->ve_id;?>');" style="margin-left: 13%;
    margin-right: 1%;" type="button" class="btn btn-success">Accepted</button>
    <?php
 }
 ?>


</div>      
 
 <?php
                 }


}

$tid=$_GET['biding_enq_pay_id'];?>
</div>
<div id="ticket">

    <?php 
     $about11=mysqli_query($config,"SELECT * FROM `biding_enq_pay` WHERE  biding_enq='".$_GET['biding_enq_pay_id']."' ");

                

$coun11=mysqli_fetch_object($about11);
    
    
    if($coun11->selecid == 0 ) 
    {?>
        <div class="card" style="margin-top: 2%;">
          <div class="card-body">
              <center><img src="ticket.png" style="width: 83px;
        "></center><br>
         <center><button onclick="tickrt(2,'2','<?php echo   $_GET['biding_enq_pay_id'];?>');" type="button" class="btn btn-danger">Ticket Close</button></center>
        
          </div>
        </div>
        
        <?php }else
    {

 $sql11="SELECT * FROM `biding_vender` where vender_id='$coun11->selecid' ";
$details1=mysqli_query($config,$sql11);
$coun1=mysqli_fetch_object($details1);

$sql1="SELECT * FROM `customer_master` where Customer_Id='$coun1->cust_id' ";
$details=mysqli_query($config,$sql1);
$counj=mysqli_fetch_object($details);
$sql2b="SELECT * FROM `biding_enq` INNER JOIN biding_city_master ON biding_city_master.city_id=biding_enq.cityid INNER JOIN biding_area_master ON biding_enq.areaid=biding_area_master.area_id
where biding_en_id='".$_GET['biding_enq_pay_id']."'";
 $aboutb=mysqli_query($config,$sql2b);
 $counb=mysqli_fetch_object($aboutb);

 $title=$_GET['title'];
 $sql2m="SELECT * FROM `biding_enq_pay` WHERE  biding_enq='".$_GET['biding_enq_pay_id']."'";

 $aboutm=mysqli_query($config,$sql2m);
 $counm=mysqli_fetch_object($aboutm);

 $sql2="SELECT * FROM `biding_enq_pay` WHERE  biding_enq='".$_GET['biding_enq_pay_id']."' and selecid='$counm->selecid' and ve_id='$counm->selecid' ";
 $about=mysqli_query($config,$sql2);
 $coun=mysqli_fetch_object($about);
 
 if($coun->count_biding)
 {
    $date = $coun->updated_msg; 
 $datetime =date(' d/m/Y h:i: a', strtotime($date)); 
 
 echo '
 
 
 
 <div class="message-orange">
 <h5 style="color: red;|" class="message-content">Rs.'.$coun->b_amount.'</h5>
 <p class="message-content">'.$coun->b_desc.'</p><br>
 <div class="message-timestamp-right"><b>'.$datetime.'</b></div>
 </div>';
 if($coun->b_desc2)
 {
    $date = $coun->updated_msg; 
    $datetime =date(' d/m/Y h:i: a', strtotime($date)); 
 echo '
 
 
 
 <div class="message-orange">
 <h5 style="color: red;|" class="message-content">Rs.'.$coun->b_amount2.'</h5>
 <p class="message-content">'.$coun->b_desc2.'</p><br>
 <div class="message-timestamp-right"><b>'.$datetime.'</b></div>
 </div>';
 }
 
 // echo  $data1;
 }
 



$data .= '<div class="card">
<div class="card-body">
<center><img src="man.png" style="width:80px"></center><br>
<h4 style="color:red;">'.$title.'</h4>
<h5>'.$coun1->c_name.'</h5>
  <p><b>NAME </b> <span style="font-size:13px;">'.$counj->Customer_Name.'</span></p>
  <p><b>NUMBER</b>  <span style="font-size:13px;">'.$counj->Customer_Phone_No.'</span></p>
  <p><b>EMAIL</b>  <span style="font-size:13px;">'.$counj->Customer_Mail_id.'</span></p>
  <p><b>CITY</b>  <span style="font-size:13px;">'.$counb->city_name.'</span></p>
  <p><B>AREA</b>  <span style="font-size:13px;">'.$counb->area_name.'</span></p>
</div>
</div>';

echo $data;
    




         }
         
        ?>
</div>
                </div>

       
            

       


    </div>

    <?php include('footermenu.php');?>

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
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400);


.message-blue {
    position: relative;
    margin-left: 20px;
    margin-bottom: 10px;
    padding: 10px;
    background-color: #A8DDFD;
    width: 200px;
    height: 100%;
    text-align: left;
    font: 400 .9em 'Open Sans', sans-serif;
    border: 1px solid #97C6E3;
    border-radius: 10px;
}

.message-orange {
    position: relative;
    margin-bottom: 10px;
    margin-left: calc(100% - 313px);
    padding: 10px;
    background-color: #f8e896;
    width:80%;
    height: 100%;
    text-align: left;
    font: 400 .9em 'Open Sans', sans-serif;
    border: 1px solid #dfd087;
    border-radius: 10px;
}

.message-content {
    padding: 0;
    margin: 0;
}

.message-timestamp-right {
    position: absolute;
    font-size: .85em;
    font-weight: 300;
    bottom: 5px;
    right: 5px;
}

.message-timestamp-left {
    position: absolute;
    font-size: .85em;
    font-weight: 300;
    bottom: 5px;
    left: 5px;
}

.message-blue:after {
    content: '';
    position: absolute;
    width: 0;
    height: 0;
    border-top: 15px solid #A8DDFD;
    border-left: 15px solid transparent;
    border-right: 15px solid transparent;
    top: 0;
    left: -15px;
}

.message-blue:before {
    content: '';
    position: absolute;
    width: 0;
    height: 0;
    border-top: 17px solid #97C6E3;
    border-left: 16px solid transparent;
    border-right: 16px solid transparent;
    top: -1px;
    left: -17px;
}

.message-orange:after {
    content: '';
    position: absolute;
    width: 0;
    height: 0;
    border-bottom: 15px solid #f8e896;
    border-left: 15px solid transparent;
    border-right: 15px solid transparent;
    bottom: 0;
    right: -15px;
}

.message-orange:before {
    content: '';
    position: absolute;
    width: 0;
    height: 0;
    border-bottom: 17px solid #dfd087;
    border-left: 16px solid transparent;
    border-right: 16px solid transparent;
    bottom: -1px;
    right: -17px;
}

</style>
<script>
  function  biding_pay(enq_id,vender,amount){
   console.log(enq_id);
   console.log(vender);
   var msg='';
    // window.location.href = "home.php";
    $.ajax({
        type: "POST",
        url: 'biding_pay.php',
        data: {enq_id :enq_id,vender:vender,amount:amount }, // serializes the form's elements.
        success: function(data)
        {
         if(data == 1)
         {
            window.location.href = "biding_details.php";  
         }elseif(data == 2)
         {
            window.location.href = "biding_details.php";  
         }
         elseif(data == 3)
         {
            msg +='<div class="alert alert-danger" role="alert">Please Top Up Your Vendor Wallet!</div>';
         $('#result').html(msg);
        }
        }
    });


    }
</script>


<script>
    $("#idForm").submit(function(e) {

e.preventDefault(); // avoid to execute the actual submit of the form.

var form = $(this);
var actionUrl = form.attr('action');

$.ajax({
    type: "POST",
    url: 'biding_detail_biding.php',
    data: form.serialize(), // serializes the form's elements.
    success: function(data)
    {
        // alert(data);
     if(data == 1)
     {
        $('#idForm')[0].reset();
        location.reload();
        
     }else
     {
        $('#idForm')[0].reset();
        $('.send').css("display","none");
        location.reload();
     }
    }
});

});

function tickrt(id,tid,eid,vid)
{


$.ajax({
    type: "POST",
    url: 'ticket_details.php',
    data: {id:id,tid:tid,eid:eid,vid:vid}, // serializes the form's elements.
    success: function(data)
    {
        // $('#ticket').html(data);
     if(data == 2)
     {
       
        $('#ticket').html('');
        window.location.href = "bid_list.php";
     }else
     {
        $('#d').html('');
        $('#ticket').html(data);
     }
    }
});
}
</script>

