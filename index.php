<?php
include 'includes/header.php';
include 'config.php'; // Ensure the database connection is included

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!-- Main Content -->
<main class="container-fluid p-0" id="mainContent" style="font-family: 'Poppins', sans-serif;">
    <!-- Hero Section -->
    <section id="home" class="hero-section text-center text-white d-flex justify-content-center align-items-center">
        <div class="overlay"></div>
        <div class="content">
            <h1 class="display-4 animated-title">Welcome to Cineplex Cinema</h1>
            <p class="lead animated-description">Experience movies like never before!</p>
            <a href="#movies" class="btn btn-lg explore-movies mt-4">Explore Now</a>
        </div>
    </section>

    <!-- If user is not logged in, show additional sections -->
    <?php if (!$isLoggedIn): ?>
        <?php include 'templates/info.php'; ?>
        <?php include 'templates/promotions.php'; ?>
        <?php include 'templates/upcoming_movies.php'; ?>
        
    <?php endif; ?>

    <!-- Common sections for all users -->
    <?php include 'templates/movies.php'; ?>
    <?php include 'templates/booking.php'; ?>
    <?php include 'templates/aboutus.php'; ?>
</main>

<!-- Always include the footer -->
<?php include 'includes/footer.php'; ?>

<!-- Include necessary Bootstrap and jQuery JS files -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
