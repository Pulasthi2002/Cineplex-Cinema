<?php
session_start();
include '../config.php';

header('Content-Type: application/json');

if ($_SESSION['role'] !== 'admin') {
    echo json_encode(['status' => 'error', 'message' => 'Access denied']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = intval($_POST['id']);
    $role = $_POST['role'];

    if ($user_id <= 0 || empty($role)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid parameters']);
        exit();
    }

    if (!in_array($role, ['customer', 'staff', 'admin'])) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid role']);
        exit();
    }

    $stmt = $conn->prepare("UPDATE users SET role = ? WHERE id = ?");
    $stmt->bind_param("si", $role, $user_id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Role updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not found or no changes made']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update role']);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
