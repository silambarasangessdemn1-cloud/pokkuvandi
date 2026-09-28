<?php include('../config/setup.php'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="  <?php



                                $inro_logo = mysqli_query($config, "select Logo_Path,logo_status from lee_master");

                                while ($logo = mysqli_fetch_array($inro_logo)) {

                                    $logstatus = $logo[1];

                                    if ($logstatus == 1) {



                                        $ms = substr($logo[0], 3);

                                        echo  $ms;
                                    } else {

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



                            $leename = mysqli_query($config, "select Name,Name_status from lee_master");

                            while ($lee = mysqli_fetch_array($leename)) {

                                $namestatus = $lee[1];

                                if ($namestatus == 1) {

                                    echo  $lee[0];
                                } else {

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
                            <li>
                                <a href="RFmaster.php">
                                    <span class="sub-item">Refund Policy</span>
                                </a>
                            </li>
                            <li>
                                <a href="front_content.php">
                                    <span class="sub-item">Popup Message </span>
                                </a>
                            </li>

                            <li>
                                <a href="copy_right.php">
                                    <span class="sub-item">Copy Right</span>
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


                <li class="nav-item">
                    <a data-toggle="collapse" href="#maps1">
                        <i class="fas fa-lock"></i>
                        <p>Master</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="maps1">
                        <ul class="nav nav-collapse">

                            <li class="nav-item">
                                <a href="dir_slider_img.php">
                                    <!-- <i class='fas fa-angle-right'></i> -->
                                    <span class="sub-item">Slider Management</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="Customer_Master.php">
                                    <!-- <i class='fas fa-angle-right'></i> -->
                                    <span class="sub-item">Customer Master </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="category_Master.php">
                                    <!-- <i class='fas fa-angle-right'></i> -->
                                    <span class="sub-item">Category </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="sub_category_Master.php">
                                    <!-- <i class='fas fa-angle-right'></i> -->
                                    <span class="sub-item">Sub Category </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="vehicle_type.php">
                                    <!-- <i class='fas fa-angle-right'></i> -->
                                    <span class="sub-item">Vehicle Type Master </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="dir_state_master.php">
                                    <!-- <i class='fas fa-angle-right'></i> -->
                                    <span class="sub-item">State Master</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="dir_city_master.php">
                                    <!-- <i class='fas fa-angle-right'></i> -->
                                    <span class="sub-item">District Master</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="dir_area_master.php">
                                    <!-- <i class='fas fa-angle-right'></i> -->
                                    <span class="sub-item">City Master</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="sub_area_master.php">
                                    <!-- <i class='fas fa-angle-right'></i> -->
                                    <span class="sub-item">Area Master</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="coupon_master.php">
                                    <!-- <i class='fas fa-angle-right'></i> -->
                                    <span class="sub-item">Customer Coupon</span>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="video_youtube.php">
                                    <!-- <i class='fas fa-angle-right'></i> -->
                                    <span class="sub-item">Youtube Video </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="common_messages.php">
                                    <!-- <i class='fas fa-angle-right'></i> -->
                                    <span class="sub-item">Common Messages</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="comman_notification_messages.php">
                                    <!-- <i class='fas fa-angle-right'></i> -->
                                    <span class="sub-item">Notification Messages</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="job_search_category.php">
                                    <!-- <i class='fas fa-angle-right'></i> -->
                                    <span class="sub-item">Job Search Category </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="offers_page.php">
                                    <!-- <i class='fas fa-angle-right'></i> -->
                                    <span class="sub-item">Offers Page </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="short_cut.php">
                                    <!-- <i class='fas fa-angle-right'></i> -->
                                    <span class="sub-item">Short Cuts </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>



                <li class="nav-item">
                    <a data-toggle="collapse" href="#maps2">
                        <i class="fas fa-lock"></i>
                        <p>Registration</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="maps2">
                        <ul class="nav nav-collapse">


                            <li class="nav-item">
                                <a href="create_post.php">
                                    <!-- <i class='fas fa-angle-right'></i> -->
                                    <span class="sub-item">Create Registration</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="job_search_list.php">

                                    <span class="sub-item">Job Search Registration</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="driver_wanted.php">

                                    <span class="sub-item">Driver Wanted</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <!-- <a href="ad_exp_post.php">  -->
                                <a href="expired_list.php?expired=1">
                                    <!-- <i class='fas fa-angle-right'></i> -->
                                    <span class="sub-item">Expired List & Registration Renewal</span>
                                </a>
                            </li>






                            <li class="nav-item">
                                <a href="delete_approval.php">
                                    <!-- <i class='fas fa-angle-right'></i> -->
                                    <span class="sub-item">Delete Approval</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="pokkuvandi_entry_edit.php">
                                    <!-- <i class='fas fa-angle-right'></i> -->
                                    <span class="sub-item">Driver Return Trip Entry </span>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="customer_pokkuvadi_edit.php">
                                    <!-- <i class='fas fa-angle-right'></i> -->
                                    <span class="sub-item">Customer Vehicle Required Entry </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="order_deatiles.php">
                                    <!-- <i class='fas fa-angle-right'></i> -->
                                    <span class="sub-item"> Vehicle Booking Entry </span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>








                <li class="nav-item">
                    <a data-toggle="collapse" href="#maps3">
                        <i class="fas fa-lock"></i>
                        <p>Report</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="maps3">
                        <ul class="nav nav-collapse">


                </li>


                <li class="nav-item">
                    <a href="post_report.php">
                        <!-- <i class='fas fa-angle-right'></i> -->
                        <span class="sub-item">Registration Report</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="expiry_report.php">
                        <!-- <i class='fas fa-angle-right'></i> -->
                        <span class="sub-item">Expiry Report</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="renewal_report.php">
                        <!-- <i class='fas fa-angle-right'></i> -->
                        <span class="sub-item"> Renewal Completed Report</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="ad_renewal_list.php">
                        <!-- <i class='fas fa-angle-right'></i> -->
                        <span class="sub-item">Registration Renewal List</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="delete_approval_report.php">
                        <!-- <i class='fas fa-angle-right'></i> -->
                        <span class="sub-item">Registration Deleted Report</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="call_count_page.php">
                        <!-- <i class='fas fa-angle-right'></i> -->
                        <span class="sub-item">Call Count - Report</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="online_booking.php">
                        <!-- <i class='fas fa-angle-right'></i> -->
                        <span class="sub-item">Online Booking Report</span>
                    </a>
                </li>


            </ul>
        </div>
        </li>


        </ul>
    </div>
</div>
</div>