<?php
include 'config.php'; // Include database connection

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Display a message instead of exiting
    echo "<p>You must be logged in to view your bookings.</p>";
} else {
    $userId = $_SESSION['user_id'];

    // Fetch user's bookings, including total price
    $sql = "SELECT b.id AS booking_id, m.title, s.showtime, GROUP_CONCAT(se.seat_number SEPARATOR ', ') AS seats, b.status, b.total_price 
            FROM bookings b 
            JOIN showtimes s ON b.showtime_id = s.id 
            JOIN movies m ON s.movie_id = m.id 
            JOIN seats se ON b.seat_id = se.id 
            WHERE b.user_id = ? 
            GROUP BY b.id";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Database query failed: " . $conn->error); // Output error if statement preparation fails
    }

    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>

    <div class="container mt-5" id="booking-section">
        <h2 class="text-center mb-4 text-white">Your Bookings</h2>

        <?php if ($result->num_rows > 0): ?>
            <table class="table table-hover table-striped text-white custom-table">
                <thead>
                    <tr>
                        <th>Movie Title</th>
                        <th>Showtime</th>
                        <th>Seats</th>
                        <th>Status</th>
                        <th>Total Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo htmlspecialchars($row['showtime']); ?></td>
                            <td><?php echo htmlspecialchars($row['seats']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                            <td><?php echo htmlspecialchars($row['total_price']); ?> LKR</td>
                            <td>
                                <button class="btn btn-danger cancel-booking" data-booking-id="<?php echo $row['booking_id']; ?>">Cancel</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center text-white">No bookings found.</p>
        <?php endif; ?>
    </div>

    <?php
} // End of else block
?>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function() {
    $('.cancel-booking').on('click', function() {
        const bookingId = $(this).data('booking-id');
        if (confirm("Are you sure you want to cancel this booking?")) {
            $.ajax({
                url: 'processes/cancel_booking.php',
                method: 'POST',
                data: { bookingId: bookingId },
                success: function(response) {
                    alert(response);
                    location.reload(); // Refresh the page after cancellation
                },
                error: function() {
                    alert("An error occurred while canceling the booking. Please try again.");
                }
            });
        }
    });
});
</script>

<!-- Custom CSS for modern styling -->
<style>
    body {
        background-color: #121212;
        font-family: 'Poppins', sans-serif;
    }

    #booking-section {
        padding: 2rem;
        background-color: #1E1E1E;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
    }

    .custom-table thead {
        background-color: #444;
    }

    .custom-table th, .custom-table td {
        vertical-align: middle;
        text-align: center;
    }

    .custom-table tr {
        transition: all 0.3s ease;
    }


    .btn-danger {
        background-color: #ff3b3b;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-danger:hover {
        box-shadow: 0 0 10px rgba(255, 0, 0, 0.7);
    }

    h2 {
        font-size: 2.5rem;
        letter-spacing: 1px;
    }
</style>
