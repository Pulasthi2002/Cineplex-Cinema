<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promotions | Cineplex Cinema</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #0e0e0e; /* Dark background */
            font-family: 'Inter', sans-serif;
            color: #ffffff;
        }

        /* Promotions Section */
        #promotions {
            padding: 80px 0;
            position: relative;
            overflow: hidden;
            background: radial-gradient(circle at 50% 50%, #1a1a1a, #0e0e0e);
        }

        #promotions h2 {
            font-size: 3rem;
            color: #fefae0;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
            animation: fadeInDown 1s ease forwards;
        }

        #promotions p {
            font-size: 1.25rem;
            color: #d1d1d1;
            margin-bottom: 40px;
            animation: fadeIn 1.2s ease forwards;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);
        }

        /* Promotion Card Styles */
        .promotion-card {
            position: relative;
            background: #252525;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
            height: 100%; /* Ensure cards are the same height */
        }

        .promotion-card:hover {
            transform: scale(1.05);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.8);
        }

        .promotion-card img {
            width: 100%;
            height: 300px;
            transition: transform 0.3s;
        }

        .promotion-card:hover img {
            transform: scale(1.1);
        }

        .card-body {
            flex-grow: 1; /* Allow card body to grow */
            display: flex;
            flex-direction: column;
            justify-content: center; /* Center align content vertically */
            padding: 20px;
        }

        .card-title {
            font-size: 1.75rem;
            color: #fcbf49; /* Gold Color */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .card-text {
            font-size: 1rem;
            color: #e0e0e0;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            #promotions h2 {
                font-size: 2.5rem;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <section id="promotions" class="text-center py-5">
        <div class="container">
            <h2>Exclusive Cinema Promotions</h2>
            <p>Don't miss out on our exciting offers and deals at Cineplex Cinema!</p>

            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="promotion-card">
                        <img src="assets/images/promotion-popcorn.jpg" alt="Popcorn Promotion" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Free Popcorn Upgrade</h5>
                            <p class="card-text">Get a free upgrade to large popcorn with any movie ticket purchase!</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="promotion-card">
                        <img src="assets/images/promotion-ticket.jpg" alt="Ticket Promotion" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">2 for 1 Movie Tickets</h5>
                            <p class="card-text">Buy one movie ticket and get the second ticket free for select movies!</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="promotion-card">
                        <img src="assets/images/promotion-soda.jpg" alt="Soda Promotion" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Free Soda Refill</h5>
                            <p class="card-text">Enjoy unlimited soda refills with any combo purchase at the snack bar!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
