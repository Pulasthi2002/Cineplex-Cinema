<?php
session_start();
include 'config.php'; // Include your database connection

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Fetch movies from the database
$query = "SELECT movies.*, showtimes.showtime FROM movies LEFT JOIN showtimes ON movies.id = showtimes.movie_id";
$result = $conn->query($query);
$movies = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .modal-header {
            background-color: #007bff;
            color: white;
        }
        .error {
            color: red;
        }
        .loading {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Movie Management</h2>
        <button class="btn btn-primary mb-3" id="addMovieBtn" data-toggle="modal" data-target="#movieModal">Add Movie</button>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Showtime</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($movies as $movie): ?>
                <tr>
                    <td><?php echo htmlspecialchars($movie['id']); ?></td>
                    <td><?php echo htmlspecialchars($movie['title']); ?></td>
                    <td><?php echo htmlspecialchars($movie['description']); ?></td>
                    <td><img src="<?php echo htmlspecialchars($movie['image_url']); ?>" alt="Movie Image" style="width: 100px;"></td>
                    <td><?php echo htmlspecialchars($movie['showtime']); ?></td>
                    <td>
                        <button class="btn btn-warning editMovieBtn" data-id="<?php echo $movie['id']; ?>">Edit</button>
                        <button class="btn btn-danger deleteMovieBtn" data-id="<?php echo $movie['id']; ?>">Delete</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Loading Indicator -->
    <div class="loading" id="loading">Loading...</div>

    <!-- Movie Modal -->
    <div class="modal fade" id="movieModal" tabindex="-1" role="dialog" aria-labelledby="movieModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="movieModalLabel">Add/Edit Movie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="movieForm" enctype="multipart/form-data">
                        <input type="hidden" name="movie_id" id="movie_id">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                            <div class="error" id="titleError"></div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                            <div class="error" id="descriptionError"></div>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
                            <div class="error" id="imageError"></div>
                        </div>
                        <div class="form-group">
                            <label for="showtime">Showtime</label>
                            <input type="datetime-local" class="form-control" id="showtime" name="showtime" required>
                            <div class="error" id="showtimeError"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Open modal for adding a movie
            $('#addMovieBtn').click(function() {
                clearForm();
                $('#movieModalLabel').text('Add Movie');
            });

            // Open modal for editing a movie
            $('.editMovieBtn').click(function() {
                const id = $(this).data('id');
                showLoading();
                $.ajax({
                    url: 'processes/get_movie.php',
                    method: 'GET',
                    data: { id: id },
                    dataType: 'json',
                    success: function(movie) {
                        $('#movie_id').val(movie.id);
                        $('#title').val(movie.title);
                        $('#description').val(movie.description);
                        $('#showtime').val(movie.showtime.split('T')[0] + 'T' + movie.showtime.split(' ')[1]); // Extract date and time
                        $('#movieModalLabel').text('Edit Movie');
                        $('#movieModal').modal('show');
                    },
                    complete: hideLoading
                });
            });

            // Handle movie form submission
            $('#movieForm').submit(function(e) {
                e.preventDefault();
                clearErrors(); // Clear previous errors
                const formData = new FormData(this);
                showLoading(); // Show loading indicator
                $.ajax({
                    url: 'processes/save_movie.php',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        const result = JSON.parse(response);
                        if (result.success) {
                            alert(result.message);
                            location.reload(); // Reload the page
                        } else {
                            showErrors(result.errors); // Display errors
                        }
                    },
                    complete: hideLoading // Hide loading indicator after request
                });
            });

            // Delete movie
            $('.deleteMovieBtn').click(function() {
                const id = $(this).data('id');
                if (confirm('Are you sure you want to delete this movie?')) {
                    showLoading();
                    $.ajax({
                        url: 'processes/delete_movie.php',
                        method: 'POST',
                        data: { id: id },
                        success: function(response) {
                            alert(response);
                            location.reload(); // Reload the page
                        },
                        complete: hideLoading // Hide loading indicator after request
                    });
                }
            });

            function clearForm() {
                $('#movie_id').val('');
                $('#title').val('');
                $('#description').val('');
                $('#image').val('');
                $('#showtime').val('');
                clearErrors();
            }

            function clearErrors() {
                $('.error').text('');
            }

            function showErrors(errors) {
                for (let field in errors) {
                    $(`#${field}Error`).text(errors[field]);
                }
            }

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
