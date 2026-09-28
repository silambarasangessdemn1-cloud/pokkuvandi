<?php include('config/setup.php')?>

<?php 

$sql = "UPDATE vemder_enq_list SET enq_set='".$_POST['label']."' WHERE vender_list_id=".$_POST['id']."";

mysqli_query($config, $sql); 
echo $_POST['label'];
?>