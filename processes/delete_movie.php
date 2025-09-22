<?php
session_start();
include('../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Delete associated showtime
    $query_showtime = "DELETE FROM showtimes WHERE movie_id = ?";
    $stmt_showtime = $conn->prepare($query_showtime);
    $stmt_showtime->bind_param("i", $id);
    $stmt_showtime->execute();

    // Delete movie
    $query = "DELETE FROM movies WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo "Movie deleted successfully!";
}
