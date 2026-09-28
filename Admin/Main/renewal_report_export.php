<?php include('../config/setup.php');?>

<?php 


$fileName="Post_report.xls";
		  
		 $export_data = array();


		//  echo $query="select * from create_post  $name";
		$from_date = $_GET['from_date'];
		$to_date = $_GET['to_date'];
		$main_category = $_GET['main_cate_Name'];
		$district = $_GET['district'];
		$city = $_GET['city'];
		$area = $_GET['area'];
		$state = $_GET['state']; // Added state filter
		
		// Base query
		$query = "SELECT * FROM create_post 
          INNER JOIN renewal_list ON renewal_list.post_id = create_post.post_id ";
		
		// Apply filters  
		
		// Apply date range filter
		if (!empty($from_date) && !empty($to_date)) {
		  $query .= " AND expiry_date BETWEEN '$from_date' AND '$to_date'";
		} 
		if ($main_category != '' && $main_category != '0') {
			$query .= " AND category_id = '$main_category'";
		}
		if ($district != '' && $district != '0') {
			$query .= " AND city_id = '$district'";
		}
		if ($city != '') {
			$query .= " AND area_id = '$city'";
		}
		if ($area != '') {
			$query .= " AND sub_area_id = '$area'";
		}
		if ($state != '' && $state != 0) { // Applying state filter
			$query .= " AND state_id = '$state'";
		}
		if (!empty($_GET['search_input'])) {
			$search_value = mysqli_real_escape_string($config, $_GET['search_input']);
			$query .= " AND (create_post.driver_name LIKE '%$search_value%' 
							  OR create_post.vehicle_no LIKE '%$search_value%'
							  OR create_post.phone_no LIKE '%$search_value%'
							  OR create_post.whatsapp_no LIKE '%$search_value%')";
		}
		if (isset($_GET['view_all'])) {
			// Get all records without pagination
		  
			// Fetch all records without LIMIT
			$query = mysqli_query($config, "select * from create_post  inner join renewal_list on renewal_list.post_id = create_post.post_id  WHERE 1");
		}
	  $query .= " ORDER BY create_post.post_id DESC";

		// Run the query with the filters applied
		$Recent_customer = mysqli_query($config, $query);
		
		
                                 

		 $i=1;
                                         
                                         while($recent_cust=mysqli_fetch_object($Recent_customer))
                                         {  $i;
                                          
                                           // echo $query="select * from post_main_category where Main_Category_id='$recent_cust->main_cate_id' order by Main_Category_id  DESC";
                                         // echo $query="select * from post_main_category where Main_Category_id='$recent_cust->main_cate_id' order by Main_Category_id  DESC";
										 $Recent_customer_=mysqli_query($config,"select * from main_category where  Main_Category_id='$recent_cust->category_id' order by Main_Category_id  DESC ");
										 $recent_cust__=mysqli_fetch_object($Recent_customer_);

										 $customer_=mysqli_query($config,"select * from sub_category where  Sub_Category_id='$recent_cust->subcategory_id' order by Sub_Category_id  DESC ");
										 $cust__=mysqli_fetch_object($customer_);

										   $cus_=mysqli_query($config,"select * from customer_master where Customer_Phone_No='$recent_cust->phone_no' ");
										 $cust___=mysqli_fetch_object($cus_);

										 $cus_city=mysqli_query($config,"select * from dir_city_master where dir_city_id='$recent_cust->city_id' ");
										 $cus_city__=mysqli_fetch_object($cus_city);

										 $cus_area=mysqli_query($config,"select * from dir_area_master where dir_area_id='$recent_cust->area_id' ");
										 $cus_area__=mysqli_fetch_object($cus_area);

										 $cus_sub=mysqli_query($config,"select * from sub_area_master where sub_area_id='$recent_cust->sub_area_id' ");
										 $cus_sub__=mysqli_fetch_object($cus_sub);


										 $cus_=mysqli_query($config,"select * from customer_master where Customer_Phone_No='$recent_cust->phone_no' ");
										 $cust___=mysqli_fetch_object($cus_);

										 $cus_package_name=mysqli_query($config,"select * from category_package where package_id ='$recent_cust->package_id ' ");
										 $cust_package_name_=mysqli_fetch_object($cus_package_name);



										 $cus_vehicle_type=mysqli_query($config,"select * from vehicle_type where Vehicle_type_id='$recent_cust->vehicle_type_id' ");
										 $cus_vehicle_type__=mysqli_fetch_object($cus_vehicle_type);


										 $Add_insurance_exp_date = strtotime($recent_cust->Add_insurance_exp_date);
										 $loader_from_date = strtotime($recent_cust->loader_from_date);
										 $loader_to_date = strtotime($recent_cust->loader_to_date);
										 $create_on = strtotime($recent_cust->create_on);
										 $expiry_date = strtotime($recent_cust->expiry_date);
										 


// 	$sql="select * from customer_master ORDER BY `customer_master`.`Customer_Id` DESC";
//     $result = mysqli_query($config, $sql);
// $i=1;
// 			while($data=mysqli_fetch_object($result))
// 			{

		
			$data_arr =  array(

                
                'S No' => $i,
			'Customer' => $recent_cust->driver_name,
            'Phone No' => $recent_cust->phone_no,
            'Category' => $recent_cust__->Main_Category_Name,
            'Sub category' =>  $cust__->Sub_Category_Name,
            'Vehicle Type' => $cus_vehicle_type__->Vehicle_type_name,
            'Vehicle Name' =>  $recent_cust->vehicle_name,
            
            'Vehicle RC No' =>  $recent_cust->vehicle_no,
            'RC Name' =>  $recent_cust->Add_RC_owner_name,
            'Tonage' => $recent_cust->tonnage,
            'Seating' => $recent_cust->seating_capacity,
            'Facilities' => $recent_cust->facilities,
			'Specification' =>$recent_cust->space,
			'Active Location' => $recent_cust->Add_location,

			'Insurance Expiry' =>  date('d-m-Y',$Add_insurance_exp_date),
            'Stand Name' =>$recent_cust->stand_name,
            'Shop Name' => $recent_cust->shop_name,
            'Shop Address' => $recent_cust->shop_address,
			'Work Nature' =>  $recent_cust->work_nature,
			'Loader from Date' =>  date('d-m-Y',$loader_from_date),

			'Loader to Date' =>  date('d-m-Y',$loader_to_date),
            'Loader from Place' => $recent_cust->loader_from_place,
            'Loader to Place' => $recent_cust->loader_to_place,
            // 'Photo' => $recent_cust->sub_area_name,
			'Whatsapp No' =>  $recent_cust->whatsapp_no,
			'District' =>  $cus_city__->dir_city_name,

			'City' =>  $cus_area__->dir_area_name,
            'Area' => $cus_sub__->sub_area_name,
			'Create On' =>  date('d-m-Y',$create_on),
           
            'Expiry Date' =>  date('d-m-Y',$expiry_date),
			'Referred By Mobile No' =>  $recent_cust->reffered_by_phone_no,
			'Referred By Name' =>  $recent_cust->reffered_by_name,

			'Package Name' =>  $cust_package_name_->package_title,
            'Package Valied Days' => $recent_cust->package_days,
            'Coupon Type' => $recent_cust->coupon_type,
            'Coupon Name' => $recent_cust->discount_name,
			'Discount Amount' =>  $recent_cust->discount_amount,
			// 'Payment Type' =>  $recent_cust->payment_type,
			'Amount' =>  $recent_cust->package_amount,


			
		);

			array_push($export_data,$data_arr);

			$i++;
		
		
		}


			if($i==1)
			{
		
				$data_arr =  array(
					
					'Area_Name' => '',
				
				
				);

				array_push($export_data,$data_arr);
		
		}


		/*** Content ***/

	
	if ($export_data) {
	function filterData(&$str) {
		$str = preg_replace("/\t/", "\\t", $str);
		$str = preg_replace("/\r?\n/", "\\n", $str);
		if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
	}

	// headers for download
	
	header("Content-Disposition: attachment; filename=\"$fileName\"");
	header("Content-Type: application/vnd.ms-excel");

	$flag = false;
	foreach($export_data as $row) {
		if(!$flag) {
			// display column names as first row
			echo implode("\t", array_keys($row)) . "\n";
			$flag = true;
		}
		// filter data
		array_walk($row, 'filterData');
		echo implode("\t", array_values($row)) . "\n";
	}
	exit;			
}
