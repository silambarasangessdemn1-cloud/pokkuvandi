<?php include('../../config/setup.php');?>

<?php

if(isset($_POST['submit']))

 { 


    $file_name = array_values(array_filter($_FILES['image']['name']));
    $file_size =array_values(array_filter($_FILES['image']['size']));
     $file_tmp =array_values(array_filter($_FILES['image']['tmp_name']));
    $file_type=array_values(array_filter($_FILES['image']['type']));
    $cost=array_values(array_filter($_POST['cost']));
    $keyword=array_values(array_filter($_POST['keyword']));

    
   
    $i=0;
  foreach( $file_name as $image)
  {
    move_uploaded_file($file_tmp[$i],'../../../App/img/keyword_icon/'.$image);
    $sql = "INSERT INTO dir_post (dir_category_id,dir_cost,dir_keyword,dir_key_icon)

    VALUES ('".$_POST['cate']."','".$cost[$i]."','".$keyword[$i]."','$image')";
 mysqli_query($config,$sql);
    $i++;
  }
    
    

	echo "<script>window.location.href='../dir_keyword.php?msg=100';</script>";	 


}

if(isset($_GET['sid']))

{ 

    $sql="delete from biding_post where category_id='".$_GET['sid']."'";



    $pro_gall_delete=mysqli_query($config,$sql);
    if($pro_gall_delete == true)
 {
	echo "<script>window.location.href='../biding_keyword.php?msg=100';</script>";	 

}
}

if(isset($_POST['edit']))

 { 

   $file_name1 = $_FILES['image']['name'];
   if($file_name1)
   {
    $file_name = $_FILES['image']['name'];
    $file_size =$_FILES['image']['size'];
     $file_tmp =$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
    move_uploaded_file($file_tmp,"../../../App/img/keyword_icon/".$file_name);

   $sql = "UPDATE dir_post SET dir_key_icon='$file_name',dir_keyword='".$_POST['keyword']."',dir_cost='".$_POST['cost']."'  WHERE dir_post_id='".$_POST['sid']."'";

mysqli_query($config,$sql); 
   }else{
      $sql = "UPDATE dir_post SET dir_keyword='".$_POST['keyword']."',dir_cost='".$_POST['cost']."'  WHERE dir_post_id='".$_POST['sid']."'";

mysqli_query($config,$sql); 
   } 
echo "<script>window.location.href='../dir_keyword.php?msg=100';</script>";	 

 }
 if(isset($_GET['did']))

 { 
    $sql="delete from dir_post where dir_post_id='".$_GET['did']."'";



    $pro_gall_delete=mysqli_query($config,$sql);
    echo "<script>window.location.href='../dir_keyword.php?msg=100';</script>";	 

 }