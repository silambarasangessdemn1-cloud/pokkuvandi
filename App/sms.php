<?php

$message='Thank You for Registration with www.Callinfo.in, Your OTP,'.$_POST['id'].', Submitted Successfully';

	$key ="flvnLORNxN1wDTg9";	
$mbl=$_POST['user_ph'];	
$message_content=urlencode($message);

$senderid="CLLINF";	$route= 1;
$templateid=1207166010578795658;
echo $url = "http://bulksms.2020sms.com/vb/apikey.php?apikey=$key&senderid=$senderid&templateid=$templateid&number=$mbl&message=$message_content";
					
$output = file_get_contents($url);

?>
