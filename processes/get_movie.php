<?php
session_start();
include('../config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Sanitize the input to prevent SQL injection
    $stmt = $conn->prepare("SELECT movies.*, showtimes.showtime FROM movies LEFT JOIN showtimes ON movies.id = showtimes.movie_id WHERE movies.id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Fetch movie details
    if ($movie = $result->fetch_assoc()) {
        echo json_encode($movie);
    } else {
        echo json_encode([]);
    }
    $stmt->close();
}
