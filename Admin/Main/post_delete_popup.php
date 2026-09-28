<?php 
  $id=$_POST['id'];

?>
<!-- Include jQuery first -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<!-- Include SweetAlert2 (after jQuery) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.10/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.10/dist/sweetalert2.all.min.js"></script>
<div id="successMessage" style="display: none; color: green; font-weight: bold;"></div>
<div id="successMessage" style="display: none; color: green; font-weight: bold;"></div>

<div class="form-group col-md-12">    
                                      <label for="email2">Reason For Delete</label>
                                      <input  type="text" class="form-control" id="delete_remarks" name="delete_remarks"  >
                                    </div>
                                </div>
                                <div class="form-group">
                                  <a class="btn btn-success"  onclick="deletecheck(<?php echo $id ?>);"  name="delete_update">Delete</a>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
  <script>
      function deletecheck(id) {
        var delete_remarks = $('#delete_remarks').val();

        if (delete_remarks === '') {
            alert("Enter the remarks");
        } else {
            $.ajax({
                type: "POST",
                url: 'post_delete_insert.php',
                data: { id: id, delete_remarks: delete_remarks },
                success: function(response) {
                    // Show a custom message in a div
                    $('#successMessage').text("Delete operation was successful.").show();


                    setTimeout(function() {
                        $('#exampleModaldelete').modal('hide');
                    }, 1000);
// Hide the success message after 3 seconds (3000ms)
setTimeout(function() {
    $('#successMessage').hide();
}, 3000); // 3000 milliseconds = 3 seconds

                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            });
        }
    }
  </script>
