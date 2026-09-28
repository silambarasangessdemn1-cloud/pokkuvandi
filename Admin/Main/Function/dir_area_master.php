<?php include('../../config/setup.php');?>
<?php if(isset($_POST['submit']))

{ 

    $area= array_filter( $_POST['area']);

foreach($area as $data)
{
    $sql = "INSERT INTO dir_area_master (dir_cityid,dir_area_name)

    VALUES ('".$_POST['cate']."','$data')";



mysqli_query($config,$sql);

}  
   

   echo "<script>window.location.href='../dir_area_master.php?msg=100';</script>";	 


}

if(isset($_GET['sid']))

{ 

    $sql="delete from biding_area_master where cityid='".$_GET['sid']."'";



    $pro_gall_delete=mysqli_query($config,$sql);
    if($pro_gall_delete == true)
 {
	echo "<script>window.location.href='../area_master.php?msg=100';</script>";	 

}
}

if(isset($_POST['exsubmit']))

{ 

    $file = $_FILES["excel"]["tmp_name"];
    $file_open = fopen($file,"r");
$csv = fgetcsv($file_open,1000,",");


$file = fopen($file, "r");
while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
{
 
     $sql = "INSERT INTO dir_area_master (dir_cityid,dir_area_name)

    VALUES ('".$_POST['cate']."','".$emapData[0]."')";
   mysqli_query($config,$sql);
}

echo "<script>window.location.href='../dir_area_master.php?msg=100';</script>";	 




}