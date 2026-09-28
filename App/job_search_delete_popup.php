<?php 
 $id=$_POST['id'];

?>

<div class="form-group col-md-6">    
                                      <label for="email2">Reason For Delete</label>
                                      <input  type="text" class="form-control" id="delete_remarks" name="delete_remarks"  >
                                    </div>
                                </div>
                                <div class="form-group">
                                  <a class="btn btn-success"  onclick="deletecheck(<?php echo $id ?>);"  name="delete_update">Delete</a>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
  <script>
     function deletecheck(id){
                    var id;

                    var delete_remarks = $('#delete_remarks').val();

                    if(delete_remarks == '')
                    {
                      alert("Enter the remarks");
                    }
                    else{
                      
                    //alert(delete_remarks);

                   //alert(id);
             
                    $.ajax({
                        type: "POST",
                        url:'job_search_delete_insert.php',
                        data: {id:id,delete_remarks:delete_remarks}, // serializes the form's elements.
                        success: function(data)
                        {	
                            //alert(data);		
                        //$('#citypopup').html(data);

                         
                        Swal.fire({
                                  position: 'center',
                                  icon: 'success',
                                  title: 'Delete Successfully',
                                  showConfirmButton: false,
                                  timer: 1500
                                  })


                                  setTimeout(function() {
                                    $('#exampleModaldelete').modal('hide');
                                    }, 1000);
                                    setTimeout(() => { 
                                            location.reload();
                                    }, 2000);
                        
                        }		
                        	
                    });	
                    
                  }

                }
  </script>
