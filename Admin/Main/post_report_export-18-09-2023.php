<?php include('../config/setup.php');?>

<?php 


$fileName="Post_report.xls";
		  
		 $export_data = array();

         $Recent_customer=mysqli_query($config,"select * from create_post order by post_id  DESC ");
                                 

		 $i=1;
                                         
                                         while($recent_cust=mysqli_fetch_object($Recent_customer))
                                         {  $i;
                                          
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
                                         
                                            $main_cate_date = strtotime($recent_cust->create_on);
                                            $main_cate_expdate = strtotime($recent_cust->expiry_date);

		  
// 	$sql="select * from customer_master ORDER BY `customer_master`.`Customer_Id` DESC";
//     $result = mysqli_query($config, $sql);
// $i=1;
// 			while($data=mysqli_fetch_object($result))
// 			{

		
			$data_arr =  array(

                
                'S No' => $i,
			'Name' => $cust___->Customer_Name,
            'Main_Category_Name' => $recent_cust__->Main_Category_Name,
            'Sub_Category_Name' => $cust__->Sub_Category_Name,
            'driver_name' =>  $recent_cust->driver_name,
            'vehicle_name' => $recent_cust->vehicle_name,
            'vehicle_no' =>  $recent_cust->vehicle_no,
            
            'create_date' =>  date('d-m-Y',$main_cate_date),
            'Exp_date' =>  date('d-m-Y',$main_cate_expdate),
            'dir_city_name' => $cus_city__->dir_city_name,
            'dir_area_name' => $cus_area__->dir_area_name,
            'sub_area_name' => $cus_sub__->sub_area_name,
			'Referred By Mobile No' =>  $recent_cust->reffered_by_phone_no,
			'Referred By Name' =>  $recent_cust->reffered_by_name,
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
