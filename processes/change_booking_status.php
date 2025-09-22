<?php
session_start();
include('../config.php');

$response = ['success' => false, 'message' => ''];

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    $response['message'] = 'Unauthorized access.';
    echo json_encode($response);
    exit();
}

// Handle status change
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = $_POST['booking_id'];
    $new_status = $_POST['new_status'];

    // Prepare the statement
    $stmt = $conn->prepare("UPDATE bookings SET status = ? WHERE id = ?");
    if ($stmt === false) {
        $response['message'] = 'Error preparing statement: ' . $conn->error;
        echo json_encode($response);
        exit();
    }
    
    $stmt->bind_param("si", $new_status, $booking_id);
    
    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Booking status updated successfully.';
    } else {
        $response['message'] = 'Error updating status: ' . $conn->error;
    }
    
    $stmt->close();
}

echo json_encode($response);
?>
