<?php include('../config/setup.php');?>

<?php 




$fileName="Bidding_Ref_Earn.xls";
$fromdate=date('Y-m-d H:i:s', strtotime($_GET['formdate']));
$enddate=date('Y-m-d H:i:s', strtotime($_GET['enddate']));  
		 $export_data = array();
   
         if($_GET['formdate'] != '1970-01-01 01:00:00'){
            $main_cate = mysqli_query($config, "SELECT * FROM `biding_vender`INNER JOIN customer_master ON biding_vender.cust_id=customer_master.Customer_Id INNER JOIN biding_share_earn ON biding_share_earn.cust_earn_id=biding_vender.cust_id where (created_a_en BETWEEN '$fromdate' AND '$enddate') ORDER BY created_a_en DESC");

        }else{
        $main_cate = mysqli_query($config, "SELECT * FROM `biding_vender`INNER JOIN customer_master ON biding_vender.cust_id=customer_master.Customer_Id INNER JOIN biding_share_earn ON biding_share_earn.cust_earn_id=biding_vender.cust_id ORDER BY created_a_en DESC");
        }
$i=1;
			while($data=mysqli_fetch_object($main_cate))
			{

		
			$data_arr =  array(
			'Sno' => $i,
            'Date' => $data->created_a_en,
            'Name' => $data->Customer_Name,
            'Email' => $data->Customer_Mail_id,
            'Phone' => $data->Customer_Phone_No,
			'Earn Amount' => $data->e_amount,
            'Company Name' => $data->c_name,
		
			
		
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
