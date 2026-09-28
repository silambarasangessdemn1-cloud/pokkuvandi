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

                <a class="font-weight-bold text-success text-decoration-none" href="bidingview.php">

                    <i class="icofont-rounded-left back-page"></i></a>

                <h6 class="font-weight-bold m-0 ml-3">Bidding Details </h6>

                <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>

            </div>

        </div>

    </div>

    <div class="p-3" style="margin-bottom: 33%;">
<div id="result"></div>

        <p class="text-muted"> <?php


                $about=mysqli_query($config,"SELECT * FROM `biding_enq_pay` WHERE ve_id='".$_GET['vender_id']."' and biding_enq='".$_GET['enq_id']."' ");

                

                $del=mysqli_fetch_object($about);

                ?>
                <div class="msg">
                    <?php if($del->b_amount)
                    {
                   $b="SELECT min(b_amount) as amount ,min(b_amount2) as amount2 FROM `biding_enq_pay` WHERE  biding_enq='".$_GET['enq_id']."'  ";
                $about1=mysqli_query($config,$b);

                $del->b_amount;
             

                $del1=mysqli_fetch_object($about1);
                  $del1->amount;
                if($del->b_amount <= $del1->amount and $del->b_amount2 <=$del1->amount2 )
                {

                }else{
     ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>lowest Amount In Bidding  Another!</strong> 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div><?php }
}?>
                </div>
<div >
<?php 
 $nmh="SELECT * FROM `biding_enq` INNER JOIN customer_master ON biding_enq.custom_id=customer_master.Customer_Id where biding_en_id='".$_GET['enq_id']."' ";
 $user=mysqli_query($config,$nmh);
$user_del=mysqli_fetch_object($user);


?>
<p style="font-size: 17px;"> <i class='fa fa-user'></i> <?php echo $user_del->Customer_Name  ?>  <span style="float: right;"><i class='fa fa-phone'></i><a href="tel:<?php echo $user_del->Customer_Phone_No  ?>"> <?php echo $user_del->Customer_Phone_No  ?></a></span> </p>
<hr>
</div>
                <div id="c">

                </div>
<div class='ti'>
<?php if($del->order_id == 2){
    echo '<center><img src="cancel.png" style="width:80px;"></center><br>';
  echo '<div class="alert alert-danger" role="alert">
  The Ticket Was Appointmented To Another
</div>';  
}elseif($del->order_id == 1){ 
     $sql2="SELECT * FROM `biding_enq_pay` WHERE ve_id='".$_GET['vender_id']."' and biding_enq='".$_GET['enq_id']."' and selecid='".$_GET['vender_id']."' ";
$about=mysqli_query($config,$sql2);
$coun=mysqli_fetch_object($about);

if($coun->count_biding)
{
   

echo '



<div class="message-orange">
<h5 style="color: red;|" class="message-content">Rs.'.$coun->b_amount.'</h5>
<p class="message-content">'.$coun->b_desc.'</p><br>
<div class="message-timestamp-right">'.$coun->updated_msg.'</div>
</div>';
if($coun->b_desc2)
{
echo '



<div class="message-orange">
<h5 style="color: red;|" class="message-content">Rs.'.$coun->b_amount2.'</h5>
<p class="message-content">'.$coun->b_desc2.'</p><br>
<div class="message-timestamp-right">'.$coun->updated_msg.'</div>
</div>';
}

// echo  $data1;
}

?>

  <?php 
    $sql1="SELECT * FROM `biding_enq` INNER JOIN biding_enq_pay ON biding_enq.biding_en_id=biding_enq_pay.biding_enq where biding_enq='".$_GET['enq_id']."' and ve_id='".$_GET['vender_id']."' ";
    $details=mysqli_query($config,$sql1);
    $coun3=mysqli_fetch_object($details);
    
    $sql1="SELECT * FROM `customer_master` where Customer_Id='$coun3->custom_id' ";
    $details=mysqli_query($config,$sql1);
    $coun=mysqli_fetch_object($details);
    $sql2b="SELECT * FROM `biding_enq` INNER JOIN biding_city_master ON biding_city_master.city_id=biding_enq.cityid INNER JOIN biding_area_master ON biding_enq.areaid=biding_area_master.area_id
   where biding_en_id='".$_GET['enq_id']."'";
    $aboutb=mysqli_query($config,$sql2b);
    $counb=mysqli_fetch_object($aboutb);
$title=$_GET['title'];
    $data .= '<div class="card">
    <div class="card-body">
    <center><img src="man.png" style="width:80px"></center><br>
    <h4 style="color:red;"> '.$title.'</h4>
      <p><b>NAME</b>  <span style="font-size:13px;">'.$coun->Customer_Name.'</span></p>
      <p><b>NUMBER</b>  <span style="font-size:13px;">'.$coun->Customer_Phone_No.'</span></p>
      <p><b>EMAIL</b>  <span style="font-size:13px;">'.$coun->Customer_Mail_id.'</span></p>
      <p><b>CITY</b>  <span style="font-size:13px;">'.$counb->city_name.'</span></p>
      <p><b>AREA</b> <span style="font-size:13px;">'.$counb->area_name.'</span></p>
    </div>
    </div>';
    
    echo $data;
        

 }elseif($del->order_id == 0){?>
</div>
       
                <input type="hidden" name="" class="form-control" id="enq_id1" aria-describedby="emailHelp" value="<?php echo $_GET['enq_id']?>">
  <input type="hidden" name="" class="form-control" id="vender_id1" aria-describedby="emailHelp" value="<?php echo $_GET['vender_id']?>">

<?php if($del->count_biding < 2) {?>
        <div class="card send" style="width: 100%;position: fixed;
    margin-top: 1%;">
            <div class="card-body">
            <form  action="biding_detail_biding.php" method="POST">
  <div class="form-group">
  <input type="hidden" name="enq_id" class="form-control" id="enq_id" aria-describedby="emailHelp" value="<?php echo $_GET['enq_id']?>">
  <input type="hidden" name="vender_id" class="form-control" id="vender_id" aria-describedby="emailHelp" value="<?php echo $_GET['vender_id']?>">

    <input type="number" name="amount" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Amount">
  </div>
  <div class="form-group">

    <textarea required name="desc" class="form-control" id="exampleInputPassword1" placeholder="Short description"></textarea>
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
                    
            </div>
        </div>
<?php }

}?>

       


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
    width: 80%;
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
        window.location.href = "bidingview.php";  
        
     }else
     {
        $('#idForm')[0].reset();
        $('.send').css("display","none");
        window.location.href = "bidingview.php";  
     }
    }
});

});
</script>

<script>
       $(document).ready(function(){
        var vender_id=$('#vender_id1').val();
           var enq_id=$('#enq_id1').val();
          
           $.ajax({
               
            url:"biding_get.php",
            type: 'POST',
            data: {vender_id :vender_id ,enq_id :enq_id},
            success: function(data){
                // alert(data);
              $('#c').html(data);
            }
           });
       });
    </script>