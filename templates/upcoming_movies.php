<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upcoming Movies | Cineplex Cinema</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #111111;
      color: #f1f1f1;
    }

    .upcoming-movie-section {
      padding: 70px 0;
      text-align: center;
    }

    .upcoming-movie-section h2 {
      font-size: 3rem;
      font-weight: 600;
      text-transform: uppercase;
      margin-bottom: 50px;
      color: #fff;
      position: relative;
      display: inline-block;
    }

    .upcoming-movie-section h2::before {
      content: '';
      position: absolute;
      left: 50%;
      bottom: -10px;
      transform: translateX(-50%);
      width: 70px;
      height: 3px;
      background-color: #ff6347;
    }

    .upcoming-movie-card {
      background-color: #1a1a1a;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
      transition: transform 0.4s, box-shadow 0.4s;
      height: 100%;
    }

    .upcoming-movie-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 30px rgba(0, 0, 0, 0.8);
    }

    .upcoming-movie-card img {
      width: 100%;
      height: 350px;
      object-fit: cover;
      transition: transform 0.5s ease;
    }

    .upcoming-movie-card:hover img {
      transform: scale(1.1);
    }

    .upcoming-movie-card .card-body {
      padding: 15px;
      text-align: left;
    }

    .upcoming-movie-card h5 {
      font-size: 1.6rem;
      font-weight: 500;
      color: #ff6347;
      margin-bottom: 10px;
      letter-spacing: 1px;
    }

    .upcoming-movie-card p {
      font-size: 1rem;
      color: #ddd;
      line-height: 1.6;
      margin-bottom: 15px;
    }

    .upcoming-movie-card .card-footer {
      padding: 15px;
      border-top: none;
      background-color: transparent;
    }

    .upcoming-movie-card .release-date {
      color: #aaa;
      font-size: 0.9rem;
      letter-spacing: 0.5px;
    }

    .upcoming-movie-card:hover .release-date {
      color: #ff6347;
    }

    /* Unique Animations on Scroll */
    .upcoming-movie-card[data-aos="fade-up"] {
      transition: transform 1.2s ease-out;
    }

    .upcoming-movie-card[data-aos="fade-up"]:hover {
      transform: translateY(-10px) scale(1.05);
    }

    .upcoming-movie-card[data-aos="zoom-in"] {
      transition: all 0.8s ease;
    }

    .upcoming-movie-card[data-aos="zoom-in"]:hover {
      transform: scale(1.1) rotate(1deg);
    }

    .upcoming-movie-card[data-aos="flip-left"] {
      transition: all 1.5s ease;
    }

    .upcoming-movie-card[data-aos="flip-left"]:hover {
      transform: rotateY(10deg) scale(1.05);
    }

    /* Responsive */
    @media (max-width: 768px) {
      .upcoming-movie-card img {
        height: 280px;
      }

      .upcoming-movie-card h5 {
        font-size: 1.3rem;
      }
    }
  </style>
</head>

<body>

  <!-- Upcoming Movies Section -->
  <section class="upcoming-movie-section" id="upcoming-movies">
    <div class="container">
      <h2 data-aos="fade-up">Upcoming Movies</h2>
      <div class="row">
        <div class="col-lg-4 col-md-6 mb-5" data-aos="fade-up" data-aos-delay="100">
          <div class="upcoming-movie-card">
            <img src="assets/images/venom.jpg" alt="Movie 1 Poster">
            <div class="card-body">
              <h5 class="card-title">Venom: The Last Dance</h5>
              <p class="card-text">Eddie Brock and Venom must make a devastating decision as they're pursued by a mysterious military man.</p>
            </div>
            <div class="card-footer">
              <span class="release-date">Release Date: Oct 24, 2024</span>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-5" data-aos="zoom-in" data-aos-delay="200">
          <div class="upcoming-movie-card">
            <img src="assets/images/Captain_America.jpg" alt="Movie 2 Poster">
            <div class="card-body">
              <h5 class="card-title">Captain America: Brave New World</h5>
              <p class="card-text">A heartfelt drama with gripping performances and an emotional storyline.</p>
            </div>
            <div class="card-footer">
              <span class="release-date">Release Date: Feb 14, 2025</span>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-5" data-aos="flip-left" data-aos-delay="300">
          <div class="upcoming-movie-card">
            <img src="assets/images/moana.jpg" alt="Movie 3 Poster">
            <div class="card-body">
              <h5 class="card-title">Moana 2</h5>
              <p class="card-text">After receiving an unexpected call from her wayfinding ancestors, Moana journeys to the far seas of Oceania and into dangerous, long-lost waters for an adventure unlike anything she has ever faced.</p>
            </div>
            <div class="card-footer">
              <span class="release-date">Release Date: Nov 27, 2024</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- JS Libraries -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 1000,
    });
  </script>
</body>

</html>
