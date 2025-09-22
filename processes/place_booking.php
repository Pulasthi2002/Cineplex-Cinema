<?php
include '../config.php';

if (isset($_POST['movie_id']) && isset($_POST['seats'])) {
    $movieId = $_POST['movie_id'];
    $seats = $_POST['seats']; // Array of selected seat IDs

    // Insert booking into the bookings table
    foreach ($seats as $seatId) {
        $query = "INSERT INTO bookings (movie_id, seat_id, user_id) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('iii', $movieId, $seatId, $_SESSION['user_id']); // Assuming you have user_id in session
        $stmt->execute();
    }

    echo "Booking confirmed!";
}
?>
