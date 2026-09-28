<?php include('config/setup.php');

$id=$_POST['id'];


// echo $quer="select * from job_search_category where Main_Category_id='$id'";
$main_cate=mysqli_query($config,"select * from job_search_category where Main_Category_id='$id'");
$macate=mysqli_fetch_object($main_cate);

?>
<?php 
$data='';
       $data .='<input readonly type="text" class="form-control" id="amount" name="amount" value="'.$macate->amount.'">';
             echo  $data;

?>
