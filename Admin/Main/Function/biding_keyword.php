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
    $price_status=array_values(array_filter($_POST['price_status']));

    
   
    $i=0;
  foreach( $file_name as $image)
  {
    move_uploaded_file($file_tmp[$i],'../../../App/img/keyword_icon/'.$image);
    $sql = "INSERT INTO biding_post (category_id,cost,keyword,key_icon,price_status)

    VALUES ('".$_POST['cate']."','".$cost[$i]."','".$keyword[$i]."','$image','".$price_status[$i]."')";
 mysqli_query($config,$sql);
    $i++;
  }
    
    

	echo "<script>window.location.href='../biding_keyword.php?msg=100';</script>";	 


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