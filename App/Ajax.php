<?php include('config/setup.php')?>
<?php include('session.php');?>

<?php
 
if (isset($_POST['search'])) {
 
   $Name = $_POST['search'];
 
   $Query = "SELECT Product_Name  FROM product_master WHERE Product_Name LIKE '%$Name' LIMIT 10";
 
   $ExecQuery = MySQLi_query($config, $Query);
 
   echo '
<ul>
   ';
    
   while ($Result = MySQLi_fetch_array($ExecQuery)) {
       ?>
  
   <li onclick='fill("<?php echo $Result['Product_Name']; ?>")'>
   <a href="product_details.php?Prodetail=<?php echo $Result['Product_id']; ?>">
  
       <?php echo $Result['Name']; ?>
   </li></a>
    
   <?php
}}
?>
</ul>