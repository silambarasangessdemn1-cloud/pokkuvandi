<?php include('config/setup.php');?>

<?php include('session.php');



   ?>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>


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

                <a class="font-weight-bold text-success text-decoration-none" href="Bidding.php">

                    <i class="icofont-rounded-left back-page"></i></a>

                <h6 class="font-weight-bold m-0 ml-3">Services   Leads</h6>

                <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>

            </div>

        </div>

    </div>

    <div class="p-3" style="margin-bottom: 33%;">
<div id="result"></div>
<?php 
$det=mysqli_query($config,"SELECT * FROM `biding_vender` where  cust_id='$session_id'"); 
if (mysqli_num_rows($det) > 0) {

}else{


    header("Location: bid_list.php");
    echo "<script type='text/javascript'> document.location = 'bid_list.php'; </script>";
}
$vdet=mysqli_fetch_object($det);
// echo $vdet->ex_date;

 $exdate_1=date( "d-m-Y", strtotime( "$vdet->ex_date -7 day" ) );

 $date_now = date("d-m-Y");
$exdate_1 = date_create($exdate_1);
$date_now = date_create($date_now);
$date_diff = date_diff($date_now,$exdate_1);

if($date_now > $exdate_1 )
{
echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong><a href="renew_package.php?vid='.$vdet->vender_id.'">Your Plan has '.$vdet->ex_date.' exprired.Please update your plan .... <span style="color:red;">Click</span></a></strong> 
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>';
        }
else{
   
}

?>
<center><p>Payment Id : <?php  echo $vdet->pay_id?></p></center>
<center>

<?php
$detr=mysqli_query($config,"SELECT * FROM `biding_script`");  
$vdetr=mysqli_fetch_object($detr);


$share='https://callinfo.in/App/vendor_ref_.php?pid=1%26rid='.$session_id.'';

$share = str_replace(' ', '', $share);
?>
 <span>Share </span> :
<a href="https://api.whatsapp.com/send?text=<?php echo $vdetr->script;?>&nbsp;<?php echo$share; ?>  " data-action="share/whatsapp/share" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" class="font-weight-bold text-white text-decoration-none ml-2" target="_blank" title="Share on whatsapp"><i class="icofont-whatsapp p-2 bg-success shadow-sm rounded-circle"></i></a>

<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $vdetr->script; ?>&nbsp; <?php echo $share; ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" class="font-weight-bold text-white text-decoration-none ml-2" target="_blank" title="Share on Facebook"><i class="icofont-facebook p-2 bg-primary shadow-sm rounded-circle"></i></a>

<a href="https://twitter.com/share?url=<?php echo $vdetr->script; ?>&nbsp; <?php echo $share; ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" class="font-weight-bold text-white text-decoration-none ml-2" title="Share on Twitter"><i class="icofont-twitter p-2 bg-primary shadow-sm rounded-circle"></i></a>

<a href="mailto:?subject=Leefoodies&body=<?php echo $vdetr->script; ?>&nbsp; <?php echo $share; ?>" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Mail" class="font-weight-bold text-white text-decoration-none ml-2"><i class="icofont-email p-2 bg-danger shadow-sm rounded-circle"></i></a></center>
        


<p class="text-muted"> 
            
            
            <?php


  $w="SELECT * FROM `vemder_enq_list` INNER JOIN biding_enq ON vemder_enq_list.enq_id=biding_enq.biding_en_id INNER JOIN biding_post ON biding_post.post_id=biding_enq.mid
