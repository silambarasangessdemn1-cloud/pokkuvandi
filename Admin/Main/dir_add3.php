<?php include('../config/setup.php');?>
<?php 

// print_r($_POST['key']);

// print_r($_POST['dir_city']);
// print_r($_POST['area']);
// print_r($_POST['key']);


$area=$_POST['area'];
foreach($area as $area)
                    {
                        $key=$_POST['key'];
                        foreach($key as $key)
                        {
                            $p=$area.'_'.$key;
                 $sql_key="INSERT INTO dir_keyword (dir_vender_key,dir_vender_id,dir_vender_area,dir_vender_pack,dir_vender_city) VALUES ('$key','".$_POST['vid']."','$area','".$_POST[$p]."','".$_POST['dir_city']."')";
                   mysqli_query($config,$sql_key);
                    }
                    }

                    ?>

                    <script>
                         alert('Successfully Added DIRECTORY');

                         window.location.replace("bussness_list.php");
                    </script>