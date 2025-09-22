<?php
session_start();
include '../config.php'; // Include your database connection

$movie_id = $_GET['movie_id'];

// Fetch seat layout
$stmt = $conn->prepare("SELECT * FROM seats WHERE movie_id = ? AND status = 'available'");
$stmt->bind_param("i", $movie_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($seat = $result->fetch_assoc()) {
        echo '<input type="checkbox" name="seats" value="' . $seat['id'] . '">' . $seat['seat_number'] . ' ';
    }
} else {
    echo 'No seats available.';
}

$stmt->close();
$conn->close();
?>
