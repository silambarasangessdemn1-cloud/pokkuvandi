
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded',function(){
        document.getElementById("rzp-button1").click();
});
</script>

<form name='razorpayform' action="verify_cash.php" method="POST"  >
   	
	<input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_signature"  id="razorpay_signature" >
	  <input  type="hidden" class="form-control" name="customername" id="customername"  readonly    value="<?php echo $_GET['customername']; ?>"> 
   <input  type="hidden" class="form-control" name="customermail" id="customermail"  readonly value="<?php echo $_GET['customermail']; ?>"> 
   <input  type="hidden" class="form-control" name="customerphone" id="customerphone" readonly value="<?php echo $_GET['customerphone']; ?>"> 
     <input  type="hidden" class="form-control" name="customeraddress" id="customeraddress" readonly value="<?php echo $_GET['customeraddress']; ?>"> 
     
 <input type="hidden" class="form-control" name="trackorder" id="trackorder" readonly value="<?php echo $_GET['trackorder']; ?>"> 
  <input  type="hidden" class="form-control" name="gtotal" id="gtotal"readonly value="<?php echo $_GET['gtotal']; ?>">
  <input  type="hidden" class="form-control" name="sessionid" id="sessionid"readonly value="<?php echo $session_id; ?>">
         
		<input type='button' name='osx' value='Pay with Razorpay' id="rzp-button1" class='osx demo'   runat="server" />
		 
</form>


 
<script>
// Checkout details as a json
var options = <?php echo $json?>;

/**
 * The entire list of Checkout fields is available at
 * https://docs.razorpay.com/docs/checkout-form#checkout-fields
 */
options.handler = function (response){
    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
    document.getElementById('razorpay_signature').value = response.razorpay_signature;
    document.razorpayform.submit();
};

// Boolean whether to show image inside a white frame. (default: true)
options.theme.image_padding = false;

options.modal = {
    ondismiss: function() {
        console.log("This code runs when the popup is closed");
		
		
	<?php 
 include('../config/setup.php');
 include('../session.php');
 $adcart=mysqli_query($config,"select * from order_checkout where order_customer_track_id='".$_GET['trackorder']."' and Customer_id='$session_id' ");
	while($ac=mysqli_fetch_object($adcart))
	
	{
		if($ac->wallet_status =='Applied')
		{
		$upwal=mysqli_query($config,"update customer_master set Customer_Wallet=Customer_Wallet  + '".$ac->Wallet_Amount."' where Customer_Id='$session_id'");
 
 	$welupwal=mysqli_query($config,"update order_master set Wallet_Amount = 0 where order_customer_track_id='".$_GET['trackorder']."' and Customer_id='$session_id'");
		}
 
 
 
	?>
 window.location.href="../cart.php";

	<?php }
	
	
	?>	
	 
    },
    // Boolean indicating whether pressing escape key 
    // should close the checkout form. (default: true)
    escape: true,
    // Boolean indicating whether clicking translucent blank
    // space outside checkout form should close the form. (default: false)
    backdropclose: false
};

var rzp = new Razorpay(options);

document.getElementById('rzp-button1').onclick = function(e){
    rzp.open();
    e.preventDefault();
}
</script>