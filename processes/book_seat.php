<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        echo "Error: User not logged in.";
        exit();
    }

    $userId = $_SESSION['user_id'];
    $movieId = $_POST['movieId'];
    $showtimeId = $_POST['showtimeId'];
    $seatIds = $_POST['seatIds'];
    $totalPrice = $_POST['totalPrice'];

    $conn->begin_transaction(); // Start a transaction

    try {
        foreach ($seatIds as $seatId) {
            // Lock the seat to prevent other users from selecting it
            $lockSeatSql = "SELECT available FROM seats WHERE id = ? FOR UPDATE";
            $lockSeatStmt = $conn->prepare($lockSeatSql);
            $lockSeatStmt->bind_param("i", $seatId);
            $lockSeatStmt->execute();

            $lockResult = $lockSeatStmt->get_result();
            if ($lockResult->num_rows === 0 || $lockResult->fetch_assoc()['available'] == 0) {
                throw new Exception("Seat ID $seatId is no longer available.");
            }

            // Check if the seat has already been booked by the user for this showtime
            $existingBookingCheckSql = "SELECT * FROM bookings WHERE user_id = ? AND showtime_id = ? AND seat_id = ?";
            $existingBookingCheckStmt = $conn->prepare($existingBookingCheckSql);
            $existingBookingCheckStmt->bind_param("iii", $userId, $showtimeId, $seatId);
            $existingBookingCheckStmt->execute();
            $existingBookingResult = $existingBookingCheckStmt->get_result();

            if ($existingBookingResult->num_rows > 0) {
                throw new Exception("You have already booked Seat ID $seatId for this showtime.");
            }

            // Insert booking record
            $sql = "INSERT INTO bookings (user_id, showtime_id, seat_id, total_price, status) 
                    VALUES (?, ?, ?, ?, 'Pending')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iiid", $userId, $showtimeId, $seatId, $totalPrice);
            $stmt->execute();

            // Mark the seat as unavailable
            $updateSql = "UPDATE seats SET available = 0 WHERE id = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("i", $seatId);
            $updateStmt->execute();
        }

        $conn->commit(); // Commit the transaction
        echo "Booking successful!";
    } catch (Exception $e) {
        $conn->rollback(); // Rollback the transaction on error
        echo "Booking failed: " . $e->getMessage();
    }
}