where venderlid='".$vdet->vender_id."' and status='new' order by (created_at) DESC ";
                $about=mysqli_query($config,$w);

                

                while($del=mysqli_fetch_object($about))

                {?>



        <div class="card" style="width: 100%;">
            <div class="card-body">
                <div class="row">

                <div class="col-10">
<div class="enq__label<?php echo $del->vender_list_id ?>">
<?php if($del->enq_set == 1){
  echo '<span class="badge badge-primary">Follow-up</span>';
  }elseif($del->enq_set == 2){
    echo '<span class="badge badge-success">Deal Completed</span>';
    }elseif($del->enq_set == 3){
      echo '<span class="badge badge-warning">Not Interested</span>';
      }elseif($del->enq_set == 4){
        echo '<span class="badge badge-info">Not Reached</span>';
        }?>

</div>

                </div>
                <div class="col-2"><div class="dropdown" style="float: right;position: absolute;
    margin-top: -52%;">
                  <div class="btn-group dropleft">
  <button style="font-size:20px" class="btn btn-white" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
    ...
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" onclick="enq_label('1','<?php echo $del->vender_list_id ?>')" href="javascript:void(0)">Follow-up</a>
    <a class="dropdown-item" onclick="enq_label('2','<?php echo $del->vender_list_id ?>')" href="javascript:void(0)">Deal Completed</a>
    <a class="dropdown-item" onclick="enq_label('3','<?php echo $del->vender_list_id ?>')" href="javascript:void(0)">Not Interested</a>
    <a class="dropdown-item" onclick="enq_label('4','<?php echo $del->vender_list_id ?>')" href="javascript:void(0)">Not Reached</a>
  </div>
</div>
</div>
                </div>
                    <div class="col-3">
                        <img src="img/keyword_icon/<?php echo $del->key_icon?>">
                    </div>
                    <div class="col-9">
              <?php       $abouti=mysqli_query($config,"SELECT * FROM `customer_master` where Customer_Id='$del->custom_id'");
$delm=mysqli_fetch_object($abouti);?>
<span style="color:#116ef5;font-size:17px;"> <?php echo $del->keyword ?></span>
<span style="color: red;">
<?php $inro_logon=mysqli_query($config,"SELECT * FROM `biding_city_master` INNER JOIN biding_area_master ON biding_city_master.city_id=biding_area_master.cityid WHERE city_id='$del->cityid' and area_id='$del->areaid'");

$delrvn=mysqli_fetch_object($inro_logon); 
?></span><br>
<span style="font-size: 14px;"><b><?php echo $delrvn->city_name?> <span style="color:red"> <?php echo $delrvn->area_name?></span></b></span><br>
<?php  $del->created_at_time;
                        $date = $del->created_at_time; 
                        echo date(' d/m/Y h:i: a', strtotime($date));
?>
<HR>
<span style="font-size: 16px;
    color: #ff6a00;" class="card-text"><?php 
                      $inrologo=mysqli_query($config,"SELECT * FROM `subkeyword` where subid='$del->subkey_id' ");
                      $delr=mysqli_fetch_object($inrologo);
                     echo $delr->subkeyword

                      ?></span><br>
                        <span style="color: black;">Enquired for <?php echo $del->description?></span><br>

                       <br> <b>User Info</b><br>
                        <span style="color: green;margin-bottom: 1px !important;"><?php echo $delm->Customer_Name?></span>
                        <?php if($del->price){?>
                     <br>   <span style="color: red;font-size: 16px;
   position: relative;" class="card-text"><b>Rs.<?php echo $del->price?></b>
                        <?php }?></span> 
                        </div>
      </div>
           
                   <?php $inro_logo=mysqli_query($config,"SELECT * FROM `biding_enq_pay` where ve_id='".$del->venderlid."' and biding_enq='".$del->enq_id."' ");

if (mysqli_num_rows($inro_logo) > 0) {
    $delrv=mysqli_fetch_object($inro_logo); 
    if($delrv->selecid == $vdet->vender_id )
    {?>
    <!-- <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>24 Hrs</strong> Will be closed automatically ticket
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div> -->
 



                        <a href="biding_details.php?enq_id=<?php echo $del->enq_id?>&vender_id=<?php echo $del->venderlid?>&title=<?php echo $del->keyword ?>"  style="float: right;" class="btn btn-primary mt-2">View Details</a>

 <?php   }else{
       if($delrv->selecid == 0)
       {?>
       <!-- <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>24 Hrs</strong> Will be closed automatically ticket
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div> -->
<!-- <?php if($del->price){?>
                        <span style="color: red;font-size: 16px;
   position: absolute;
   
   bottom: 6px;" class="card-text"><b>Rs.<?php echo $del->price?></b>
                        <?php }?></span> -->
                        
              
                        <a href="biding_details.php?enq_id=<?php echo $del->enq_id?>&vender_id=<?php echo $del->venderlid?>&title=<?php echo $del->keyword ?>"  style="float: right;" class="btn btn-warning mt-2">Viewed / Message</a>

      <?php }else{?>
        <div style="margin-bottom: 0%;" class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>The Ticket Was Appointmented To Another</strong> 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php if($del->price){?>
                        <span style="color: red;font-size: 16px;
   position: absolute;
   
   bottom: 6px;" class="card-text"><b>Rs.<?php echo $del->price?></b><br>
                        <?php }?></span>       <a href="biding_details.php?enq_id=<?php echo $del->enq_id?>&vender_id=<?php echo $del->venderlid?>&title=<?php echo $del->keyword ?>"  style="float: right;" class="btn btn-danger mt-2">Closed</a>

   <?php   }
 }
?>

<?php
    
}
else{

?>

                        <?php if($del->status == 'new')
    {?>
                        <!-- <a onclick="biding_pay('<?php echo $del->enq_id?>','<?php echo $del->venderlid?>','<?php echo $del->cost;?>');"  style="float: right;" class="btn btn-success">Start Bidding
                            Rs.<?php echo $del->cost;?></a> -->
                       <a style="float:right" onclick="biding_pay('<?php echo $del->enq_id?>','<?php echo $del->venderlid?>','<?php echo $del->cost;?>');"  type="button" class="btn btn-outline-primary"><i class='fa fa-phone'></i> Call / <i class='far fa-comment'></i> Message</a>
<!-- <a onclick="biding_pay('<?php echo $del->enq_id?>','<?php echo $del->venderlid?>','<?php echo $del->cost;?>');"  type="button" class="btn btn-outline-primary"></a> -->
<!-- <a onclick="biding_pay('<?php echo $del->enq_id?>','<?php echo $del->venderlid?>','<?php echo $del->cost;?>');"  type="button" class="btn btn-outline-primary"><i class='far fa-envelope-open'></i> Email</a>   -->
                       


                        <?php  }elseif($del->status == 'close'){ 
                            echo '<div class="alert alert-primary" role="alert">
                            Ticket Closed!
                          </div>';
                         }
                        }?>
                    </div>
                </div>
            <!-- </div>
        </div> -->





        <?php }				?>

        </p>

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
            // alert(data);
         if(data == 1)
         {
            window.location.href = "biding_details.php?enq_id="+enq_id+"&vender_id="+vender;  
         }else if(data == 2)
         {
          window.location.href = "biding_details.php?enq_id="+enq_id+"&vender_id="+vender; 
         }
         else if(data == 3)
         {
            msg +='<div class="alert alert-danger" role="alert">Please Top Up Your Vendor Wallet!</div>';
         $('#result').html(msg);
        }
        }
    });


    }
