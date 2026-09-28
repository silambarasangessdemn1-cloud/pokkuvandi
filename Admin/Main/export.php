<?php   include "../config/setup.php"; 

$f=$_GET["fromdate"];
$f1=$_GET["fromdate"];
$fromdate=date('Y-m-d H:i:s', strtotime($f));
$fromdate1=date('Y-m-d', strtotime($f1));

$tdate=$_GET['todate'];
$tdate1=$_GET['todate'];
$todate=date('Y-m-d H:i:s', strtotime($tdate));
$todate1=date('Y-m-d', strtotime($tdate1));


		$fileName="MembershipList.xls";
		  
		 $export_data = array();
		  
		/*** Content ***/
        $sql="SELECT * FROM `membership_list` WHERE (created_at BETWEEN '$fromdate' AND '$todate')";

         $result = mysqli_query($config, $sql);


			$i=1;
			while($data=mysqli_fetch_assoc($result))
			{
                $id=$data["user_id"]; 
                $csql=mysqli_query($config,"SELECT * FROM `customer_master` WHERE Customer_Id='$id'");
                 $cd=mysqli_fetch_assoc($csql);
			
			$data_arr =  array(
			'Sno' => $i,
			'Memeber_id' => $data["memeber_id"],
			'User_id' => $data["user_id"],
            'Customer_Name' => $cd["Customer_Name"],
            'Customer_Phone_No' => $cd["Customer_Phone_No"],
            'Customer_Phone_No' => $cd["Customer_Phone_No"],
            'Customer_Mail_id' => $cd["Customer_Mail_id"],
            'Membership_title' => $data["membership_title"],
            'Valid_days' => $data["valid_days"],
            'Expiry date' => $data["ex_date"],
            'Membership_amount' => $data["membership_amount"],
            'Referral code' => $data["unique_id"],
            'Join Date' => $data["created_at"],
		
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
			echo $excelData= implode("\t", array_keys($row)) . "\n";
			$flag = true;
		}
		// filter data
		array_walk($row, 'filterData');
		echo  $excelData = implode("\t", array_values($row)) . "\n";
	}
	exit;			
}


?>

