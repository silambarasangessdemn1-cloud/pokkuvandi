<?php include('../config/setup.php');?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="  <?php 

            

            $inro_logo=mysqli_query($config,"select Logo_Path,logo_status from lee_master");

            while($logo=mysqli_fetch_array($inro_logo))

            {

                 $logstatus=$logo[1];

if($logstatus == 1)

{

	

	 $ms=substr($logo[0],3);

				  echo  $ms;

	

     

}else{

    echo "../../photos/logo/no_logo.png";



}



            }

            

            ?>

            " alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span style="font-size: small;">
                            <?php 

            

            $leename=mysqli_query($config,"select Name,Name_status from lee_master");

            while($lee=mysqli_fetch_array($leename))

            {

                 $namestatus=$lee[1];

if($namestatus == 1)

{

    echo  $lee[0];

}else{

    echo "Need Name";



}



            }

            

            ?>
                            <span class="user-level">Administrator</span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item active">
                    <a href="dashboard.php">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Site Master</h4>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#maps">
                        <i class="fas fa-lock"></i>
                        <p>CMS Management</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="maps">
                        <ul class="nav nav-collapse">
                            <!-- <li>
                                <a href="intro_master.php">
                                    <span class="sub-item">Intro Master</span>
                                </a>
                            </li> -->
                            <!-- <li>
                                <a href="landing_master.php">
                                    <span class="sub-item">Landing Page</span>
                                </a>
                            </li> -->
                            <li>
                                <a href="contact_master.php">
                                    <span class="sub-item">Contact Us</span>
                                </a>
                            </li>
                        
                            <!-- <li>
                                <a href="logo_name_Master.php">
                                    <span class="sub-item">Logo Change</span>
                                </a>
                            </li> -->
                            <li>
                                <a href="TC_Master.php">
                                    <span class="sub-item">Terms & Condition</span>
                                </a>
                            </li>
                            <li>
                                <a href="about_us.php">
                                    <span class="sub-item">About us</span>
                                </a>
                            </li>
                            <li>
                                <a href="Privacy.php">
                                    <span class="sub-item">Privacy Policy</span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="delivery_policy.php">
                                    <span class="sub-item">Delivery Policy</span>
                                </a>
                            </li>
                            <li>
                                <a href="RFmaster.php">
                                    <span class="sub-item">Refund Policy</span>
                                </a>
                            </li> -->
                        </ul>
                    </div>
                </li>
                <!-- <li class="nav-item">
                    <a data-toggle="collapse" href="#app1">
                        <i class="fa fa-money"></i>
                        <p>Services</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="app1">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="biding_slide.php">
                                    <span class="sub-item"> Category Master</span>
                                </a>
                            </li>
                            <li>
                                <a href="biding_slider_img.php">
                                    <span class="sub-item">Slider Master</span>
                                </a>
                            </li>
                            <li>
                                <a href="city_master.php">
                                    <span class="sub-item">City Master</span>
                                </a>
                            </li>

                            <li>
                                <a href="area_master.php">
                                    <span class="sub-item">Area Master</span>
                                </a>
                            </li>
                            <li>
                                <a href="biding_keyword.php">
                                    <span class="sub-item">Services Keyword</span>
                                </a>
                            </li>
                            <li>
                                <a href="subkeyword.php">
                                    <span class="sub-item">Sub Keywords</span>
                                </a>
                            </li>
                            <li>
                                <a href="package.php">
                                    <span class="sub-item">Services Package</span>
                                </a>
                            </li>
                            <li>
                                <a href="biding_re.php">
                                    <span class="sub-item">Services Referral</span>
                                </a>
                            </li>
                            <li>
                                <a href="biding_enq.php">
                                    <span class="sub-item">Services enquiry</span>
                                </a>
                            </li>
                            <li>
                                <a href="biding_ven.php">
                                    <span class="sub-item">Services Vender</span>
                                </a>
                            </li>
                            <li>
                                <a href="biding_de.php">
                                    <span class="sub-item">Services Details</span>
                                </a>
                            </li>
                            <li>
                                <a href="biding_report.php">
                                    <span class="sub-item">Services Report</span>
                                </a>
                            </li>
                            <li>
                                <a href="biding_ref_earn.php">
                                    <span class="sub-item">Services Ref Earn</span>
                                </a>
                            </li>
                            <li>
                                <a href="topup_report.php">
                                    <span class="sub-item">Topup Report</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> -->
                
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Vehicle directory</h4>
                </li>
                <li class="nav-item">
                    <a href="dir_slider_img.php"> <i class='fas fa-angle-right'></i>
                        <span class="sub-item">Slider Management</span>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="intro_master.php"> <i class='fas fa-angle-right'></i>
                        <span class="sub-item">Intro Master</span>
                    </a>
                </li> -->
                    <!-- <li class="nav-item">
                                <a href="landing_master.php"><i class='fas fa-angle-right'></i>
                                    <span class="sub-item">Landing Page</span>
                                </a>
                            </li> -->
                            <!-- <li class="nav-item" >
                                <a href="contact_master.php"><i class='fas fa-angle-right'></i>
                                    <span class="sub-item">Site Contact </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="logo_name_Master.php"><i class='fas fa-angle-right'></i>
                                    <span class="sub-item">Logo Change</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="TC_Master.php"><i class='fas fa-angle-right'></i>
                                    <span class="sub-item">Terms & Condition</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="about_us.php"><i class='fas fa-angle-right'></i>
                                    <span class="sub-item">About us</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="Privacy.php"><i class='fas fa-angle-right'></i>
                                    <span class="sub-item">Privacy Policy</span>
                                </a>
                            </li> -->
                            <!-- <li>
                                <a href="delivery_policy.php"><i class='fas fa-angle-right'></i>
                                    <span class="sub-item">Delivery Policy</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="RFmaster.php"><i class='fas fa-angle-right'></i>
                                    <span class="sub-item">Refund Policy</span>
                                </a>
                            </li> -->
                            <!-- <li>
                                <a href="Customer_Master.php">
                                    <span class="sub-item">Customer Master</span>
                                </a>
                            </li> -->
                            <li class="nav-item">
                    <a href="Customer_Master.php"> <i class='fas fa-angle-right'></i>
                        <span class="sub-item">Customer Master </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="category_Master.php"> <i class='fas fa-angle-right'></i>
                        <span class="sub-item">Category </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="sub_category_Master.php"> <i class='fas fa-angle-right'></i>
                        <span class="sub-item">Sub Category </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="vehicle_type.php"> <i class='fas fa-angle-right'></i>
                        <span class="sub-item">Vehicle Type Master </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="create_post.php"> <i class='fas fa-angle-right'></i>
                        <span class="sub-item">Create Registration</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="dir_city_master.php"> <i class='fas fa-angle-right'></i>
                        <span class="sub-item">District Master</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="dir_area_master.php"> <i class='fas fa-angle-right'></i>
                        <span class="sub-item">City Master</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="sub_area_master.php"> <i class='fas fa-angle-right'></i>
                        <span class="sub-item">Area Master</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="post_report.php"> <i class='fas fa-angle-right'></i>
                        <span class="sub-item">Registration Report</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="expiry_report.php"> <i class='fas fa-angle-right'></i>
                        <span class="sub-item">Expiry Report</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="renewal_report.php"> <i class='fas fa-angle-right'></i>
                        <span class="sub-item">Registration Renewal Report</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="coupon_master.php"> <i class='fas fa-angle-right'></i>
                        <span class="sub-item">Customer Coupon</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="delete_approval.php"> <i class='fas fa-angle-right'></i>
                        <span class="sub-item">Delete Approval</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="delete_approval_report.php"> <i class='fas fa-angle-right'></i>
                        <span class="sub-item">Approval Report</span>
                    </a>
                </li>
                
                <!-- <li class="nav-item">
                    <a href="dir_bussness_ref.php"> <i class='fas fa-angle-right'></i>
                        <span class="sub-item"> Business Referral </span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="dir_city_master.php"> <i class='fas fa-angle-right'></i>
                        <span class="sub-item">City Master</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="dir_area_master.php"> <i class='fas fa-angle-right'></i>
                        <span class="sub-item">Area Master</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="dir_keyword.php"> <i class='fas fa-angle-right'></i>
                        <span class="sub-item">Directory Keyword</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="dir_key_slider.php"> <i class='fas fa-angle-right'></i>
                        <span class="sub-item"> Keyword Slider</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="dir_enq.php"> <i class='fas fa-angle-right'></i>
                        <span class="sub-item">Directory Enquiry</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="addbussness.php"> <i class='fas fa-angle-right'></i>
                        <span class="sub-item"> Add Business</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="bussness_list.php">
                        <i class='fas fa-angle-right'></i>
                        <span class="sub-item"> Business Active</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="bussness_inactive.php">
                        <i class='fas fa-angle-right'></i>
                        <span class="sub-item"> Business IN-Active </span>
                    </a>
                </li> -->
                <!-- <li>

