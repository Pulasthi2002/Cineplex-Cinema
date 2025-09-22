<?php
include '../config.php';

$sql = "SELECT * FROM movies"; // Adjust the SQL query if needed
$result = $conn->query($sql);

if ($result) {
    $movies = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($movies);
} else {
    echo json_encode([]);
}

$conn->close();
?>
