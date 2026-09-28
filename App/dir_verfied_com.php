<?php include('config/setup.php');?>

<?php include('session.php');
	?>


<?php

$mid=$_POST['mid'];

											$main_cate3=mysqli_query($config,"SELECT * FROM `dir_package` order BY (dir_packid) ASC ");

											while($macate3=mysqli_fetch_object($main_cate3))

											{
                                        if($_POST['area']){
                                            if($_POST['c_ver'] == 1)
                                            {
                                         $or="SELECT * FROM `dir_vender` INNER JOIN dir_keyword ON dir_keyword.dir_vender_id=dir_vender.dir_vender_id WHERE dir_vender_pack='$macate3->dir_packid' and dir_vender_city='".$_SESSION["city"]."' and dir_vender_key='$mid' and dir_vender_area='".$_POST['area']."' and dirv_status='0' and c_ver='".$_POST['c_ver']."' group by(dir_vender.dir_vender_id)  ORDER BY RAND() LIMIT $macate3->order_number ";
                                            }else{
                                                $or="SELECT * FROM `dir_vender` INNER JOIN dir_keyword ON dir_keyword.dir_vender_id=dir_vender.dir_vender_id WHERE dir_vender_pack='$macate3->dir_packid' and dir_vender_city='".$_SESSION["city"]."' and dir_vender_key='$mid' and dir_vender_area='".$_POST['area']."' and dirv_status='0'  group by(dir_vender.dir_vender_id)  ORDER BY RAND() LIMIT $macate3->order_number ";
   
                                            }
                                        }else{
                                            if($_POST['c_ver'] == 1)
                                            {
                                            $or="SELECT * FROM `dir_vender` INNER JOIN dir_keyword ON dir_keyword.dir_vender_id=dir_vender.dir_vender_id WHERE dir_vender_pack='$macate3->dir_packid' and dir_vender_city='".$_SESSION["city"]."' and dir_vender_key='$mid' and dirv_status='0' and c_ver='".$_POST['c_ver']."' group by(dir_vender.dir_vender_id)  ORDER BY RAND() LIMIT $macate3->order_number ";
                                            }else{
                                                $or="SELECT * FROM `dir_vender` INNER JOIN dir_keyword ON dir_keyword.dir_vender_id=dir_vender.dir_vender_id WHERE dir_vender_pack='$macate3->dir_packid' and dir_vender_city='".$_SESSION["city"]."' and dir_vender_key='$mid' and dirv_status='0'  group by(dir_vender.dir_vender_id)  ORDER BY RAND() LIMIT $macate3->order_number ";
    
                                            }
                                        }      
                                         
                                         
                                         $maincate3=mysqli_query($config,$or);
                                                $ldata[]= mysqli_num_rows($maincate3);
                                                while($mac3=mysqli_fetch_object($maincate3))
    
                                                {

                                                    $maincate3c=mysqli_query($config,"SELECT AVG(rate) as rate,COUNT(rate) as total FROM `dir_review` where r_vid='$mac3->dir_vender_id'
                                                    and r_status='1'");
                                                   
                                                    $mac3c=mysqli_fetch_object($maincate3c);
                                                    if( ceil($mac3c->rate) == 1){
                                                        $rate ='
                                                   <p><span class="fa fa-star checked"></span>
                                                   <span class="fa fa-star "></span>
                                                   <span class="fa fa-star "></span>
                                                   <span class="fa fa-star"></span>
                                                   <span class="fa fa-star"></span><span style="color: red;">'.$mac3c->total.' Ratings</span></p>';
                                                  }elseif(ceil($mac3c->rate) == 2){
                                                      $rate ='
                                                       <p><span class="fa fa-star checked"></span>
                                                   <span class="fa fa-star checked"></span>
                                                   <span class="fa fa-star "></span>
                                                   <span class="fa fa-star"></span>
                                                   <span class="fa fa-star"></span><span style="color: red;">'.$mac3c->total.' Ratings</span></p>';
                                                   
                                                    }elseif(ceil($mac3c->rate) == 3){
                                                         $rate =' <p><span class="fa fa-star checked"></span>
                                                   <span class="fa fa-star checked"></span>
                                                   <span class="fa fa-star checked"></span>
                                                   <span class="fa fa-star"></span>
                                                   <span class="fa fa-star"></span><span style="color: red;"> '.$mac3c->total.' Ratings</span></p>';
                                                     }elseif(ceil($mac3c->rate) == 4){
                                                           $rate ='    <p><span class="fa fa-star checked"></span>
                                                   <span class="fa fa-star checked"></span>
                                                   <span class="fa fa-star checked"></span>
                                                   <span class="fa fa-star checked"></span>
                                                   <span class="fa fa-star"></span><span style="color: red;">'. $mac3c->total.' Ratings</span></p>';
                                                     }elseif(ceil($mac3c->rate) == 5){
                                                                 $rate ='<p><span class="fa fa-star checked"></span>
                                                   <span class="fa fa-star checked"></span>
                                                   <span class="fa fa-star checked"></span>
                                                   <span class="fa fa-star checked"></span>
                                                   <span class="fa fa-star checked"></span> <span style="color: red;"> '. $mac3c->total.' Ratings</span></p>';
                                                  }else{
                                                              $rate='<p><span class="fa fa-star "></span>
                                                   <span class="fa fa-star "></span>
                                                   <span class="fa fa-star "></span>
                                                   <span class="fa fa-star "></span>
                                                   <span class="fa fa-star "></span> </p>';
                                                      }                                               

                                                      if($mac3->packid == 1) {
                                                        if($mac3->c_ver == 1){
                                                      $ve='<span style="font-size: 12px;
                                                          position: absolute;
                                                          margin-top: 45%;
                                                          left: 55%;
                                                          right: 0%;
                                                          
                                                        
                                                          font-family: fangsong;
                                                          font-weight: 600;"><i>'. $mac3->c_ver_yr.'</i></span>
                                                      <img src="img/f1.png" style="width: 94px;
                                                      height: 35px;
                                                      margin-top: 79%;">';
                                                   }else{
                                                    $ve='<img src="img/f5.png" style="width: 94px;
                                                    height: 35px;
                                                    margin-top: 79%;">';
                                                      
                                                    }
                                                      }elseif($mac3->packid == 2){
                                                          if($mac3->c_ver == 1){
                                                            $ve='<span style="font-size: 12px;
                                                          position: absolute;
                                                          margin-top: 45%;
                                                          left: 55%;
                                                          right: 0%;
                                                         
                                                       
                                                          font-family: fangsong;
                                                          font-weight: 600;"><i>'. $mac3->c_ver_yr.'</i></span>
                                                      <img src="img/f2.png" style="width: 94px;
                                                      height: 35px;
                                                      margin-top: 79%;">';
                                                     }else{
                                                      $ve='<img src="img/f5.png" style="width: 94px;
                                                      height: 35px;
                                                      margin-top: 79%;">';
                                                      
                                                      }
                                                       }
                                                          elseif($mac3->packid == 3){
                                                            if($mac3->c_ver == 1){
                                                             $ve='<span style="font-size: 12px;
                                                          position: absolute;
                                                          margin-top: 45%;
                                                          left: 55%;
                                                          right: 0%;
                                                       
                                                          
                                                          font-family: fangsong;
                                                          font-weight: 600;"><i>'. $mac3->c_ver_yr.'</i></span>
                                                      
                                                      <img src="img/f3.png" style="width: 94px;
                                                      height: 35px;
                                                      margin-top: 79%;">';
                                                         }else{
                                                          $ve='<img src="img/f5.png" style="width: 94px;
                                                          height: 35px;
                                                          margin-top: 79%;">';
                                                      
                                                   }
                                                          }elseif($mac3->packid == 4){
                                                            if($mac3->c_ver == 1){
                                                              $ve='<span style="font-size: 12px;
                                                          position: absolute;
                                                          margin-top: 45%;
                                                          left: 55%;
                                                          right: 0%;
                                                         
                                                       
                                                          font-family: fangsong;
                                                          font-weight: 600;"><i>'. $mac3->c_ver_yr.'</i></span>
                                                      <img src="img/f4.png" style="width: 91px;
                                                          height: 69px;">'; 
                                                         }else{
                                                          $ve='<img src="img/f5.png" style="width: 94px;
                                                          height: 35px;
                                                          margin-top: 79%;">';
                                                      
                                                   }
                                                        }else{
                                                       
                                                          $ve=' <img src="img/f5.png" style="width: 94px;
                                                          height: 35px;
                                                          margin-top: 79%;">'; 
                                                      
                                                  }
                                                      





                               
 $data .=' <div class="card" style="width: 100%; padding: 0%;margin-bottom:2px;">
  <div class="card-body">
   <div class="row">
       <div class="col-4">
<img src="img/dir_logo/'. $mac3->c_logo.'" style="    width: 100px;
height: 100px;
margin: auto;
margin-top: 11%;">
'.$ve.'

       </div>
       <div class="col-8">
        <h4 style="color: red;">'. $mac3->c_name.'</h4>
        '.$rate.'
        <p style="text-transform: capitalize;"><img style="height:17px;" src="ind.jpeg"> <span style="font-weight: 600;">IND</span> | <span style="color: red;font-weight: 600;">'. $mac3->c_city.'</span>, &nbsp;<span>'.$mac3->c_area.'<span> </p>
        <p><img src="img/mobile.png"><span style="color:blue;font-size:14px;"  > '. $mac3->c_phone.'</span></p>
               <p>'.substr($mac3->future_keys,0,50).'...</p>
        <a href="directory_details.php?did='. $mac3->dir_vender_id.'&title='.$mac3->c_name.'&key='.$mid.'&area='.$_SESSION["city"].'&areaname='.$_SESSION["city_name"].'" style="width: 100%;color:white;" type="button" class="btn btn-primary  btn-sm">Get Best Deal</a>
       </div>
   </div>
  </div>
</div>';
 } }
 if((($ldata[0] == 0) && ($ldata[1] == 0)) && (($ldata[2] == 0)&&($ldata[3] == 0)))
{
  $data .='<img src="data1.png" style="width: 100%;">';
 }


 echo $data ;?>