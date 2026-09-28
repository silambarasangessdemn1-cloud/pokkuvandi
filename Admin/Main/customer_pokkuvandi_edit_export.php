<?php include('../config/setup.php');?>

<?php 
 $name=$_REQUEST['where'];
// die;

$fileName="Post_report.xls";
		  
		 $export_data = array();


		//  echo $query="select * from create_post  $name";
		//  die;
		if($name !='')
		{
			$Recent_customer=mysqli_query($config,"select * from customer_pokkuvandi_entry $name ");
		}
		else{
			$Recent_customer=mysqli_query($config,"select * from customer_pokkuvandi_entry order by cus_pokkuvandi_entry_id DESC");
		}
         
                                 

		 $i=1;
                                         
                                         while($recent_cust=mysqli_fetch_object($Recent_customer))
                                         {  $i;
                                          
											$main_cate_from = mysqli_query($config, "select * from dir_city_master where dir_city_id='$macate->from_district' ");
											$addsubcate_from = mysqli_fetch_object($main_cate_from);

											$main_cate_to = mysqli_query($config, "select * from dir_city_master where dir_city_id='$macate->to_district' ");
											$addsubcate_to = mysqli_fetch_object($main_cate_to);


											$loader_to_date = $macate->from_date;
											$loader_to_time = $macate->loader_to_time;
											$loader_from_date = $macate->loader_from_date;
											$loader_from_time = $macate->loader_from_time;

											$post_id = $mac3__->post_id;

											$from_date_time = date('Y-m-d H:i', strtotime("$loader_from_date $loader_from_time"));
											$to_date_time = date('Y-m-d H:i', strtotime("$loader_to_date $loader_to_time"));

											$from_date_time__ = date('d-m-Y h:i a', strtotime("$loader_from_date $loader_from_time"));
											$to_date_time__ = date('d-m-Y h:i a', strtotime("$loader_to_date $loader_to_time"));

											date_default_timezone_set('Asia/Kolkata');
											$date_time = date('Y-m-d H:i');


											$_date = $macate->post_date;
											$post_date = date('d-m-Y', strtotime("$_date"));



											if ($macate->state == 1) { 

												$state = 'Tamil Nadu Trip';
											} else {
											$state = 'Other State Trip';
											 }



// 	$sql="select * from customer_master ORDER BY `customer_master`.`Customer_Id` DESC";
//     $result = mysqli_query($config, $sql);
// $i=1;
// 			while($data=mysqli_fetch_object($result))
// 			{

		
			$data_arr =  array(

                
                'S No' => $i,
			'Customer Name' => $macate->Customer_Name,
            'Customer Phone No' => $macate->Customer_Phone_No,
            'Vehicle Required Date' => $to_date_time,
            'State' => $state,
            'From District' => $cus_vehicle_type__->Vehicle_type_name,
            'Load Pick Up Place' =>  $recent_cust->vehicle_name,
            
            'To District' =>  $recent_cust->vehicle_no,
            'Load Delivery Place' =>  $recent_cust->Add_RC_owner_name,
            'Required Vehicle Type' => $recent_cust->tonnage,
            'Load Details' => $recent_cust->seating_capacity,
            'Create ON' => $recent_cust->facilities,
			
			
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
