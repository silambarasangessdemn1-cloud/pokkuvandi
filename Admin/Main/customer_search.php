<?php include('../config/setup.php');

$customerid = $_POST['customerid'];
  $sql="SELECT * FROM `customer_master` where Customer_Name LIKE '%$customerid%' or 	Customer_Phone_No LIKE '%$customerid%' ";

$sdate= mysqli_query($config, $sql);
while ($data = mysqli_fetch_object($sdate)) {
?>


        <li class="sug-list"><a class="" href="javascript:void(0)" onclick="serach_result('<?php echo $data->Customer_Id;?>','<?php echo $data->Customer_Name;?>',<?php echo $data->Customer_Phone_No;?>,'<?php echo $data->address;?>')"><span><?php echo $data->Customer_Name;?> - <?php echo $data->Customer_Phone_No;?> </span></a></li>
 

<?php }?>