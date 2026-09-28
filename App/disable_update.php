<?php include('config/setup.php');

$id=$_POST['id'];

?>
<!-- Modal -->
<?php 
$data='';
$data .='<div class="form-group col-md-6">

<label for="exampleFormControlSelect1">Status</label>
    <select required class="form-control" id="diable_status" name="diable_status">';
     
        $data.= '<option value="0"> Enable</option>';
        $data.= '<option value="1"> Disable</option>';
                                                                            
    $data.='</select></div>';

    $data.='<div>';
    $data.='<input type="hidden" class="form-control" value="'.$id .'" name="post_id" id="post_id"';
    $data.='</div>';


echo  $data;
?>

<script>
      $('#city').on('change', function() {
              
                var id =this.value;
                var kmid =$('#kmid').val();
            
            $.ajax({
                type: "POST",
                url: "area_post.php",
                data:{id:id,kmid:kmid}, 
                success: function(data)
                {
                  
                $('#area').html(data);

                console.log(data);
                }
            });
            });

            
    
function disablecheck() {
        // $('#exampleModal').modal('show');

        // var city = $('#city').val();
        var diable_status = $('#diable_status').val();
        var post_id = $('#post_id').val();
        $.ajax({
            type: "POST",
            url: 'disable_update_insert.php',
            data: {
              diable_status: diable_status,             
              post_id:post_id
             
            },
            success: function(data) {
             // alert(data);
            if(data == 1)
            {
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Status Updated',
                showConfirmButton: false,
                timer: 1500
                })

                    
                //   $(".alertreg").attr("style", "display: block;padding:20px;");
                //   $(".alertreg").delay(1000).fadeOut(500);
                
                //   $('.msgreg').html("Status Updated ");           

                  // setTimeout(function() {
                  //   $('#exampleModalupdate').modal('hide');
                  //   }, 1000);
                  setTimeout(() => { 
                      location.reload();
              }, 2000);
              

            }
            //$("#exampleModalupdate").hide();
            $('#exampleModaldiable').dialog('close');

         

            }
            
        }); 
 
 
   
    }


    </script>