<?php
session_start();
include '../config.php'; // Include your database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$movie_id = $_GET['movie_id'];

// Fetch the movie details
$stmt = $conn->prepare("SELECT * FROM movies WHERE id = ?");
$stmt->bind_param("i", $movie_id);
$stmt->execute();
$movie = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seat Selection for <?php echo $movie['title']; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4"><?php echo $movie['title']; ?> - Select Your Seats</h1>
        <div id="seatLayout" class="mt-4"></div>
        <h3 class="mt-4">Total: $<span id="totalPrice">0.00</span></h3>
        <button class="btn btn-success mt-3" id="bookSeatsBtn">Book Now</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            const movieId = <?php echo $movie_id; ?>;

            // Load seat layout
            $.ajax({
                url: 'get_seat_layout.php',
                type: 'GET',
                data: { movie_id: movieId },
                success: function(response) {
                    $('#seatLayout').html(response);
                }
            });

            // Book seats
            $('#bookSeatsBtn').click(function() {
                const selectedSeats = [];
                $('input[name="seats"]:checked').each(function() {
                    selectedSeats.push($(this).val());
                });

                if (selectedSeats.length > 0) {
                    $.ajax({
                        url: 'book_seat.php',
                        type: 'POST',
                        data: { movie_id: movieId, seats: selectedSeats },
                        success: function(response) {
                            alert(response);
                            window.location.href = 'view_bookings.php'; // Redirect to view bookings
                        },
                        error: function() {
                            alert('Error while booking seats.');
                        }
                    });
                } else {
                    alert('Please select at least one seat.');
                }
            });
        });
    </script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
