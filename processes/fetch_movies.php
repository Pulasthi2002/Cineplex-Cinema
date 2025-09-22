<?php
session_start();
include '../config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die('Unauthorized');
}

$stmt = $pdo->query("SELECT * FROM movies");
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($movies as $movie) {
    echo "<tr>
            <td>{$movie['id']}</td>
            <td>{$movie['title']}</td>
            <td>{$movie['genre']}</td>
            <td>{$movie['duration']}</td>
            <td><a href='process_delete_movie.php?id={$movie['id']}' class='text-danger'>Delete</a></td>
          </tr>";
}
?>
