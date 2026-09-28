<?php include('config/setup.php'); 

 
// if(isset($_POST['edit']))

// {
   
 $id=$_POST['id'];
 $company_name=$_POST['company_name'];

 $job_name=$_POST['job_name'];
 $job_location=$_POST['job_location'];
 $salary_range=$_POST['salary_range'];
  $contact_no=$_POST['contact_no'];
  $licence_no=$_POST['licence_no'];

  // $edit_insurance_exp_date=$_POST['edit_insurance_exp_date'];



 
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


// echo "update job_search_post set company_name = '".$_POST['company_name']."',job_name = '".$_POST['job_name']."',job_location = '".$_POST['job_location']."',salary_range ='".$_POST['salary_range']."',contact_no = '".$_POST['contact_no']."',licence_no = '".$_POST['licence_no']."' where job_search_id = '$id'";
// die;
    $addmaincate=mysqli_query($config,"update job_search_post set company_name = '".$_POST['company_name']."',job_name = '".$_POST['job_name']."',job_location = '".$_POST['job_location']."',salary_range ='".$_POST['salary_range']."',contact_no = '".$_POST['contact_no']."',licence_no = '".$_POST['licence_no']."',experiences = '".$_POST['experiences']."',qualification = '".$_POST['qualification']."',state_id = '".$_POST['state']."',city_id	 = '".$_POST['dis_city']."',area_id	 = '".$_POST['Add_area']."',vehicle_type = '".$_POST['vehicle_type']."',last_date = '".$_POST['last_date']."',address = '".$_POST['address']."',remarks = '".$_POST['Add_remarks']."'  where job_search_id = '$id'");	





//    $addcatephoto=substr($Add_vehicle_photo,12);
// $addphoto="../photos/vehicle/".$addcatephoto;
// //echo $addphoto;
// move_uploaded_file($_FILES["Add_vehicle_photo"]["tmp_name"],$addphoto);


// if($imgname!='')
// {
//    // echo $query="update create_post set vehicle_photo ='$imgname',whatsapp_no = '".$_POST['edit_whatsapp_no']."',address = '".$_POST['edit_address']."',stand_name = '".$_POST['edit_stand_name']."',night_duty =' $checkboxValue',Add_location = '".$_POST['edit_location']."',Add_insurance_exp_date = '".$_POST['edit_insurance_exp_date']."' where post_id = '$id'";
   
//   $addmaincate=mysqli_query($config,"update create_post set vehicle_photo ='$imgname',whatsapp_no = '".$_POST['edit_whatsapp_no']."',address = '".$_POST['edit_address']."',stand_name = '".$_POST['edit_stand_name']."',night_duty =' $checkboxValue',Add_location = '".$_POST['edit_location']."',Add_insurance_exp_date = '".$_POST['edit_insurance_exp_date']."' where post_id = '$id'");	

// }
// else{

  // echo $query="update create_post set whatsapp_no = '".$_POST['edit_whatsapp_no']."',address = '".$_POST['edit_address']."',stand_name = '".$_POST['edit_stand_name']."' where post_id = '$id'";
  //   die;
  
// }


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