<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us | Cineplex Cinema</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #1a1a1a;
      color: #fff;
      overflow-x: hidden;
    }

    /* About Us Section */
    #about-us {
      background: url('assets/images/seatbg.jpg') center center / cover no-repeat;
      padding: 120px 0;
      text-align: center;
      color: #f9f9f9;
      position: relative;
      overflow: hidden;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    #about-us::before {
      content: '';
      position: absolute;
      top: -20%;
      left: -20%;
      width: 140%;
      height: 140%;
      background: radial-gradient(circle, rgba(255, 255, 255, 0.1), transparent);
      opacity: 0.2;
      transform: rotate(-20deg);
    }

    #about-us h2 {
      font-size: 4rem;
      font-weight: 600;
      font-family: 'Playfair Display', serif;
      letter-spacing: 2px;
      margin-bottom: 40px;
      text-transform: uppercase;
      position: relative;
      z-index: 1;
      opacity: 0;
      transform: translateY(50px);
      transition: all 1.2s ease-in-out;
      color: #f9f9f9;
    }

    #about-us p {
      font-size: 1.25rem;
      margin-bottom: 35px;
      color: rgba(255, 255, 255, 0.85);
      line-height: 1.8;
      position: relative;
      z-index: 1;
      max-width: 800px;
      margin: 0 auto;
      padding: 0 15px;
      opacity: 0;
      transform: translateY(40px);
      transition: all 1.2s ease-in-out;
    }

    /* Team Section */
    .team-section {
      background: linear-gradient(to right, #414345, #232526);
      padding: 100px 0;
      text-align: center;
      color: #fff;
      position: relative;
    }

    .team-section h3 {
      font-size: 3.8rem;
      font-family: 'Playfair Display', serif;
      font-weight: 700;
      margin-bottom: 60px;
      position: relative;
      z-index: 1;
      text-transform: uppercase;
      opacity: 0;
      transform: translateY(50px);
      transition: all 1.2s ease-in-out;
    }

    .team-member {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      padding: 25px;
      border-radius: 20px;
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
      transition: all 0.5s ease;
      height: 100%;
      position: relative;
      opacity: 0;
      transform: translateY(40px);
      transition: all 1.2s ease-in-out;
    }

    .team-member:hover {
      transform: translateY(-10px);
      box-shadow: 0 25px 40px rgba(0, 0, 0, 0.4);
    }

    .team-member img {
      width: 100%;
      height: 280px;
      border-radius: 15px;
      object-fit: cover;
      margin-bottom: 20px;
      transition: transform 0.5s ease;
    }

    .team-member:hover img {
      transform: scale(1.1);
    }

    .team-member h5 {
      font-size: 1.8rem;
      font-family: 'Playfair Display', serif;
      color: #2E4053;
      margin-bottom: 10px;
      font-weight: 700;
    }

    .team-member span {
      font-size: 1.3rem;
      color: #8b8b8b;
      display: block;
      margin-bottom: 15px;
    }

    .team-member p {
      font-size: 1.1rem;
      color: #ddd;
      line-height: 1.6;
    }

    /* Scroll Animations */
    .fade-in {
      opacity: 1 !important;
      transform: translateY(0) !important;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      #about-us h2 {
        font-size: 3rem;
      }

      .team-section h3 {
        font-size: 3rem;
      }
    }
  </style>
</head>

<body>
  <!-- About Us Section -->
  <section id="about-us">
    <div class="container">
      <h2 class="scroll-trigger">About Us</h2>
      <p class="scroll-trigger">Welcome to Cineplex Cinema, where the magic of movies comes alive! Our state-of-the-art theater is located in the heart of Colombo, offering an unparalleled cinematic experience.</p>
      <p class="scroll-trigger">At Cineplex Cinema, we believe in creating unforgettable memories. With comfortable seating, the latest technology, and a diverse selection of films, we strive to provide a captivating atmosphere for movie lovers of all ages. Join us for a journey through the world of cinema!</p>
    </div>
  </section>



  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
  <script>
    // Function to check if element is in viewport
    function isElementInViewport(el) {
      const rect = el.getBoundingClientRect();
      return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
      );
    }

    // Scroll-triggered animation
    function handleScrollAnimation() {
      const elements = document.querySelectorAll('.scroll-trigger');
      elements.forEach(el => {
        if (isElementInViewport(el)) {
          el.classList.add('fade-in');
        }
      });
    }

    // Run function on scroll and load
    window.addEventListener('scroll', handleScrollAnimation);
    window.addEventListener('load', handleScrollAnimation);
  </script>
</body>

</html>
