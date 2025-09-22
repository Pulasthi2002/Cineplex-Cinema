<?php
include '../config.php';

if (isset($_POST['movie_id'])) {
    $movieId = $_POST['movie_id'];

    $query = "SELECT s.id, s.available FROM seats s 
              JOIN showtimes st ON s.showtime_id = st.id 
              WHERE st.movie_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $movieId);
    $stmt->execute();
    $result = $stmt->get_result();

    $seats = [];
    while ($row = $result->fetch_assoc()) {
        $seats[] = $row;
    }

    echo json_encode($seats); // Return available seats as JSON
}
?>
