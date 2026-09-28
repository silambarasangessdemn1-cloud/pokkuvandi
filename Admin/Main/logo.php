
<?php include('../config/setup.php');?>
<div class="logo-header" data-background-color="blue">
				
				<a href="#" class="logo">
					<img src="<?php 
            
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
            
            ?>" style="
    width:50px;
    height: 40px;
"    alt="navbar brand" class="navbar-brand">
			<span style="
    color: aliceblue;font-size: small;
">	<?php 
            
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
            
            ?></span> </a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>