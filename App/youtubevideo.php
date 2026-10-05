<?php include('config/setup.php');?>



<?php 





 $text=$_POST['text'] ?? '';

 function getThumbnailHtml($iframeString) {
    if (preg_match('/src="([^"]+)"/', $iframeString, $matches)) {
        $src = $matches[1];
        if (preg_match('/embed\/([a-zA-Z0-9_-]+)/', $src, $idMatches)) {
            $yt_id = $idMatches[1];
            return '<a target="_blank" href="https://www.youtube.com/watch?v=' . $yt_id . '">
                    <div style="border: 5px solid green; border-radius: 15px; position: relative; overflow: hidden; background: #000; height: 158px;">
                      <img style="width: 100%; height: 100%; object-fit: cover; opacity: 0.8;" src="https://img.youtube.com/vi/' . $yt_id . '/hqdefault.jpg" alt="Video Thumbnail">
                      <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; font-size: 3rem; text-shadow: 0 0 10px rgba(0,0,0,0.8);">
                          <i class="fa fa-youtube-play text-danger" style="background: white; border-radius: 50%; padding: 2px;"></i>
                      </div>
                    </div></a>';
        }
    }
    return $iframeString;
 }

 if($text == '')

 {



    $main_cate=mysqli_query($config,"SELECT * FROM `promote_video` INNER JOIN promote_category ON promote_video.category = promote_category.id ORDER BY vid desc");

    while($row =mysqli_fetch_object($main_cate))

    {

       $data .=' <div class="card">
       '.getThumbnailHtml($row->video).'
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
                   '.getThumbnailHtml($row->video).'
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

            