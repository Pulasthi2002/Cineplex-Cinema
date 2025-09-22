<?php
session_start();
include '../config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die('Unauthorized');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM movies WHERE id = ?");
    if ($stmt->execute([$id])) {
        echo 'Movie deleted successfully';
    } else {
        echo 'Error deleting movie';
    }
}
?>
