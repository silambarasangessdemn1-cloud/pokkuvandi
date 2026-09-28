<?php include('../config/setup.php');?>

<?php 


$id=$_GET['id'];

$fileName="Company business enquiry.xls";
$fromdate=date('Y-m-d H:i:s', strtotime($_GET['formdate']));
$enddate=date('Y-m-d H:i:s', strtotime($_GET['enddate']));  
		 $export_data = array();
   
         if($_GET['vid'])
                                            {
  $y="SELECT * FROM `dir_com_enq` INNER JOIN dir_com_vender_enq ON dir_com_enq.dir_com_id=dir_com_vender_enq.com_enq_id INNER JOIN dir_vender ON dir_vender.dir_vender_id=dir_com_vender_enq.com_vid where (created_at BETWEEN '$fromdate' AND '$enddate')  and dir_vender_id='".$_GET['vid']."'";
                                               
                                            }else{
  $y="SELECT * FROM `dir_com_enq` INNER JOIN dir_com_vender_enq ON dir_com_enq.dir_com_id=dir_com_vender_enq.com_enq_id INNER JOIN dir_vender ON dir_vender.dir_vender_id=dir_com_vender_enq.com_vid where (created_at BETWEEN '$fromdate' AND '$enddate')";
                                            }	
         
											$main_cate=mysqli_query($config,$y);  


			while($data=mysqli_fetch_object($main_cate))
			{

		
			$data_arr =  array(
			'Sno' => $i,
			'Date' => $data->created_at,
			'Name' => $data->com_enq_name,
			'Email' => $data->com_enq_email,
			'Phone' => $data->com_enq_phone,
			'Enquiry' => $data->com_enq_msg,
		
			
		
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
