<?php include('config/setup.php');?>

<?php 
header('Content-type: application/json');
				$main_cate=mysqli_query($config,"SELECT * FROM `promote_video` INNER JOIN promote_category ON promote_video.category = promote_category.id");
                while($row =mysqli_fetch_object($main_cate))
                {
                    $data[] = $row->vid;
                }
                echo json_encode($data);
                ?>
            