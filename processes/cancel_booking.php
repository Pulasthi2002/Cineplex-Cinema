<?php
include '../config.php';

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        echo "Error: User not logged in.";
        exit();
    }

    $userId = $_SESSION['user_id'];
    $bookingId = $_POST['bookingId'];

    // Fetch the seat ID and update its availability
    $conn->begin_transaction(); // Start a transaction
    try {
        // Get seat ID for the booking
        $sql = "SELECT seat_id FROM bookings WHERE id = ? AND user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $bookingId, $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("No booking found or not authorized to cancel this booking.");
        }

        $seat = $result->fetch_assoc();
        $seatId = $seat['seat_id'];

        // Delete the booking
        $deleteSql = "DELETE FROM bookings WHERE id = ? AND user_id = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("ii", $bookingId, $userId);
        $deleteStmt->execute();

        // Mark the seat as available
        $updateSql = "UPDATE seats SET available = 1 WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("i", $seatId);
        $updateStmt->execute();

        $conn->commit(); // Commit transaction
        echo "Booking canceled successfully.";
    } catch (Exception $e) {
        $conn->rollback(); // Rollback on error
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
