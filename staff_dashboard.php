<?php
session_start();

// Ensure the user is either an admin or staff
if ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'staff') {
    header('Location: login.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <!-- Include Bootstrap CSS (Use Bootstrap 4 to match the version in movie_management.php) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/font-awesome/css/font-awesome.min.css" rel="stylesheet"> <!-- Optional Font Awesome -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 20px;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin-right: 15px;
        }
        nav ul li a {
            text-decoration: none;
            color: #007bff;
            transition: color 0.3s;
        }
        nav ul li a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Staff Dashboard</h1>
        <nav class="text-center mb-4">
            <ul>
                <li><a href="#" id="booking-management">Booking Management</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <div id="content" class="mt-4"></div>
    </div>

    <!-- Include jQuery and Bootstrap JS (Make sure to use Bootstrap 4) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to load pages dynamically
            function loadPage(page) {
                $('#content').load(page, function(response, status, xhr) {
                    if (status === "error") {
                        console.error("Error loading page: " + xhr.status + " - " + xhr.statusText);
                        console.log(response); // Log any error response for debugging
                    }
                });
            }

            // Load user management by default
            loadPage('booking_management.php');

            $('#booking-management').click(function(e) {
                e.preventDefault();
                loadPage('booking_management.php');
            });

            $('#feedback-management').click(function(e) {
                e.preventDefault();
                loadPage('feedback_management.php');
            });
        });
    </script>
</body>
</html>
