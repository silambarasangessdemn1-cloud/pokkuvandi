<?php include('config/setup.php');?>



<?php 

 $id=$_POST['id'];



  $sql = "SELECT * FROM `membership_list` where unique_id Like '%$id%'";

$result = mysqli_query($config, $sql);



if (mysqli_num_rows($result) > 0) {



  $data=mysqli_fetch_object($result);

  

  

   

      echo '1';

  

   

 

} else {

   echo "0";
 

}



?>