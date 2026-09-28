<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
				
				<div class="container-fluid">
					 
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						  
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<!-- <i class="fa fa-bell"></i>
								<span class="notification">  <?php
				   $checkout=mysqli_query($config,"select count(Order_id) from order_master where   Order_status='Completed'  and Delivery_status = 'On_Progress' ");
               while($order_checkout=mysqli_fetch_array($checkout))
               {
				  
				 echo $order_checkout[0];
				  
			   }
				  
				  
				  ?>
				  </span> -->
							</a>
							<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
								
								 <li>
									<div class="notif-scroll scrollbar-outer">
										<!-- <div class="notif-center">
											
											<?php
				   $checkout1=mysqli_query($config,"select * from order_master where Order_status='Completed'  and Delivery_status = 'On_Progress' ");
               while($order_checkout1=mysqli_fetch_object($checkout1))
               { ?>
				 						<a href="order_master_on_process.php">
												<div class="notif-icon notif-primary"> <i class="fa fa-shopping-cart"></i> </div>
												<div class="notif-content">
													<span class="block">
														 User Id : <?php echo $order_checkout1->Customer_id;?>
														 Product Id : <?php echo $order_checkout1->Order_product;?></br>
														Order  Status : <?php echo $order_checkout1->Order_status;?></br>
														Delivery status : <?php echo $order_checkout1->Delivery_status;?>
													</span>
													<span class="time"><?php echo $order_checkout1->Order_on;?></span> 
												</div>
											</a>
			   <?php } ?>	 
										 
											 
										</div> -->
									</div>
								</li>
								<!-- <li>
									<a class="see-all" href="order_master_on_process.php">See all notifications<i class="fa fa-angle-right"></i> </a>
								</li> -->
							</ul>
						</li>
						 
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
									
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									 
									<li>
									
										<a class="dropdown-item" href="contact_master.php">Contact Setting</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="social_media_master.php">Social Media</a>
									<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="change_password.php">Change Password</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="../logout.php">Logout</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>