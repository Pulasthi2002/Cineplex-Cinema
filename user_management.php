<?php
session_start();
include 'config.php';

if ($_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Fetch users from the database
$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        h1 {
            color: #343a40;
        }
        .table {
            background-color: #fff;
            border-radius: 0.25rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
        .table td {
            vertical-align: middle;
        }
        .action-buttons {
            gap: 5px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>User Management</h1>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">
            Add New User
        </button>
    </div>

    <!-- User Table -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="userTableBody">
            <?php while ($user = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td>
                        <select class="form-select" onchange="updateUserRole(<?php echo $user['id']; ?>, this.value)">
                            <option value="customer" <?php echo $user['role'] === 'customer' ? 'selected' : ''; ?>>Customer</option>
                            <option value="staff" <?php echo $user['role'] === 'staff' ? 'selected' : ''; ?>>Staff</option>
                            <option value="admin" <?php echo $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                        </select>
                    </td>
                    <td>
                        <div class="d-flex action-buttons">
                            <button class="btn btn-primary btn-sm" onclick="editUser(<?php echo $user['id']; ?>)">
                                Edit
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="deleteUser(<?php echo $user['id']; ?>)">
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addUserForm">
                    <div class="mb-3">
                        <label for="addName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="addName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="addEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="addEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="addPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="addPassword" name="password" required minlength="6">
                    </div>
                    <div class="mb-3">
                        <label for="addRole" class="form-label">Role</label>
                        <select class="form-select" id="addRole" name="role" required>
                            <option value="">Select Role</option>
                            <option value="customer">Customer</option>
                            <option value="staff">Staff</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addUser()">Add User</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm">
                    <input type="hidden" id="editUserId" name="user_id">
                    <div class="mb-3">
                        <label for="editName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="editRole" class="form-label">Role</label>
                        <select class="form-select" id="editRole" name="role" required>
                            <option value="customer">Customer</option>
                            <option value="staff">Staff</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="updateUser()">Update User</button>
            </div>
        </div>
    </div>
</div>

<script>
function addUser() {
    console.log("Add user function called");
    
    // Get form data
    var name = $('#addName').val();
    var email = $('#addEmail').val();
    var password = $('#addPassword').val();
    var role = $('#addRole').val();
    
    console.log("Form data:", {name: name, email: email, role: role});
    
    // Validate form
    if (!name || !email || !password || !role) {
        alert('Please fill in all fields');
        return;
    }
    
    $.ajax({
        type: 'POST',
        url: 'processes/process_add_user.php',
        data: {
            name: name,
            email: email,
            password: password,
            role: role
        },
        dataType: 'json',
        success: function(response) {
            console.log("Success response:", response);
            if (response.status === 'success') {
                alert('User added successfully!');
                $('#addUserModal').modal('hide');
                location.reload();
            } else {
                alert('Error: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.log("AJAX Error:", xhr.responseText);
            console.log("Status:", status);
            console.log("Error:", error);
            alert('Error adding user. Check console for details.');
        }
    });
}

function editUser(userId) {
    console.log("Edit user function called for ID:", userId);
    
    $.ajax({
        type: 'GET',
        url: 'processes/get_user.php',
        data: { id: userId },
        dataType: 'json',
        success: function(user) {
            console.log("User data received:", user);
            if (user.id) {
                $('#editUserId').val(user.id);
                $('#editName').val(user.name);
                $('#editEmail').val(user.email);
                $('#editRole').val(user.role);
                $('#editUserModal').modal('show');
            } else {
                alert('Error: ' + user.message);
            }
        },
        error: function(xhr, status, error) {
            console.log("AJAX Error:", xhr.responseText);
            alert('Error loading user data. Check console for details.');
        }
    });
}

function updateUser() {
    console.log("Update user function called");
    
    var userId = $('#editUserId').val();
    var name = $('#editName').val();
    var email = $('#editEmail').val();
    var role = $('#editRole').val();
    
    console.log("Update data:", {user_id: userId, name: name, email: email, role: role});
    
    if (!name || !email || !role) {
        alert('Please fill in all fields');
        return;
    }
    
    $.ajax({
        type: 'POST',
        url: 'processes/process_edit_user.php',
        data: {
            user_id: userId,
            name: name,
            email: email,
            role: role
        },
        dataType: 'json',
        success: function(response) {
            console.log("Update response:", response);
            if (response.status === 'success') {
                alert('User updated successfully!');
                $('#editUserModal').modal('hide');
                location.reload();
            } else {
                alert('Error: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.log("AJAX Error:", xhr.responseText);
            alert('Error updating user. Check console for details.');
        }
    });
}

function updateUserRole(userId, role) {
    $.ajax({
        type: 'POST',
        url: 'processes/process_update_role.php',
        data: { id: userId, role: role },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                alert('User role updated successfully!');
            } else {
                alert('Error: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            alert('AJAX error: ' + error);
        }
    });
}

function deleteUser(userId) {
    if (confirm('Are you sure you want to delete this user?')) {
        $.ajax({
            type: 'POST',
            url: 'processes/process_delete_user.php',
            data: { id: userId },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert('User deleted successfully!');
                    location.reload();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Error deleting user: ' + error);
            }
        });
    }
}

// Reset form when modal is closed
$('#addUserModal').on('hidden.bs.modal', function () {
    $('#addUserForm')[0].reset();
});
</script>

</body>
</html>
