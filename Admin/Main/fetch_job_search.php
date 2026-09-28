<?php include('../config/setup.php');?>

<?php

$request = $_REQUEST;

$columns = [
    0 => 'job_search_id',
    1 => 'customer_name',
    2 => 'customer_phone_no',
    3 => 'Main_Category_Name',
    4 => 'job_name',
    5 => 'experiences',
    6 => 'qualification',
    7 => 'company_name',
    8 => 'salary_range',
    9 => 'contact_no',
    10 => 'email_id',
    11 => 'licence_no',
    12 => 'vehicle_type',
    13 => 'post_date',
    14 => 'last_date',
    15 => 'address',
    16 => 'remarks',
    17 => 'amount',
    18 => 'exp_date'
];

// Fetch total records
$sql = "SELECT job_search_post.*, job_search_category.Main_Category_Name FROM job_search_post 
        LEFT JOIN job_search_category ON job_search_post.job_category_id = job_search_category.Main_Category_id 
        WHERE job_search_post.delete_id = '0'";
$query = mysqli_query($config, $sql);
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;

// Fetch filtered records
$sqlFiltered = $sql;

if (!empty($request['search']['value'])) {
    $sqlFiltered .= " AND (job_search_post.customer_name LIKE '%".$request['search']['value']."%' ";
    $sqlFiltered .= " OR job_search_post.customer_phone_no LIKE '%".$request['search']['value']."%' ";
    $sqlFiltered .= " OR job_search_category.Main_Category_Name LIKE '%".$request['search']['value']."%' ";
    $sqlFiltered .= " OR job_search_post.job_name LIKE '%".$request['search']['value']."%' ";
    $sqlFiltered .= " OR job_search_post.experiences LIKE '%".$request['search']['value']."%' ";
    $sqlFiltered .= " OR job_search_post.qualification LIKE '%".$request['search']['value']."%' ";
    $sqlFiltered .= " OR job_search_post.company_name LIKE '%".$request['search']['value']."%' ";
    $sqlFiltered .= " OR job_search_post.salary_range LIKE '%".$request['search']['value']."%' ";
    $sqlFiltered .= " OR job_search_post.contact_no LIKE '%".$request['search']['value']."%' ";
    $sqlFiltered .= " OR job_search_post.email_id LIKE '%".$request['search']['value']."%' ";
    $sqlFiltered .= " OR job_search_post.licence_no LIKE '%".$request['search']['value']."%' ";
    $sqlFiltered .= " OR job_search_post.vehicle_type LIKE '%".$request['search']['value']."%' ";
    $sqlFiltered .= " OR job_search_post.post_date LIKE '%".$request['search']['value']."%' ";
    $sqlFiltered .= " OR job_search_post.last_date LIKE '%".$request['search']['value']."%' ";
    $sqlFiltered .= " OR job_search_post.address LIKE '%".$request['search']['value']."%' ";
    $sqlFiltered .= " OR job_search_post.remarks LIKE '%".$request['search']['value']."%' ";
    $sqlFiltered .= " OR job_search_post.amount LIKE '%".$request['search']['value']."%' ";
    $sqlFiltered .= " OR job_search_post.exp_date LIKE '%".$request['search']['value']."%')";


    $queryFiltered = mysqli_query($config, $sqlFiltered);
    $totalFiltered = mysqli_num_rows($queryFiltered);
}

// Handle ordering
if (!empty($request['order'])) {
    $sqlFiltered .= " ORDER BY ".$columns[$request['order'][0]['column']]." ".$request['order'][0]['dir'];
} else {
    $sqlFiltered .= " ORDER BY job_search_post.job_search_id DESC";
}

// Handle pagination
$start = $request['start'];
$length = $request['length'];

$sqlFiltered .= " LIMIT $start, $length";

$queryFiltered = mysqli_query($config, $sqlFiltered);

$data = [];
$mc = $start + 1;

while ($row = mysqli_fetch_assoc($queryFiltered)) {
    $nestedData = [];
    $nestedData[] = $mc++;
    $nestedData[] = $row['customer_name'];
    $nestedData[] = $row['customer_phone_no'];
    $nestedData[] = $row['Main_Category_Name'];
    $nestedData[] = $row['job_name'];
    $nestedData[] = $row['experiences'];
    $nestedData[] = $row['qualification'];
    $nestedData[] = $row['company_name'];
    $nestedData[] = $row['salary_range'];
    $nestedData[] = $row['contact_no'];
    $nestedData[] = $row['email_id'];
    $nestedData[] = $row['licence_no'];
    $nestedData[] = $row['vehicle_type'];
    $nestedData[] = date('d-m-Y', strtotime($row['post_date']));
    $nestedData[] = date('d-m-Y', strtotime($row['last_date']));
    $nestedData[] = $row['address'];
    $nestedData[] = $row['remarks'];
    $nestedData[] = $row['amount'];
    $nestedData[] = date('d-m-Y', strtotime($row['exp_date']));
    $nestedData[] = '<a href="edit_job_search.php?pid='.$row['job_search_id'].'" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                     <a style="color:white" data-toggle="modal" data-target="#exampleModaldelete" onclick="deletepost('.$row['job_search_id'].')" class="btn btn-danger"><i class="fas fa-trash"></i></a>';

    $data[] = $nestedData;
}

$json_data = [
    "draw"            => intval($request['draw']),
    "recordsTotal"    => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data"            => $data
];

echo json_encode($json_data);
?>
