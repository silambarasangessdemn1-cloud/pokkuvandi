<?php   include "../config/setup.php"; 



		$fileName =$_GET['vname'];
        $fileName .='.xls';
		 $export_data = array();
		  
		/*** Content ***/

        $main_cate = mysqli_query($config, "SELECT * FROM `biding_vender`INNER JOIN customer_master ON biding_vender.cust_id=customer_master.Customer_Id INNER JOIN biding_share_earn ON biding_share_earn.bid_vid=biding_vender.vender_id where cust_earn_id='".$_GET['did']."'");


			$i=1;
			while($data=mysqli_fetch_assoc($main_cate))
			{
              
			
			$data_arr =  array(
			'Sno' => $i,
			'created_at' => $data["created_at"],
			'Customer_Name' => $data["Customer_Name"],
            'topupamount' => $data["topupamount"],
            'Customer_Mail_id' => $data["Customer_Mail_id"],
            'Customer_Phone_No' => $data["Customer_Phone_No"],
            'Company name' => $data["c_name"],
            'Membership_title' => $data["membership_title"],
            'GST' => $data["GST"],
            'Expiry date' => $data["ex_date"],
            
		
		);

			array_push($export_data,$data_arr);

			$i++;
		
		
		}


			if($i==1)
			{
		
				$data_arr =  array(
					'Sno' => '',
					'memeber_id' => '',
					
				
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


?>

