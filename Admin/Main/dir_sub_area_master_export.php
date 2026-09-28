<?php include('../config/setup.php');?>

<?php 
$id=$_GET['id'];

$fileName="Diectrory_Area.xls";
		  
		 $export_data = array();
		  
	$sql="SELECT * FROM `sub_area_master` where dirarea_id='$id'";
    $result = mysqli_query($config, $sql);
$i=1;
			while($data=mysqli_fetch_object($result))
			{

		
			$data_arr =  array(
			
			'Area_Name' => $data->sub_area_name,
			
		
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
