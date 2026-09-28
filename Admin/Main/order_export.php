<?php include('../config/setup.php');?>

<?php 




$fileName="Order Export.xls";
$fromdate=date('Y-m-d H:i:s', strtotime($_GET['formdate']));
$enddate=date('Y-m-d H:i:s', strtotime($_GET['enddate']));  
		 $export_data = array();
   
         if($_GET['formdate'] != '1970-01-01 01:00:00'){
            $bb="select * from order_checkout 
            where (	Order_on BETWEEN '$fromdate' AND '$enddate') and Order_status='Completed' order by Order_on DESC";
            
         
                                                     }else{
                                                        $bb="select * from order_checkout where Order_status='Completed' order by Order_on DESC";
                                                    }
       
	$main_cate=mysqli_query($config,$bb);  

$i=1;
			while($data=mysqli_fetch_object($main_cate))
			{
				$cuname=$data->Customer_id;
                $cust_name=mysqli_query($config,"select * from customer_master where Customer_Id ='$cuname' ");
                $custom_final=mysqli_fetch_object($cust_name);
                $cust_add= $data->Customer__address_type;
            	$check_oaaderr=mysqli_query($config,"select * from customer_addresss_master where Address_id='".$cust_add."' and  Customet_id ='$cuname' ");
            $check_add=mysqli_fetch_object($check_oaaderr);	
			$vb="SELECT * FROM `order_master` where order_customer_track_id='$data->order_customer_track_id'";
			$mainloc=mysqli_query($config,$vb);
		$macate_=mysqli_fetch_object($mainloc);                                    
		
			$data_arr =  array(
			'Sno' => $i,
            'Date' => $data->Order_on,
            'Order id' => $data->order_customer_track_id,

            'Name' => $custom_final->Customer_Name,
            'Delivery  Location' =>$check_add->Complete_Address,
            'Payment Method' => $data->Payment_Mode,
			'Advance' => $macate_->advance_pay,
			'Paid Amount' => $data->Grand_total,
            'Status' => $data->Delivery_status,
		
			
		
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
