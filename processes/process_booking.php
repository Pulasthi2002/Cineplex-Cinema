<?php
// Include database connection
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $movieId = $_POST['movie_id'];
    $seats = $_POST['seats']; // Array of selected seat IDs

    // Loop through each selected seat and save it to the bookings table
    foreach ($seats as $seatId) {
        // Insert booking logic here
        $sql = "INSERT INTO bookings (movie_id, seat_id, user_id, booking_time) VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $userId = 1; // Replace this with the actual logged-in user's ID
        $stmt->bind_param("iii", $movieId, $seatId, $userId);
        $stmt->execute();
    }

    echo "Booking successful for seats: " . implode(", ", $seats);
} else {
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
