<?php include('config/setup.php')?>

<?php 
$key=$_POST['key'];



											$main_cate1=mysqli_query($config,"SELECT * FROM `biding_post` WHERE keyword LIKE '%$key%'");

											while($macate3=mysqli_fetch_object($main_cate1))

											{

										





$data .='<div class="col-4 p-1">

<div class="bg-white shadow-sm rounded text-center  px-2 py-3 c-it">

   <a href="Bidding_enq.php?mid='.$macate3->post_id.'&keyword='.$macate3->keyword.'">

      <img src="img/keyword_icon/'.$macate3->key_icon.'" class="img-fluid px-2">

      <p class="m-0 pt-2 text-muted text-center">'.$macate3->keyword.'</p>

   </a>

</div>

</div>';


}

echo $data;
?>