<a href="dir_bussness_enq.php">

	<span class="sub-item"> Business Enquiry</span>

</a>

</li> -->
                <!-- <li class="nav-item">
                    <a href="Direct_bussness_enq.php">
                        <i class="fa fa-bar-chart-o"></i>
                        <span class="sub-item"> Direct Enquiry</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="bussness_review.php">
                        <i class="fa fa-bar-chart-o"></i>
                        <span class="sub-item"> Business Review</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="notification.php">
                        <i class="fa fa-bell"></i>
                        <span class="sub-item"> NOTIFICATION (SUPPORT)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="dir_help.php">
                        <i class="fa fa-bullhorn"></i>
                        <span class="sub-item"> Help (SUPPORT)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="dir_filter.php">
                        <i class="fa fa-calendar-o"></i>
                        <span class="sub-item"> Business Report</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="enq_filter.php">
                        <i class="fa fa-bookmark"></i>
                        <span class="sub-item">Company Enquiry Report</span>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-percent"></i>
                    </span>
                    <h4 class="text-section">Customer Master</h4>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#custom">
                        <i class="fas fa-users"></i>
                        <p>Customer & Review Master</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="custom">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="Customer_Master.php">
                                    <span class="sub-item">Customer</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Payment Master</h4>
                </li> -->
                <!-- <li class="nav-item">
                    <a href="Online_Payment_api.php">
                        <i class="fa fa-money-bill"></i>
                        <p>Payment Settings</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="online_transaction.php">
                        <i class="fa fa-money-bill"></i>
                        <p>online Payment</p>
                    </a>
                </li> -->
                <!-- <li class="nav-item">
                    <a href="payout_setting.php">
                        <i class="fa fa-money-bill"></i>
                        <p>Payout Setting</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="payout_request.php">
                        <i class="fa fa-money-bill"></i>
                        <p>Payout Request</p>
                    </a>
                </li>
                </li> -->
                <!-- <li class="nav-item">
                    <a href="delivery_out.php">
                        <i class="fa fa-refresh"></i>
                        <p>Minimum Order</p>
                    </a>
                </li> -->
            </ul>
        </div>
    </div>
</div>