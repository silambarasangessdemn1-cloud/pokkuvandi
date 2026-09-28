<?php include('../config/setup.php');?>

<?php 


$fileName="Customer_master.xls";
		  
		 $export_data = array();
		 $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
										
		 // Create the search query based on the search term
		 $searchQuery = "";
		 if (!empty($searchTerm)) {
			 $searchQuery = "WHERE Customer_Name LIKE '%" . mysqli_real_escape_string($config, $searchTerm) . "%' 
							 OR Customer_Fathername LIKE '%" . mysqli_real_escape_string($config, $searchTerm) . "%' 
																						 OR Customer_Phone_No LIKE '%" . mysqli_real_escape_string($config, $searchTerm) . "%' 

							 OR Customer_Mail_id LIKE '%" . mysqli_real_escape_string($config, $searchTerm) . "%'"; // Add more columns if necessary
		 
		 
						 }
	$sql="select * from customer_master $searchQuery ORDER BY `customer_master`.`Customer_Id` DESC";
    $result = mysqli_query($config, $sql);
$i=1;
			while($data=mysqli_fetch_object($result))
			{
				$main_cate_state=mysqli_query($config,"select * from dir_state_master where state_id ='$data->state_id' ");
				$addsubcate_state__=mysqli_fetch_object($main_cate_state);

				$main_cate_dis=mysqli_query($config,"select * from dir_city_master where dir_city_id ='$data->Add_city' ");
				$addsubcate_dis__=mysqli_fetch_object($main_cate_dis);

				$main_cate_area=mysqli_query($config,"select * from dir_area_master where dir_area_id ='$data->Add_area' ");
				$addsubcate_area__=mysqli_fetch_object($main_cate_area);
				$edon= $data->Customer_Registred_on;

				$enablestatus=$macate->Customer_Active_Status;
													
				if($enablestatus== 0)
				{ 
			$status= 'Active';
													
				}
				else{
				
					$status= 'In-Active';
					
				}
													
				$main_cate_date = strtotime($edon);
$rc_date = date('d-m-Y',$main_cate_date);
		
			$data_arr =  array(
                'S No' => $i,
			'Name' => $data->Customer_Name,
			'Father Name' => $data->Customer_Fathername,
			'DOB' => $data->Customer_DOB,
			'Address' => $data->Customer_Address,
			'State'=> $addsubcate_state__->name,
			'District' => $addsubcate_dis__->dir_city_name,			
			'City' => $addsubcate_area__->dir_area_name,
            'Phone_No' => $data->Customer_Phone_No,
			'Email' => $data->Customer_Mail_id,
            'Password' => $data->Customer_Password,
            'Register Date' => $rc_date,
			'Status' => $status,
			
		
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
