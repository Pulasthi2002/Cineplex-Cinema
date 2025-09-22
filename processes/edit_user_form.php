<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../config.php';

if ($_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if ($user) {
        ?>
        <h3>Edit User</h3>
        <form id="editUserForm">
            <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']); ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($user['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select class="form-control" id="role" name="role">
                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                    <option value="staff" <?= $user['role'] == 'staff' ? 'selected' : ''; ?>>Staff</option>
                    <option value="customer" <?= $user['role'] == 'customer' ? 'selected' : ''; ?>>Customer</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
        <?php
    } else {
        echo "User not found.";
    }
}
?>
