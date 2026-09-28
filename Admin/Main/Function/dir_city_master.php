<?php include('../../config/setup.php');?>

<?php
if(isset($_POST['cate_add']))

{ 
    $sql = "INSERT INTO dir_city_master (dir_city_name, state_id) 
    VALUES ('" . $_POST['category'] . "', '" . $_POST['state_id'] . "')";



$update_app_Name=mysqli_query($config,$sql);
if($update_app_Name == true)
 {
	echo "<script>window.location.href='../dir_city_master.php?msg=100';</script>";	 

}
}

if(isset($_POST['e_cate']))

{ 
$sql = "UPDATE dir_city_master SET dir_city_name='".$_POST['category']."'  WHERE dir_city_id='".$_POST['cid']."'";
$update_app_Name=mysqli_query($config,$sql);
if($update_app_Name == true)
 {
	echo "<script>window.location.href='../dir_city_master.php?msg=100';</script>";	 

}

}
if(isset($_GET['cd']))

{ 

    $sql="delete from dir_city_master where dir_city_id='".$_GET['cd']."'";



    $pro_gall_delete=mysqli_query($config,$sql);
    if($pro_gall_delete == true)
 {
	echo "<script>window.location.href='../dir_city_master.php?msg=100';</script>";	 

}
}

if (isset($_POST['exsubmit'])) { 
    $state = $_POST['state']; // Get the selected state ID

    $file = $_FILES["excel"]["tmp_name"];

    if ($file) {
        $file_open = fopen($file, "r");

        // Read and process each row
        while (($emapData = fgetcsv($file_open, 10000, ",")) !== FALSE) {
            $cityName = trim($emapData[0]); // Trim spaces

            if (!empty($cityName)) { // Skip empty rows
                $cityName = mysqli_real_escape_string($config, $cityName); // Sanitize input

                // Insert city with associated state_id
                $sql = "INSERT INTO dir_city_master (dir_city_name, state_id) VALUES ('$cityName', '$state')";
                mysqli_query($config, $sql);
            }
        }

        fclose($file_open); // Close the file after reading
    }

    // Redirect after successful insertion
    echo "<script>window.location.href='../dir_city_master.php?msg=100';</script>";	 
}


