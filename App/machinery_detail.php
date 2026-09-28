
<div class="row" style="padding: 15px;background: #faeed9;">
                                                <div class="form-group col-md-6">    
                                                 <label for="email2">Vehicle Name</label>
                                                    <div id="vt" >
                                                    </div>                                         
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="email2">Transport Name</label>
                                                    <input required type="text" class="form-control" id="Add_vehicle_name" name="Add_vehicle_name"  placeholder="Transport Name"  >
                                                </div> 

                                                   <div class="form-group col-md-6">    
                                                       <label for="email2">Vehicle Registration Number</label>
                                                       <input required type="text" class="form-control" id="Add_vehicle_no"  onchange="vehicle_uni(this.value);" name="Add_vehicle_no" placeholder="Vehicle Registration Number"  >
                                                       <div style="color: red;font-size: 15px;font-weight: 500;margin-top: 10px;" id="vehicle_like">
                                                         
                                                     </div>
                                               </div>
                                              <div class="form-group col-md-6">    
                                                       <label for="email2">RC Owner Name</label>
                                                       <input required type="text" class="form-control" id="Add_RC_owner_name" name="Add_RC_owner_name"  >
                                               </div>

                                           <div class="form-group col-md-6">    
                                                       <label for="email2">Specification (Facility)</label>
                                                       <input  required type="text" class="form-control" id="space" name="space" placeholder=""  >
                                               </div>
                                              
                                               <!-- <div class="form-group col-md-6">
                                                       <label for="exampleFormControlSelect1">Loading Capacity</label>
                                                       <select  class="form-control" name="Add_load_detail" >
                                                           <option>---SELECT---</option>
                                                           <option>Space</option>
                                                           <option>Size</option>
                                                           <option>Tonnage</option>                                              
                                                       </select>                                                            
                                               </div>  -->
                                           
                                               <div class="form-group col-md-6">    
                                                       <label for="email2"> Current Location Name</label>
                                                       <input  required type="text" class="form-control" id="Add_location" name="Add_location" placeholder=""  >
                                               </div>

                                              
                                               <div class="form-group col-md-6" style="display:none">    
                                                       <label for="email2">RC Registration Date</label>
                                                       <input  type="date" class="form-control" id="Add_Registration_date" name="Add_Registration_date"  >
                                               </div>
                                             
                                               <div class="form-group col-md-6">    
                                                       <label for="email2">Vehicle Insurance Expiry Date</label>
                                                       <input required type="date" class="form-control" id="Add_insurance_exp_date" name="Add_insurance_exp_date"  >
                                               </div>
                                               <div class="form-group col-md-6" style="display:none">    
                                                       <label for="email2">FC Date</label>
                                                       <input type="date" class="form-control" id="FC_date" name="FC_date"  >
                                               </div>
                                               <div class="form-group col-md-6">
                                               <label for="email2">Vehicle Stand Name</label>
                                               <input required type="text" class="form-control" id="stand_name" name="stand_name"  placeholder="vehicle Stand Name"  >
                                              
                                           </div> 
                                               
                                           </div>