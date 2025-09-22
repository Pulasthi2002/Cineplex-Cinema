<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facilities - Cineplex Cinema</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600&family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.css">

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #121212;
            color: #e0e0e0;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .facilities-section {
            padding: 100px 0;
            background: radial-gradient(circle, rgba(0, 0, 0, 0.9), rgba(30, 30, 30, 0.95));
        }

        /* Hexagonal Shape with Glass Effect */
        .facility-card {
            position: relative;
            width: 100%;
            height: 800px;
            background: rgba(20, 20, 20, 0.5);
            backdrop-filter: blur(15px);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
            overflow: hidden;
            clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
            transition: transform 0.4s ease, box-shadow 0.4s ease, background 0.4s;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
            padding: 15px;
        }

        .facility-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.8);
            background: rgba(20, 20, 20, 0.9);
        }

        /* Facility Image */
        .facility-image {
            width: 100%;
            height: 200px;
            background-size: cover;
            background-position: center;
            border-radius: 15px;
            margin-bottom: 15px;
        }

        .facility-title {
            font-family: 'Cinzel', serif;
            font-size: 2rem;
            color: #f2f2f2;
            margin: 10px 0;
            text-align: center;
            transition: transform 0.3s;
        }

        .facility-description {
            font-size: 1.1rem;
            color: #ccc;
            text-align: center;
            margin-bottom: 15px;
            transition: opacity 0.3s;
        }

        .facilities-header {
            text-align: center;
            font-family: 'Cinzel', serif;
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 50px;
            color: #e0e0e0;
            text-shadow: 0 3px 6px rgba(0, 0, 0, 0.8);
        }

        /* AOS Animations */
        [data-aos] {
            opacity: 0;
        }

        [data-aos].aos-animate {
            opacity: 1;
        }
    </style>
</head>

<body data-aos-easing="ease-in-out" data-aos-duration="800" data-aos-delay="0">

    <!-- Facilities Section -->
    <section class="facilities-section">
        <div class="container">
            <h2 class="facilities-header" data-aos="fade-up">Our Premium Facilities</h2>
            <div class="row g-4">
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="facility-card">
                        <div class="facility-image" style="background-image: url('assets/images/premium-seating.png');"></div>
                        <h3 class="facility-title">Premium Seating</h3>
                        <p class="facility-description">Experience ultimate comfort with our luxurious, spacious seating arrangements.</p>
                    </div>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="facility-card">
                        <div class="facility-image" style="background-image: url('assets/images/immersive-sound.png');"></div>
                        <h3 class="facility-title">Immersive Sound System</h3>
                        <p class="facility-description">Feel every moment with our state-of-the-art Dolby surround sound.</p>
                    </div>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="facility-card">
                        <div class="facility-image" style="background-image: url('assets/images/4k-projection.png');"></div>
                        <h3 class="facility-title">4K Ultra HD Projection</h3>
                        <p class="facility-description">Watch movies in stunning detail with our crystal-clear 4K projections.</p>
                    </div>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="facility-card">
                        <div class="facility-image" style="background-image: url('assets/images/refreshments.png');"></div>
                        <h3 class="facility-title">Gourmet Refreshments</h3>
                        <p class="facility-description">Indulge in a range of gourmet snacks and beverages, delivered straight to your seat.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.js"></script>

    <script>
        // Initialize AOS
        AOS.init();
    </script>
</body>

</html>
