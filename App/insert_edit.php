<?php include('config/setup.php'); 

 
// if(isset($_POST['edit']))

// {
   
 $id=$_POST['id'];
 $Add_vehicle_photo=$_POST['Add_vehicle_photo'];

 $edit_whatsapp_no=$_POST['edit_whatsapp_no'];
 $edit_address=$_POST['edit_address'];
 $edit_stand_name=$_POST['edit_stand_name'];
  $checkboxValue=$_POST['checkboxValue'];
  $edit_location=$_POST['edit_location'];
  $edit_insurance_exp_date=$_POST['edit_insurance_exp_date'];
  $edit_sub_category = isset($_POST['edit_sub_category']) ? $_POST['edit_sub_category'] : '';
  $edit_vehicle_type_id = isset($_POST['edit_vehicle_type_id']) ? $_POST['edit_vehicle_type_id'] : '';
  $edit_other_vehicle_type = isset($_POST['edit_other_vehicle_type']) ? $_POST['edit_other_vehicle_type'] : '';



 
    $uploadDir = '../photos/vehicle/';
    $uploadFile = $uploadDir . basename($_FILES['Add_vehicle_photo']['name']);

    $imgname=$_FILES['Add_vehicle_photo']['name'];
    // print_r($_FILES['Add_vehicle_photo']['name']);

    // print_r($_FILES['Add_vehicle_photo']['tmp_name']);

    if (move_uploaded_file($_FILES['Add_vehicle_photo']['tmp_name'], $uploadFile)) {
       // echo "Image uploaded successfully.";
    } else {
        // "Failed to upload image.";
    }



//    $addcatephoto=substr($Add_vehicle_photo,12);
// $addphoto="../photos/vehicle/".$addcatephoto;
// //echo $addphoto;
// move_uploaded_file($_FILES["Add_vehicle_photo"]["tmp_name"],$addphoto);


// Build update query with subcategory and vehicle_type_id
$updateFields = "whatsapp_no = '".mysqli_real_escape_string($config, $_POST['edit_whatsapp_no'])."', address = '".mysqli_real_escape_string($config, $_POST['edit_address'])."', stand_name = '".mysqli_real_escape_string($config, $_POST['edit_stand_name'])."', night_duty = '$checkboxValue', Add_location = '".mysqli_real_escape_string($config, $_POST['edit_location'])."', Add_insurance_exp_date = '".mysqli_real_escape_string($config, $_POST['edit_insurance_exp_date'])."'";

// Add subcategory if provided
if (!empty($edit_sub_category)) {
    $updateFields .= ", subcategory_id = '".mysqli_real_escape_string($config, $edit_sub_category)."'";
}

// Add vehicle_type_id if provided
if (!empty($edit_vehicle_type_id) || $edit_vehicle_type_id === '0') {
    $updateFields .= ", vehicle_type_id = '".mysqli_real_escape_string($config, $edit_vehicle_type_id)."'";
}

// Add other_vehicle_type if vehicle_type_id is 0
if ($edit_vehicle_type_id == '0' && !empty($edit_other_vehicle_type)) {
    $updateFields .= ", other_vehicle_type = '".mysqli_real_escape_string($config, $edit_other_vehicle_type)."'";
}

if($imgname!='')
{
   $updateFields .= ", vehicle_photo = '$imgname'";
   $addmaincate=mysqli_query($config,"update create_post set $updateFields where post_id = '$id'");	
}
else{
  $addmaincate=mysqli_query($config,"update create_post set $updateFields where post_id = '$id'");	
}


if($addmaincate==false)
{
 	 
 	 echo "1";	 
}
else
{
		echo "2";	 

}	

    

// }
?>