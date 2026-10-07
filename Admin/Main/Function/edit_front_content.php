<?php include('../../config/setup.php');?>
<?php
 if(isset($_POST['Lee_front_edit']))
 { 
    $name_front = mysqli_real_escape_string($config, $_POST['name_front']);
    $name_front_tamil = mysqli_real_escape_string($config, $_POST['name_front_tamil']);
    $edit_front_id = mysqli_real_escape_string($config, $_POST['Edit_front_id']);

    $update_about = mysqli_query($config, "UPDATE cms SET fron_contanct='$name_front', fron_contanct_tamil='$name_front_tamil' WHERE cms_id='$edit_front_id'");
    
    if($update_about == false)
    {
        $error = mysqli_real_escape_string($config, mysqli_error($config));
        echo  "<script>window.location.href='../front_content.php?erro=0&msg=$error';</script>";	 
    } else {
        echo  "<script>window.location.href='../front_content.php?mes=0';</script>";	 
    }
 }
?>