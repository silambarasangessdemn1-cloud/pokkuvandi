<?php include('../../config/setup.php');?>

<?php

 



if($_GET['delpormid'])

{

 

 $sql="delete from promote_enquiry where id='".$_GET['delpormid']."'";



$pro_gall_delete=mysqli_query($config,$sql);

 if($pro_gall_delete==false)

{

echo "<script>window.location.href='../promo_Enquiry.php?erro=0';</script>".mysqli_error();	 

}

else{

	

	echo "<script>window.location.href='../promo_Enquiry.php?delmsg=101';</script>";	 



	

}





}



if(isset($_POST['s_name']))

{



    $sql = "UPDATE promote_enquiry SET status='".$_POST['status']."',view='".$_POST['view']."'  WHERE id='".$_POST['e_id']."'";



    $pro_gall_delete=mysqli_query($config,$sql);

    if($pro_gall_delete==false)

   {

   echo "<script>window.location.href='../promo_Enquiry.php?erro=0';</script>".mysqli_error();	 

   }

   else{
if($_POST['order'] == '1')
{
       

       echo "<script>window.location.href='../promo_Enquiry.php?delmsg=101';</script>";	 
}elseif($_POST['order'] == '2')
{
    echo "<script>window.location.href='../view_promo_enquriry.php?delmsg=101';</script>";	 
  
}elseif($_POST['order'] == '3')
{
    echo "<script>window.location.href='../inactive_enquire.php?delmsg=101';</script>";	 
   
}
   

       

   }

}

?>