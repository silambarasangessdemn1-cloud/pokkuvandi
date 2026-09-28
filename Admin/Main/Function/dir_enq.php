<?php include('../../config/setup.php');?>

<?php
if(isset($_POST['edit1']))

{



     $sql = "UPDATE dir_enq SET status='".$_POST['status']."' WHERE dir_enq_id='".$_POST['id']."'";



    $pro_gall_delete=mysqli_query($config,$sql);

    if($pro_gall_delete==true)

   {

   echo "<script>window.location.href='../dir_enq.php?erro=0';</script>".mysqli_error();	 

   }
}


if(isset($_GET['id']))

{



     $sql = "DELETE FROM dir_enq  WHERE dir_enq_id='".$_GET['id']."'";



    $pro_gall_delete=mysqli_query($config,$sql);

    if($pro_gall_delete==true)

   {

   echo "<script>window.location.href='../dir_enq.php?erro=0';</script>".mysqli_error();	 

   }
}