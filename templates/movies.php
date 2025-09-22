<?php
// movies.php

include 'config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Fetch all movies by default
$sql = "SELECT m.id, m.title, m.description, m.image_url, s.id AS showtime_id, s.showtime 
        FROM movies m 
        JOIN showtimes s ON m.id = s.movie_id";
$result = $conn->query($sql);
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<div class="container mt-5" id="movies">
    <h2 class="text-center mb-4">Available Movies</h2>

    <!-- Search Bar -->
    <div class="row mb-4">
        <div class="col-md-12">
            <input type="text" id="searchMovie" class="form-control" placeholder="Search movies by title...">
        </div>
    </div>

    <!-- Movies Section -->
    <div id="moviesList" class="row">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4 movie-card" data-title="<?php echo strtolower($row['title']); ?>">
                    <div class="card">
                        <img src="<?php echo $row['image_url']; ?>" class="card-img-top" alt="<?php echo $row['title']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['title']; ?></h5>
                            <p class="card-text"><?php echo $row['description']; ?></p>
                            <p class="card-text"><small class="text-muted">Showtime: <?php echo $row['showtime']; ?></small></p>
                            <a href="#" class="btn btn-primary book-now" data-movie-id="<?php echo $row['id']; ?>" data-showtime-id="<?php echo $row['showtime_id']; ?>">Book Now</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <p class="text-center">No movies available at the moment.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Seat selection and booking modal -->
<div class="modal fade" id="seatSelectionModal" tabindex="-1" aria-labelledby="seatSelectionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="seatSelectionModalLabel">Select Seats</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="seatLayout" class="d-flex flex-wrap justify-content-center"></div>
                <div class="form-group mt-3">
                    <label for="seats">Number of Seats Selected:</label>
                    <input type="number" class="form-control" id="seats" value="1" min="1" readonly>
                </div>
                <p>Total Price: <span id="totalPrice">0</span> LKR</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirmBooking">Confirm Booking</button>
            </div>
        </div>
    </div>
</div>

<style>
     .movie-card {
        display: flex;
        justify-content: center;
    }

    /* Cards Styling */
    .card {
        height: 100%; /* Ensure all cards have the same height */
        display: flex;
        flex-direction: column; /* Stack content vertically */
        border-radius: 15px; /* Smooth curved edges */
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s; /* Add smooth hover effect */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        background-image: linear-gradient(to left, #BDBBBE 0%, #9D9EA3 100%), radial-gradient(88% 271%, rgba(255, 255, 255, 0.25) 0%, rgba(254, 254, 254, 0.25) 1%, rgba(0, 0, 0, 0.25) 100%), radial-gradient(50% 100%, rgba(255, 255, 255, 0.30) 0%, rgba(0, 0, 0, 0.30) 100%);
 background-blend-mode: normal, lighten, soft-light;
    }

    /* Card hover effect */
    .card:hover {
        transform: scale(1.05); /* Slight zoom effect */
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); /* Enhanced shadow on hover */
    }

    /* Image consistency */
    .card-img-top {
        object-fit: cover; /* Ensures all images have the same height and aspect ratio */
        height: 400px; /* Set a fixed height for images */
        width: 100%;
    }

    /* Content styling */
    .card-body {
        flex-grow: 1; /* Ensures the card body stretches to fill the available space */
    }

    .card-title {
        font-weight: 600;
        font-size: 1.25rem;
    }

    .card-text {
        font-size: 0.9rem;
        margin-bottom: 1rem;
        color: #000;
    }

    .seat {
            width: 40px;
            height: 40px;
            margin: 5px;
            border: 1px solid #ccc;
            cursor: pointer;
            text-align: center;
            line-height: 40px;
        }
        .selected { background-color: #5cb85c; }
        .booked { background-color: #d9534f; pointer-events: none; }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .card {
            height: auto; /* Adjust for smaller screens */
        }

        .card-img-top {
            height: 200px; /* Reduce image height for smaller screens */
        }
    }

    
</style>

<script>
$(document).ready(function() {
    let movieId;
    let showtimeId; 
    let selectedSeats = [];
    let isBookingConfirmed = false; // To prevent multiple submissions

    // Search Bar Functionality
    $('#searchMovie').on('keyup', function() {
        const searchTerm = $(this).val().toLowerCase();
        $('.movie-card').each(function() {
            const movieTitle = $(this).data('title');
            if (movieTitle.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    $('.book-now').on('click', function(e) {
        e.preventDefault();
        movieId = $(this).data('movie-id');
        showtimeId = $(this).data('showtime-id'); 

        $.ajax({
            url: 'processes/get_available_seats.php',
            method: 'POST',
            data: { movieId: movieId },
            success: function(response) {
                $('#seatLayout').html(response);
                $('#seatSelectionModal').modal('show');
                selectedSeats = []; // Reset selected seats when opening the modal
                $('#seats').val(0);
                $('#totalPrice').text('0');
                isBookingConfirmed = false; // Reset booking state
            }
        });
    });

    $(document).on('click', '.seat', function() {
        const seatId = $(this).data('seat-id');
        const price = $(this).data('seat-price');

        $(this).toggleClass('selected');

        if ($(this).hasClass('selected')) {
            selectedSeats.push(seatId);
        } else {
            selectedSeats = selectedSeats.filter(seat => seat !== seatId);
        }

        $('#seats').val(selectedSeats.length);
        const totalPrice = selectedSeats.length * price;
        $('#totalPrice').text(totalPrice.toFixed(2));
    });

    $('#confirmBooking').on('click', function() {
        if (selectedSeats.length === 0) {
            alert('Please select at least one seat.');
            return;
        }

        if (isBookingConfirmed) {
            alert('Booking is already confirmed.');
            return; // Prevent multiple bookings
        }

        const totalPrice = $('#totalPrice').text();

        // Disable the booking button to prevent multiple clicks
        $(this).prop('disabled', true).text('Processing...');

        $.ajax({
            url: 'processes/book_seat.php',
            method: 'POST',
            data: {
                movieId: movieId,
                showtimeId: showtimeId,
                seatIds: selectedSeats,
                totalPrice: totalPrice
            },
            success: function(response) {
                alert(response);
                $('#seatSelectionModal').modal('hide');
                location.reload();
                isBookingConfirmed = true; // Set booking state to confirmed
            },
            error: function() {
                alert('An error occurred while processing your booking. Please try again.');
                // Re-enable the booking button in case of error
                $('#confirmBooking').prop('disabled', false).text('Confirm Booking');
            }
        });
    });
});
</script>
