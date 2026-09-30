<?php include('config/setup.php');

$id=$_POST['id'];


?> 
<?php 
$data='';
            $data .='<div class="form-group" style="width: 100%; display: flex; justify-content: flex-end;">';
            
                $shop_master_=mysqli_query($config,"select * from category_package where package_id ='$id' and status=1");
                while($sm_=mysqli_fetch_object($shop_master_))
                {
                    $package_amount = $sm_->package_amount;
                    if($package_amount == '0')
                    {
                        $data .=' <button class="btn btn-success" type="submit" id="post_submit" name="post_add">Get Free registration</button>  ';
                    }
                    else
                    {
                        $data .=' <button class="btn btn-success" type="submit"  id="post_submit" name="post_add">Pay For registration</button> ';
                    }
               
                }
		
             $data .='</div>';

             echo  $data;

?>
