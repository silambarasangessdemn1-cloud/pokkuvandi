<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['Lee_customer_front_edit']))
 { 
    $name_front = mysqli_real_escape_string($config, $_POST['name_front']);
    $edit_front_id = mysqli_real_escape_string($config, $_POST['Edit_front_id']);

    $update_about = mysqli_query($config, "UPDATE cms SET fron_contanct='$name_front' WHERE cms_id='$edit_front_id'");
    
    if($update_about == false)
    {
        $error = mysqli_real_escape_string($config, mysqli_error($config));
        echo  "<script>window.location.href='../front_content.php?erro=0&msg=$error';</script>";	 
    } else {
        echo  "<script>window.location.href='../front_content.php?mes=0';</script>";	 
    }
 }
 elseif(isset($_POST['Lee_driver_front_edit']))
 { 
    $name_driver_front = isset($_POST['name_driver_front']) ? mysqli_real_escape_string($config, $_POST['name_driver_front']) : '';
    $edit_front_id = mysqli_real_escape_string($config, $_POST['Edit_front_id']);

    $update_about = mysqli_query($config, "UPDATE cms SET driver_contanct='$name_driver_front' WHERE cms_id='$edit_front_id'");
    
    if($update_about == false)
    {
        $error = mysqli_real_escape_string($config, mysqli_error($config));
        echo  "<script>window.location.href='../front_content.php?erro=0&msg=$error';</script>";	 
    } else {
        echo  "<script>window.location.href='../front_content.php?mes=0';</script>";	 
    }
 }
 elseif(isset($_POST['Lee_front_edit']))
 { 
    $edit_front_id = mysqli_real_escape_string($config, $_POST['Edit_front_id']);
    $name_front = isset($_POST['name_front']) ? mysqli_real_escape_string($config, $_POST['name_front']) : null;
    $name_driver_front = isset($_POST['name_driver_front']) ? mysqli_real_escape_string($config, $_POST['name_driver_front']) : null;

    if($name_front !== null && $name_driver_front !== null) {
        $update_about = mysqli_query($config, "UPDATE cms SET fron_contanct='$name_front', driver_contanct='$name_driver_front' WHERE cms_id='$edit_front_id'");
    } elseif($name_front !== null) {
        $update_about = mysqli_query($config, "UPDATE cms SET fron_contanct='$name_front' WHERE cms_id='$edit_front_id'");
    } elseif($name_driver_front !== null) {
        $update_about = mysqli_query($config, "UPDATE cms SET driver_contanct='$name_driver_front' WHERE cms_id='$edit_front_id'");
    }
    
    if($update_about == false)
    {
        $error = mysqli_real_escape_string($config, mysqli_error($config));
        echo  "<script>window.location.href='../front_content.php?erro=0&msg=$error';</script>";	 
    } else {
        echo  "<script>window.location.href='../front_content.php?mes=0';</script>";	 
    }
 }
?>