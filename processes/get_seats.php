<?php
include '../config.php'; // DB connection

$showtime_id = $_GET['showtime_id'];
$query = "SELECT id, seat_number, seat_type, price, available FROM seats WHERE showtime_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $showtime_id);
$stmt->execute();
$result = $stmt->get_result();

$seats = array();
while ($row = $result->fetch_assoc()) {
    $seats[] = $row;
}

echo json_encode($seats);
?>
