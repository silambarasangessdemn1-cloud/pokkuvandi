<?php include('config/setup.php');

$id=$_POST['id'];
if($id == 1) {


$data .='<div class="form-group col-md-6">
<label for="exampleFormControlSelect1">From District </label>
    <select required class="form-control" id="from_district" name="from_district">
        <option value="">---SELECT---</option>';
      
        $main_cate=mysqli_query($config,"select * from dir_city_master");
        while($addsubcate=mysqli_fetch_object($main_cate))
      
       {
        $data .='<option  value="'.$addsubcate->dir_city_id.'">'.$addsubcate->dir_city_name .'</option>
       
        ';
        
         }                                                 
         $data .='</select>
</div>

<div class="form-group col-md-6">    
 <label for="email2">From Place</label>
 <input value="" type="text" class="form-control" id="loader_from_place" name="loader_from_place" placeholder="Location Name">
</div>



<div class="form-group col-md-6">
<label for="exampleFormControlSelect1">To District </label>
    <select required class="form-control" id="to_district" name="to_district">
        <option value="">---SELECT---</option>';
      
        $main_cate=mysqli_query($config,"select * from dir_city_master");
        while($addsubcate=mysqli_fetch_object($main_cate))
      
       {
        $data .='<option  value="'.$addsubcate->dir_city_id.'">'.$addsubcate->dir_city_name .'</option>
       
        ';
        
         }                                                 
         $data .='</select>
</div>';

echo  $data;
        }
        else 
        {
            $data .=' <div class="form-group col-md-6">    
            <label for="email2">From Place</label>
            <input value="" type="text" class="form-control" id="loader_from_place" name="loader_from_place" placeholder="Location Name">
           </div>';
           echo  $data;
        }
 ?>