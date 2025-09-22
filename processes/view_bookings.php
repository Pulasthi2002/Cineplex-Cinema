<?php
include '../config.php';
session_start();
$userId = $_SESSION['user_id'];

// Fetch user bookings
$sql = "SELECT b.id, m.title, b.seat_id, b.total_price, b.status, b.booking_time 
        FROM bookings b 
        JOIN movies m ON b.showtime_id = m.id 
        WHERE b.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();
?>

<section id="bookings" class="bookings-section py-5">
    <div class="container">
        <h2 class="text-center">Your Bookings</h2>
        <div class="row">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['title']; ?></h5>
                                <p class="card-text">Seat: <?php echo $row['seat_id']; ?></p>
                                <p class="card-text">Total Price: <?php echo $row['total_price']; ?> USD</p>
                                <p class="card-text">Status: <?php echo $row['status']; ?></p>
                                <p class="card-text"><small class="text-muted">Booking Time: <?php echo $row['booking_time']; ?></small></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-center">No bookings found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
