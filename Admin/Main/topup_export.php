<?php include('../config/setup.php');?>

<?php 




$fileName="Topup enquiry.xls";
$fromdate=date('Y-m-d H:i:s', strtotime($_GET['formdate']));
$enddate=date('Y-m-d H:i:s', strtotime($_GET['enddate']));  
		 $export_data = array();
   
         if($_GET['formdate'] != '1970-01-01 01:00:00'){
          $bb="SELECT * FROM `biding_vender`INNER JOIN customer_master ON customer_master.Customer_Id=biding_vender.cust_id INNER JOIN bidding_vender_top ON bidding_vender_top.bidding_vender_vid=customer_master.Customer_Id
         where (createdat BETWEEN '$fromdate' AND '$enddate') ORDER BY `bidding_vender_top`.`bidding_vender_id` DESC";
         
                                                     }else{
                                                     echo     $bb="SELECT * FROM `biding_vender`INNER JOIN customer_master ON customer_master.Customer_Id=biding_vender.cust_id INNER JOIN bidding_vender_top ON bidding_vender_top.bidding_vender_vid=customer_master.Customer_Id ";
                                                     }
       
											$main_cate=mysqli_query($config,$bb);  

$i=1;
			while($data=mysqli_fetch_object($main_cate))
			{

		
			$data_arr =  array(
			'Sno' => $i,
            'Date' => $data->createdat,
            'Name' => $data->Customer_Name,
            'Email' => $data->Customer_Mail_id,
            'Phone' => $data->Customer_Phone_No,
			'Vender Amount' => $data->bidding_vender_amount,
		
			
		
		);

			array_push($export_data,$data_arr);

			$i++;
		
		
		}


			if($i==1)
			{
		
				$data_arr =  array(
					'Sno' => '',
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
