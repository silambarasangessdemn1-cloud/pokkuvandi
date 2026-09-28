<?php include('../config/setup.php');

$id=$_POST['id'];

?>
<?php 
$data='';
       $data .='<input  type="hidden" class="form-control" id="pack_id" name="pack_id" value="'.$id.'">';
             echo  $data;

?>
