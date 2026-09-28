<?php include('../../config/setup.php');?>

<?php
if(isset($_POST['cate_add']))

{ 
    $sql = "INSERT INTO biding_cate (title)

    VALUES ('".$_POST['category']."')";



$update_app_Name=mysqli_query($config,$sql);
if($update_app_Name == true)
 {
	echo "<script>window.location.href='../biding_slide.php?msg=100';</script>";	 

}
}

if(isset($_POST['e_cate']))

{ 
$sql = "UPDATE biding_cate SET title='".$_POST['category']."'  WHERE cid='".$_POST['cid']."'";
$update_app_Name=mysqli_query($config,$sql);
if($update_app_Name == true)
 {
	echo "<script>window.location.href='../biding_slide.php?msg=100';</script>";	 

}

}
if(isset($_GET['cd']))

{ 

    $sql="delete from biding_cate where cid='".$_GET['cd']."'";



    $pro_gall_delete=mysqli_query($config,$sql);
    if($pro_gall_delete == true)
 {
	echo "<script>window.location.href='../biding_slide.php?msg=100';</script>";	 

}
}
 if(isset($_POST['submit']))

 { 

$link=$_POST['link'];

    $file_name = $_FILES['image']['name'];
    $file_size =$_FILES['image']['size'];
     $file_tmp =$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
    
    
    $countfiles = count($_FILES['image']['name']);
    
    
    for($i=0;$i<$countfiles;$i++){
     $filename = $_FILES['image']['name'][$i];
    
    
     move_uploaded_file($_FILES['image']['tmp_name'][$i],'../../../App/img/biding_cate/'.$filename);
     $sql = "INSERT INTO biding_slider (cate_id,image,link)

     VALUES ('".$_POST['cate']."','$filename','".$link[$i]."')";
 
 
 
 mysqli_query($config,$sql);
 
    
    }

	echo "<script>window.location.href='../biding_slider_img.php?msg=100';</script>";	 


}





if($_GET['delpormid'])

{

 

 $sql="delete from promote_slider where id='".$_GET['delpormid']."'";



$pro_gall_delete=mysqli_query($config,$sql);

 if($pro_gall_delete==false)

{

echo "<script>window.location.href='../promo_slider.php?erro=0';</script>".mysqli_error();	 

}

else{

	

	echo "<script>window.location.href='../promo_slider.php?delmsg=101';</script>";	 



	

}





}



if(isset($_POST['s_name']))

{



    $filename = $_FILES["uploadfile"]["name"];

    $tempname = $_FILES["uploadfile"]["tmp_name"];    

         $folder = "../../../App/img/promo_slider/".$filename;

         move_uploaded_file($tempname, $folder);



    $sql = "UPDATE promote_slider SET Image='$filename'  WHERE id='".$_POST['e_id']."'";



    $pro_gall_delete=mysqli_query($config,$sql);

    if($pro_gall_delete==false)

   {

   echo "<script>window.location.href='../promo_slider.php?erro=0';</script>".mysqli_error();	 

   }

   else{

       

       echo "<script>window.location.href='../promo_slider.php?delmsg=101';</script>";	 

   

       

   }

}
if(isset($_GET['sid']))

{ 

    $sql="delete from biding_slider where cate_id='".$_GET['sid']."'";



    $pro_gall_delete=mysqli_query($config,$sql);
    if($pro_gall_delete == true)
 {
	echo "<script>window.location.href='../biding_slider_img.php?msg=100';</script>";	 

}
}
?>