<?php
session_start();
include '../config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die('Unauthorized');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $duration = $_POST['duration'];

    $stmt = $pdo->prepare("INSERT INTO movies (title, genre, duration) VALUES (?, ?, ?)");
    if ($stmt->execute([$title, $genre, $duration])) {
        echo 'Movie added successfully';
    } else {
        echo 'Error adding movie';
    }
}
?>
