<?php include('config/setup.php');?>

<?php
ob_start();

// Prevent multiple session starts
if (session_status() === PHP_SESSION_NONE) {
    $cookie_lifetime = 30 * 24 * 60 * 60; // 30 days in seconds (increased for better user experience)
    
    // Set session cookie parameters BEFORE session_start()
    session_set_cookie_params([
        'lifetime' => $cookie_lifetime,
        'path' => '/',
        'domain' => '', // optional: set your domain if needed
        'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on', // true if using HTTPS
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    
    // Set PHP session configuration
    ini_set('session.gc_maxlifetime', $cookie_lifetime);
    ini_set('session.cookie_lifetime', $cookie_lifetime);
    ini_set('session.cookie_httponly', 1);
    
    // Start the session
    session_start();
    
    // Regenerate session ID periodically for security (every 30 minutes)
    if (!isset($_SESSION['last_regeneration'])) {
        $_SESSION['last_regeneration'] = time();
    } elseif (time() - $_SESSION['last_regeneration'] > 1800) {
        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();
    }
}




error_reporting(0);		

// ✅ Check if session is set for a specific key
if (!isset($_SESSION['member_id'])) {
  // Session not set - user not logged in
  // Don't exit here, let pages handle their own authentication
  $prof_id = null;
  $session_id = null;
  $session__username = null;
  $session__mail = null;
  $session__phone = null;
  $session__password = null;
  $session__wallet = null;
  $c_memeber_id = 0;
} else {
  $prof_id = $_SESSION['member_id'];

  $session=mysqli_query($config,"select * from customer_master where  Customer_Id='$prof_id' ");

  if ($session && mysqli_num_rows($session) > 0) {
    $s1=mysqli_fetch_array($session);

    $session_id=$s1['Customer_Id'];
    $session__username=$s1['Customer_Name'];
    $session__mail=$s1['Customer_Mail_id'];
    $session__phone=$s1['Customer_Phone_No'];
    $session__password=$s1['Customer_Password'];
    $session__wallet=$s1['Customer_Wallet'];

    $memb_session=mysqli_query($config,"SELECT * FROM `membership_list` INNER JOIN membership ON membership_list.membership_plan_id=membership.mid where  user_id='$prof_id' ");

    if (mysqli_num_rows($memb_session) > 0) {
      $s1_=mysqli_fetch_object($memb_session);
      $date2 =$s1_->ex_date;
      $date_now = date("d-m-Y");
      $date_now = new DateTime($date_now);
      $date2  = new DateTime($date2);
      $dDiff = $date_now->diff($date2);
      $gfg= $dDiff->format('%r%a');

      if ($gfg < 0) { 
        $c_memeber_id=0;
      } else {
        $c_memeber_id=$s1_->memeber_id;
        $c_memeber_off=$s1_->re_purches_pre;
      }
    } else {
      $c_memeber_id=0;
    }
  }
}

?>