<?php
session_start();
include 'config.php'; // Include your database connection

// Ensure the user is either an admin or staff
if ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'staff') {
    header('Location: login.php');
    exit();
}
// Fetch bookings from the database
$status_filter = isset($_GET['status']) ? $_GET['status'] : '';
$query = "SELECT bookings.*, users.name, showtimes.showtime
          FROM bookings 
          JOIN users ON bookings.user_id = users.id 
          JOIN showtimes ON bookings.showtime_id = showtimes.id";


if ($status_filter) {
    $query .= " WHERE bookings.status = ?";
}

$stmt = $conn->prepare($query);
if ($stmt === false) {
    // Print error details if preparation fails
    die("Error preparing statement: " . $conn->error);
}

if ($status_filter) {
    $stmt->bind_param("s", $status_filter);
}

if (!$stmt->execute()) {
    // Print error details if execution fails
    die("Error executing statement: " . $stmt->error);
}

$result = $stmt->get_result();
$bookings = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .modal-header {
            background-color: #007bff;
            color: white;
        }
        .loading {
            display: none;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Booking Management</h2>
        
        <!-- Filter Bookings -->
        <div class="mb-3">
            <label for="statusFilter" class="form-label">Filter by Status:</label>
            <select class="form-select" id="statusFilter">
                <option value="">All</option>
                <option value="Pending" <?php echo ($status_filter == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                <option value="Confirmed" <?php echo ($status_filter == 'Confirmed') ? 'selected' : ''; ?>>Confirmed</option>
                <option value="Cancelled" <?php echo ($status_filter == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
            </select>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Showtime</th>
                    <th>Seat ID</th>
                    <th>Total Price</th>
                    <th>Booking Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="bookingTableBody">
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($booking['id']); ?></td>
                        <td><?php echo htmlspecialchars($booking['name']); ?></td> <!-- Corrected to 'name' -->
                        <td><?php echo htmlspecialchars($booking['showtime']); ?></td> <!-- Corrected to 'showtime' -->
                        <td><?php echo htmlspecialchars($booking['seat_id']); ?></td>
                        <td><?php echo htmlspecialchars($booking['total_price']); ?></td>
                        <td><?php echo htmlspecialchars($booking['booking_time']); ?></td>
                        <td class="booking-status" data-id="<?php echo $booking['id']; ?>"><?php echo htmlspecialchars($booking['status']); ?></td>
                        <td>
                            <button class="btn btn-warning changeStatusBtn" data-id="<?php echo $booking['id']; ?>">Change Status</button>
                            <button class="btn btn-danger deleteBookingBtn" data-id="<?php echo $booking['id']; ?>">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Loading Indicator -->
    <div class="loading" id="loading">Loading...</div>

    <!-- Change Status Modal -->
    <div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeStatusModalLabel">Change Booking Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="changeStatusForm">
                        <input type="hidden" name="booking_id" id="booking_id">
                        <div class="form-group">
                            <label for="new_status">New Status</label>
                            <select class="form-select" name="new_status" id="new_status" required>
                                <option value="Pending">Pending</option>
                                <option value="Confirmed">Confirmed</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Filter bookings
            $('#statusFilter').change(function() {
                const status = $(this).val();
                window.location.href = `booking_management.php?status=${status}`;
            });

            // Change Status button click
            $('.changeStatusBtn').click(function() {
                const id = $(this).data('id');
                $('#booking_id').val(id);
                $('#changeStatusModal').modal('show');
            });

            // Handle status change form submission
            $('#changeStatusForm').submit(function(e) {
                e.preventDefault();
                const formData = $(this).serialize();
                showLoading(); // Show loading indicator
                $.ajax({
                    url: 'processes/change_booking_status.php',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        const result = JSON.parse(response);
                        if (result.success) {
                            alert(result.message);
                            location.reload(); // Reload the page
                        } else {
                            alert(result.message); // Show error message
                        }
                    },
                    complete: hideLoading // Hide loading indicator
                });
            });

            // Delete booking
            $('.deleteBookingBtn').click(function() {
                const id = $(this).data('id');
                if (confirm('Are you sure you want to delete this booking?')) {
                    showLoading();
                    $.ajax({
                        url: 'processes/delete_booking.php',
                        method: 'POST',
                        data: { id: id },
                        success: function(response) {
                            alert(response);
                            location.reload(); // Reload the page
                        },
                        complete: hideLoading // Hide loading indicator
                    });
                }
            });

            function showLoading() {
                $('#loading').show();
            }

            function hideLoading() {
                $('#loading').hide();
            }
        });
    </script>
</body>
</html>
