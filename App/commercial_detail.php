<div class="row" style="padding: 15px;background: #faeed9;">
    <div class="form-group col-md-6">
        <label for="Add_vehicle_type">Vehicle Model Name</label>
        <div id="vt"></div>
    </div>

    <div class="form-group col-md-6">
        <label for="Add_vehicle_name">Transport Name</label>
        <input type="text" required class="form-control" id="Add_vehicle_name" name="Add_vehicle_name" placeholder="Transport Name">
    </div>

    <div class="form-group col-md-6" id="vehicle_body_type_container" style="display: none;">
        <label for="vehicle_body_type">Vehicle Body Type</label>
        <select required class="form-control" name="vehicle_body_type" id="vehicle_body_type">
            <option value="">---Select---</option>
            <option value="Open Body">Open Body</option>
            <option value="Container Body">Container Body</option>
        </select>
    </div>

    <div class="form-group col-md-6">
        <label for="Add_vehicle_no">Vehicle Registration Number</label>
        <input required type="text" class="form-control" id="Add_vehicle_no" onchange="vehicle_uni(this.value);" name="Add_vehicle_no" placeholder="Vehicle Registration Number">
        <div style="color: red;font-size: 15px;font-weight: 500;margin-top: 10px;" id="vehicle_like"></div>
    </div>

    <div class="form-group col-md-6">
        <label for="Add_RC_owner_name">RC Owner Name</label>
        <input required type="text" class="form-control" id="Add_RC_owner_name" name="Add_RC_owner_name">
    </div>

    <div class="form-group col-md-6" style="display:none">
        <label for="space">Space</label>
        <input type="text" class="form-control" id="space" name="space" placeholder="Ex: 10x20feet">
    </div>

    <div class="form-group col-md-6" style="display:none">
        <label for="size">Size</label>
        <input type="text" class="form-control" id="size" name="size" placeholder="Ex: 500Sqft">
    </div>

    <div class="form-group col-md-6">
        <label for="tonnage">Tonnage</label>
        <input required type="text" class="form-control" id="tonnage" name="tonnage" placeholder="Ex: 5 Ton">
    </div>

    <div class="form-group col-md-6">
        <label for="Add_location">Current Location Name</label>
        <input required type="text" class="form-control" id="Add_location" name="Add_location" placeholder="">
    </div>

    <div class="form-group col-md-6" style="display:none">
        <label for="Add_Registration_date">RC Registration Date</label>
        <input type="date" class="form-control" id="Add_Registration_date" name="Add_Registration_date">
    </div>

    <div class="form-group col-md-6">
        <label for="Add_insurance_exp_date">Vehicle Insurance Expiry Date</label>
        <input type="date" class="form-control" id="Add_insurance_exp_date" name="Add_insurance_exp_date">
    </div>

    <div class="form-group col-md-6" style="display:none">
        <label for="FC_date">FC Date</label>
        <input type="date" class="form-control" id="FC_date" name="FC_date">
    </div>

    <div class="form-group col-md-6">
        <label for="stand_name">Vehicle Stand Name</label>
        <input type="text" class="form-control" id="stand_name" name="stand_name" placeholder="Vehicle Stand Name">
    </div>
</div>

