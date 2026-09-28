<?php include('config/setup.php');

$id = $_POST['id'];

if($id == 1) { 
    $data = '<div class="form-group col-md-6">
    <label for="from_state">From State</label>
    <select required class="form-control" id="from_state" name="from_state"  onchange="loadDistricts(this.value)">
        <option value="">---SELECT---</option>';
    
    $states_query = mysqli_query($config, "SELECT * FROM dir_state_master");
    while($state = mysqli_fetch_object($states_query)) {
        $selected = ($state->state_id == 24) ? 'selected' : '';
        $data .= '<option value="'.$state->state_id.'" '.$selected.'>'.$state->name.'</option>';
    }
    $data .= '</select>
    </div>';

    $data .= '<div class="form-group col-md-6">
    <label for="from_district">From District</label>
    <select required class="form-control" id="from_district" name="from_district">
        <option value="">---SELECT---</option>';
    
    $districts_query = mysqli_query($config, "SELECT * FROM dir_city_master");
    while($district = mysqli_fetch_object($districts_query)) {
        $data .= '<option value="'.$district->dir_city_id.'">'.$district->dir_city_name.'</option>';
    }
    $data .= '</select>
    </div>';

    $data .= '<div class="form-group col-md-6">    
    <label for="loader_from_place"> Pick Up Place</label>
    <input type="text" class="form-control" id="loader_from_place" name="loader_from_place" placeholder="Location Name" required="">
    </div>';

   

    $data .= '<div class="form-group col-md-6">
    <label for="to_district">To District</label>
    <select required class="form-control" id="to_district" name="to_district">
        <option value="">---SELECT---</option>';
    
    $districts_query = mysqli_query($config, "SELECT * FROM dir_city_master");
    while($district = mysqli_fetch_object($districts_query)) {
        $data .= '<option value="'.$district->dir_city_id.'">'.$district->dir_city_name.'</option>';
    }
    $data .= '</select>
    </div>';

    echo $data;
}
        else{
            $data = '<div class="form-group col-md-6">
            <label for="from_state">From State</label>
            <select required class="form-control" id="from_state" name="from_state" onchange="loadDistricts(this.value)">
                <option value="">---SELECT---</option>';
            
            $states_query = mysqli_query($config, "SELECT * FROM dir_state_master");
            while($state = mysqli_fetch_object($states_query)) {
                $data .= '<option value="'.$state->state_id.'">'.$state->name.'</option>';
            }
            $data .= '</select>
            </div>';
        
            $data .= '<div class="form-group col-md-6">
            <label for="from_district">From District</label>
            <select required class="form-control" id="from_district" name="from_district">
                <option value="">---SELECT---</option>';
            
            $districts_query = mysqli_query($config, "SELECT * FROM dir_city_master");
            while($district = mysqli_fetch_object($districts_query)) {
                $data .= '<option value="'.$district->dir_city_id.'">'.$district->dir_city_name.'</option>';
            }
            $data .= '</select>
            </div>';
        
            $data .= '<div class="form-group col-md-6">    
            <label for="loader_from_place"> Pickup Place</label>
            <input type="text" class="form-control" id="loader_from_place" name="loader_from_place" placeholder="Location Name" required="">
            </div>';
        
            $data .= '<div class="form-group col-md-6">
            <label for="to_state">To State</label>
            <select required class="form-control" id="to_state" name="to_state" onchange="toloadDistricts(this.value)">
                <option value="">---SELECT---</option>';
            
            $states_query = mysqli_query($config, "SELECT * FROM dir_state_master");
            while($state = mysqli_fetch_object($states_query)) {
                $data .= '<option value="'.$state->state_id.'">'.$state->name.'</option>';
            }
            $data .= '</select>
            </div>';
        
            $data .= '<div class="form-group col-md-6">
            <label for="to_district">To District</label>
            <select required class="form-control" id="to_district" name="to_district">
                <option value="">---SELECT---</option>';
            
            $districts_query = mysqli_query($config, "SELECT * FROM dir_city_master");
            while($district = mysqli_fetch_object($districts_query)) {
                $data .= '<option value="'.$district->dir_city_id.'">'.$district->dir_city_name.'</option>';
            }
            $data .= '</select>
            </div>';
        
            echo $data;
        }
 ?>