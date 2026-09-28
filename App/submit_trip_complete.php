<?php
header('Content-Type: application/json');
include('config/setup.php');
$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $order_id = intval($_POST['order_id']);
    $total_amount = floatval($_POST['total_amount']);
    $discount = floatval($_POST['discount']);
    $net_trip_amount = floatval($_POST['net_trip_amount']);
    $cash = floatval($_POST['cash']);
    $bank = floatval($_POST['bank']);
    $total_received = floatval($_POST['total_received']);

    // Simple validation
    if ($net_trip_amount !== ($cash + $bank)) {
        $response = [
            'status' => 'error',
            'message' => 'Received amount does not match net trip amount.'
        ];
        echo json_encode($response);
        exit;
    }

    // You can use `trip_payments` table or update the existing `orders` table
    $query = "INSERT INTO trip_payments (order_id, total_amount, discount, net_amount, cash_received, bank_received, total_received, status, created_at) 
              VALUES ($order_id, $total_amount, $discount, $net_trip_amount, $cash, $bank, $total_received, 'completed', NOW())";

    if (mysqli_query($config, $query)) {
        // Optional: mark trip as completed in orders table
        mysqli_query($config, "UPDATE orders SET status = 'completed' WHERE id = $order_id");

        $response = [
            'status' => 'success',
            'message' => 'Trip marked as completed successfully.'
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Database error: ' . mysqli_error($config)
        ];
    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'Invalid request.'
    ];
}

echo json_encode($response);
