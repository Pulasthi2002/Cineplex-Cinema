<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Café - Unique Gallery</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.1/css/bootstrap.min.css">

    <!-- AOS CSS (for scroll animations) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #121212;
            color: #e0e0e0;
            margin: 0;
        }

        .gallery-section {
            padding: 80px 0;
            background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.9)), url('assets/images/background.jpg') no-repeat center center/cover; /* Add your background image here */
        }

        .gallery-title {
            text-align: center;
            font-size: 3rem;
            margin-bottom: 40px;
            font-weight: 700;
            color: #e74c3c;
            letter-spacing: 0.5px;
            position: relative;
            display: inline-block;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.7);
        }

        .gallery-title::after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: -10px;
            transform: translateX(-50%);
            width: 80px;
            height: 5px;
            background: #e74c3c;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 15px;
            justify-content: center;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            background: rgba(20, 20, 20, 0.8); /* Darker background for a more sophisticated look */
            border-radius: 15px; /* Rounded corners */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            will-change: transform, box-shadow; /* Performance optimization */
            border: 2px solid rgba(255, 255, 255, 0.2); /* Slightly glowing border */
        }

        .gallery-item img {
            width: 100%;
            height: 220px; /* Fixed height for a better Polaroid look */
            object-fit: cover; /* Ensure image covers the space */
            transition: transform 0.3s ease; /* Smooth image transition */
        }

        .gallery-item:hover img {
            transform: scale(1.1) rotate(2deg); /* Slight rotation for added dynamism */
        }

        .gallery-item:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.6);
        }

        .gallery-item .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item:hover .overlay {
            opacity: 1;
        }

        .overlay .text {
            color: #f39c12;
            font-size: 1.5rem;
            font-weight: 600;
            text-transform: uppercase;
            text-align: center;
            letter-spacing: 1px;
            transition: transform 0.3s ease; /* Smooth transition for text */
        }

        .gallery-item:hover .text {
            transform: scale(1.1); /* Slightly enlarge text on hover */
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .gallery-title {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>

    <!-- Gallery Section -->
<section class="gallery-section">
    <div class="container">
        <h2 class="gallery-title" data-aos="fade-down">Our Gallery</h2>
        <div class="gallery-grid">
            <!-- Gallery items -->
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="100">
                <img src="assets/images/image1.jpg" alt="Gallery Image 1">
                <div class="overlay">
                    <div class="text">The Gallery Cafe</div>
                </div>
            </div>

            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="200">
                <img src="assets/images/image2.jpg" alt="Gallery Image 2">
                <div class="overlay">
                    <div class="text">Cozy Ambiance</div>
                </div>
            </div>

            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="300">
                <img src="assets/images/image3.jpg" alt="Gallery Image 3">
                <div class="overlay">
                    <div class="text">Signature Dish</div>
                </div>
            </div>

            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="400">
                <img src="assets/images/image4.jpg" alt="Gallery Image 4">
                <div class="overlay">
                    <div class="text">Tasty Dessert</div>
                </div>
            </div>

            <!-- Additional Gallery Items -->
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="500">
                <img src="assets/images/image5.jpg" alt="Gallery Image 5">
                <div class="overlay">
                    <div class="text">Refreshing Beverages</div>
                </div>
            </div>

            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="600">
                <img src="assets/images/image6.jpg" alt="Gallery Image 6">
                <div class="overlay">
                    <div class="text">Modern Interior</div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Bootstrap, jQuery, and AOS JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script>
        $(document).ready(function() {
            AOS.init({
                duration: 800, // Animation duration
                once: true // Whether animation should happen only once - while scrolling down
            });
        });
    </script>

</body>
</html>
