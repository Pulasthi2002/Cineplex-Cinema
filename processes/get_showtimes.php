<?php
include '../config.php'; // DB connection

$movie_id = $_GET['movie_id'];
$query = "SELECT id, DATE_FORMAT(showtime, '%d-%m-%Y %H:%i') AS showtime FROM showtimes WHERE movie_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $movie_id);
$stmt->execute();
$result = $stmt->get_result();

$showtimes = array();
while ($row = $result->fetch_assoc()) {
    $showtimes[] = $row;
}

echo json_encode($showtimes);
?>
