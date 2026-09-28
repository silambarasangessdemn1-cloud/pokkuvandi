<?php include('../../config/setup.php');?>
<?php if(isset($_POST['submit']))

{ 

    $area= array_filter( $_POST['area']);

foreach($area as $data)
{
     $sql = "INSERT INTO sub_area_master (city,dirarea_id,sub_area_name)

    VALUES ('".$_POST['city_disctrict']."','".$_POST['Add_area']."','$data')";

mysqli_query($config,$sql);

}  
   

   echo "<script>window.location.href='../sub_area_master.php?msg=100';</script>";	 


}

if(isset($_GET['sid']))

{ 

    // echo $query="delete from sub_area_master where dirarea_id ='".$_GET['sid']."'";
    // die;
     $sql="delete from sub_area_master where dirarea_id ='".$_GET['sid']."'";


    $pro_gall_delete=mysqli_query($config,$sql);
    if($pro_gall_delete == true)
 {
	echo "<script>window.location.href='../sub_area_master.php?msg=100';</script>";	 

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
 
      $sql = "INSERT INTO sub_area_master (city,dirarea_id,sub_area_name)

    VALUES ('".$_POST['cate']."','".$_POST['Add_area']."','".$emapData[0]."')";

   mysqli_query($config,$sql);
}

echo "<script>window.location.href='../sub_area_master.php?msg=100';</script>";	 




}