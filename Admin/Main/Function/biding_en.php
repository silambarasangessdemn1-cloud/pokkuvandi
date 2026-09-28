<?php include('../../config/setup.php');?>

<?php
if(isset($_POST['edit']))

{



    $sql = "UPDATE biding_enq SET status='".$_POST['status']."',notes='".$_POST['notes']."' WHERE biding_en_id='".$_POST['id']."'";



    $pro_gall_delete=mysqli_query($config,$sql);

    if($pro_gall_delete==true)

   {

   echo "<script>window.location.href='../biding_enq.php?erro=0';</script>".mysqli_error();	 

   }
}
if(isset($_POST['edit1']))

{



    $sql = "UPDATE biding_enq SET status='".$_POST['status']."',notes='".$_POST['notes']."' WHERE biding_en_id='".$_POST['id']."'";



    $pro_gall_delete=mysqli_query($config,$sql);

    if($pro_gall_delete==true)

   {

   echo "<script>window.location.href='../biding_de.php?erro=0';</script>".mysqli_error();	 

   }
}
  

if($_GET['id'])

{

 

 $sql="delete from biding_enq where biding_en_id='".$_GET['id']."'";



$pro_gall_delete=mysqli_query($config,$sql);

 if($pro_gall_delete==true)

{

echo "<script>window.location.href='../biding_enq.php?erro=0';</script>".mysqli_error();	 

}
}
if($_GET['id1'])

{

 

 $sql="delete from biding_enq where biding_en_id='".$_GET['id1']."'";



$pro_gall_delete=mysqli_query($config,$sql);

 if($pro_gall_delete==true)

{

echo "<script>window.location.href='../biding_de.php?erro=0';</script>".mysqli_error();	 

}
}
?>
