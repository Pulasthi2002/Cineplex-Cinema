<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $movieId = $_POST['movieId'];

    $sql = "SELECT s.id, s.seat_number, s.seat_type, s.price 
            FROM seats s 
            LEFT JOIN bookings b ON s.id = b.seat_id 
            WHERE s.available = 1 AND b.seat_id IS NULL";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="seat" data-seat-id="' . $row['id'] . '" data-seat-price="' . $row['price'] . '">';
            echo '<span>' . $row['seat_number'] . '</span>';
            echo '</div>';
        }
    } else {
        echo '<p>No available seats for this movie.</p>';
    }
}
?>
