<?php
session_start();
include('../config.php');

$response = '';

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo 'Unauthorized access.';
    exit();
}

// Handle delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Prepare the statement
    $stmt = $conn->prepare("DELETE FROM bookings WHERE id = ?");
    if ($stmt === false) {
        echo 'Error preparing statement: ' . $conn->error;
        exit();
    }
    
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $response = 'Booking deleted successfully.';
    } else {
        $response = 'Error deleting booking: ' . $conn->error;
    }
    
    $stmt->close();
}

echo $response;
?>