</script>
<script>
  function enq_label(label,id)
  {
var res='';
    $.ajax({
        type: "POST",
        url: 'label_set.php',
        data: {label:label,id:id}, // serializes the form's elements.
        success: function(data)
        {
          if(data== 1){
            res= '<span class="badge badge-primary">Follow-up</span>';
  }else if(data == 2){
    res= '<span class="badge badge-success">Deal Completed</span>';
    }else if(data == 3){
      res='<span class="badge badge-warning">Not Interested</span>';
      }else if(data == 4){
        res='<span class="badge badge-info">Not Reached</span>';
        }

        $('.enq__label'+id).html(res);
        }
    });
  }
</script>
<style>
.dropdown-menu{
  top: 24px !important;
    left: 19px !important;
}
.col-3 {
    -ms-flex: 0 0 25%;
    flex: 0 0 25%;
    max-width: 18% !important;
}
hr {
    
    margin-bottom: 0rem !important;}

    .badge-info {
    color: #ffffff;
    background-color: rgb(255 0 70 / 77%);
}
.badge-warning {
    color: #080808;
    background-color: rgb(243 182 0 / 83%);
}
.badge-success{
    background: #04cb26;
    color: black;
}
.badge-primary {
    color: #020202c7;
    background-color: rgb(225 5 177 / 70%);
}
</style>