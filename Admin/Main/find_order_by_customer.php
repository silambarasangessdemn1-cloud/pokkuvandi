<?php
include('../config/setup.php'); 

$customer_id = $_POST['customer_id'];
$order_id = $_POST['order_id'];

$query = mysqli_query($config, "
SELECT DISTINCT
    o.id AS order_id,
    o.from_city,
    o.Add_sub_category,
    sc.Sub_Category_name,
    a1.dir_area_name AS from_city_name,
    cp.post_id AS matched_post_id
FROM orders o
INNER JOIN sub_category sc ON o.Add_sub_category = sc.Sub_Category_id
INNER JOIN dir_area_master a1 ON o.from_city = a1.dir_area_id
INNER JOIN create_post cp 
    ON cp.area_id = o.from_city 
    AND cp.subcategory_id = o.Add_sub_category 
    AND cp.customer_id = '$customer_id' 
    AND cp.delete_approval_status = 0
WHERE o.id = '$order_id'
group  by customer_id
");
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_object($query)) {
        echo "<div class='card p-2 mb-2'>";
        echo "<strong>Order ID:</strong> $row->order_id<br>";
        echo "<strong>From City:</strong> $row->from_city_name<br>";
        echo "<strong>Subcategory:</strong> $row->Sub_Category_name<br>";

        if (!empty($row->matched_post_id)) {
            echo '<button type="button"
                class="btn btn-success open-bid-modal"
                data-order-id="' . htmlspecialchars($row->order_id) . '"
                data-sub-category="' . htmlspecialchars($row->Add_sub_category) . '"
                data-customer-id="' . htmlspecialchars($customer_id) . '"
                data-toggle="modal"
                data-target="#bidModal">
                📤 Send Quote
            </button>';
        } else {
            echo "<span class='badge bg-danger mt-2'>No Matching Post</span>";
        }

        echo "</div>";
    }
} else {
    echo "<div class='alert alert-warning'>❌ No matching orders found.</div>";
}

?>
