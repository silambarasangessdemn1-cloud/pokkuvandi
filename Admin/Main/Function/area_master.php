<?php include('../../config/setup.php');?>
<?php if(isset($_POST['submit']))

{ 
    $file1 = $_FILES["excel"]["tmp_name"];
if( $file1)
{
 $file = $_FILES["excel"]["tmp_name"];
    $file_open = fopen($file,"r");
$csv = fgetcsv($file_open,1000,",");


$file = fopen($file, "r");
while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
{
 
     $sql = "INSERT INTO biding_area_master (cityid,area_name)

    VALUES ('".$_POST['cate']."','".$emapData[0]."')";
    mysqli_query($config,$sql);
}



}else{

 $area1=$_POST['area'];
 $area =array_filter($area1);
foreach($area as $data)
{
   echo $sql = "INSERT INTO biding_area_master (cityid,area_name)

    VALUES ('".$_POST['cate']."','$data')";



 mysqli_query($config,$sql);

}  
}

   echo "<script>window.location.href='../area_master.php?msg=100';</script>";	 


}

if(isset($_GET['sid']))

{ 

    $sql="delete from dir_area_master where dir_cityid='".$_GET['sid']."'";



    $pro_gall_delete=mysqli_query($config,$sql);
    if($pro_gall_delete == true)
 {
	echo "<script>window.location.href='../dir_area_master.php?msg=100';</script>";	 

}
}
// if(isset($_POST['excel']))
// {
//     echo '1';
//   echo  $file = $_FILES["excel"]["tmp_name"];
//     $file_open = fopen($file,"r");
//     while(($csv = fgetcsv($file_open, 1000, ",")) !== false)
//     {
//    echo  $area = $csv[0];
   
   
//     }
//     die;
// }