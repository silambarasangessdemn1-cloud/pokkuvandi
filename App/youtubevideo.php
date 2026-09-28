<?php include('config/setup.php');?>



<?php 





 $text=$_POST['text'];

 if($text == '')

 {



    $main_cate=mysqli_query($config,"SELECT * FROM `promote_video` INNER JOIN promote_category ON promote_video.category = promote_category.id ORDER BY vid desc");

    while($row =mysqli_fetch_object($main_cate))

    {

       $data .=' <div class="card">

       '.$row ->video.'

          <div class="card-body">

          <h5>'. $row ->video_title.'</h5>

       <div class="card-text" id="sb_t'.$row->vid.'">

          '.substr($row ->video_desc,0,50).'</div>

          <button style="float:right" onclick="more('.$row->vid.')" id="more'.$row->vid.'" type="button" class="btn btn-secondary btn-sm">Read more..</button>

     </div>

     <div class="card-text complete" id="f_t'.$row->vid.'">

          '.$row ->video_desc.'
          <button  style="float:right" onclick="less('.$row->vid.')" id="less'.$row->vid.'" type="button" class="btn btn-secondary btn-sm r_less">Read less..</button>
          </div>

     </div>

       </div>';

    }

 }else{

				$main_cate=mysqli_query($config,"SELECT * FROM `promote_video` INNER JOIN promote_category ON promote_video.category = promote_category.id WHERE title LIKE '%$text%'");

                if (mysqli_num_rows($main_cate) > 0) {

                  $main_cate1=mysqli_query($config,"SELECT * FROM `promote_video` INNER JOIN promote_category ON promote_video.category = promote_category.id WHERE title LIKE '%$text%' ORDER BY vid desc");



                  $row1 =mysqli_fetch_object($main_cate1);

                  $data .= '<h5 class="b_title">'.$row1->title.'</h5><hr>';

                while($row =mysqli_fetch_object($main_cate))

                {

                   

                   $data .=' <div class="card">

                   '.$row ->video.'

                      <div class="card-body">

                      <h5>'. $row ->video_title.'</h5>

                   <div class="card-text" id="sb_t'.$row->vid.'">

                      '.substr($row ->video_desc,0,50).'</div>

                      <button style="float:right" onclick="more('.$row->vid.')" id="more'.$row->vid.'" type="button" class="btn btn-secondary btn-sm">Read more..</button>

                 </div>

                 <div class="card-text complete" id="f_t'.$row->vid.'">

                      '.$row ->video_desc.'
                      <button  style="float:right" onclick="less('.$row->vid.')" id="less'.$row->vid.'" type="button" class="btn btn-secondary btn-sm r_less">Read less..</button>
                      </div>

                 </div>

                   </div>';

                }

            }else{

                echo '<h4 class="text-center" style="margin-top:3%;color:red;">No videos found</h4>';

            }

            }

                 echo $data;

              

                ?>

            