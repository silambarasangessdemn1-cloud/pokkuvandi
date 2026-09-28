<?php include('../../config/setup.php');?>

<?php


if(isset($_POST['submit']))

 { 


    $keyword = array_values(array_filter($_POST['keyword']));

    foreach($keyword as $data)
    {
        $sql = "INSERT INTO subkeyword (key_id,subkeyword)

        VALUES ('".$_POST['cate']."','$data')";
     mysqli_query($config,$sql);
    }
    echo "<script>window.location.href='../subkeyword.php?msg=100';</script>";	 

 }
 if(isset($_GET['sid']))

{ 

    $sql="delete from subkeyword where 	key_id='".$_GET['sid']."'";



    $pro_gall_delete=mysqli_query($config,$sql);
    if($pro_gall_delete == true)
 {
	echo "<script>window.location.href='../subkeyword.php?msg=100';</script>";	 

}
}