<?php 

include('config/setup.php');

 $text=$_POST['text'];

if($text == '')
{
    echo '';
}

else{
$main_cate=mysqli_query($config,"SELECT * FROM `promote_category` WHERE title LIKE '%$text%'");
if (mysqli_num_rows($main_cate) > 0) {
    $data .= '<ul class="sresults" >';
   
    ?>
    <?php
while($row =mysqli_fetch_object($main_cate))
{
   $data .= '<li><p onclick="list('."'". $row->title."'".');" >'.$row->title.'</p></li>';
}
$data .= '</ul>';
echo $data;
}else{
    echo ''; 
}
}?>