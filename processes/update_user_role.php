<?php
// Include database connection
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $new_role = $_POST['new_role'];

    // Basic validation to ensure role is not empty and valid
    $valid_roles = ['admin', 'customer', 'manager'];
    if (!in_array($new_role, $valid_roles)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid role specified.']);
        exit;
    }

    // Prepare and bind the update query to prevent SQL injection
    $sql = "UPDATE users SET role = ? WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('si', $new_role, $user_id);

        // Execute the update query
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Role updated successfully.']);
            } else {
                echo json_encode(['status' => 'info', 'message' => 'No changes made to the role.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error updating role.']);
        }
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error.']);
    }
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
