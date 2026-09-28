<?php include('../config/setup.php');?>

<?php



if(isset($_POST['addnew']))

{

$maincate=date('Y-m-d');



if($_POST['video'])

{





  $sql ="UPDATE membership SET title='".$_POST['title']."',description='".$_POST['desc']."',price='".$_POST['amount']."',ex_days='".$_POST['days']."',level1_com='".$_POST['level1']."',level2_com='".$_POST['level2']."',renew_amount='".$_POST['renew']."',video='".$_POST['video']."',purchase_1='".$_POST['purchase_1']."',purchase_2='".$_POST['purchase_2']."',referal_script='".$_POST['referal_script']."',referal_script_title='".$_POST['referal_script_title']."',re_purches_pre='".$_POST['re_purches_pre']."' WHERE mid=1";

}else{

  $sql ="UPDATE membership SET title='".$_POST['title']."',description='".$_POST['desc']."',price='".$_POST['amount']."',ex_days='".$_POST['days']."',level1_com='".$_POST['level1']."',level2_com='".$_POST['level2']."',renew_amount='".$_POST['renew']."',purchase_1='".$_POST['purchase_1']."',purchase_2='".$_POST['purchase_2']."',referal_script='".$_POST['referal_script']."',referal_script_title='".$_POST['referal_script_title']."',re_purches_pre='".$_POST['re_purches_pre']."' WHERE mid=1";



}



$addprotype=mysqli_query($config,$sql);	

if($addprotype)

{

    header("location:Membership_plan.php");	

}

	

}















?>

