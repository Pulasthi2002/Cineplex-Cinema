<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Required</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            background: #f0f2f5;
            font-family: 'Arial', sans-serif;
        }
        .login-prompt-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-prompt-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
            width: 90%;
            max-width: 600px;
            transition: transform 0.3s ease-in-out;
        }
        .login-prompt-card:hover {
            transform: scale(1.05);
        }
        .login-prompt-card h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #007bff;
            font-weight: bold;
        }
        .login-prompt-card p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: #6c757d;
        }
        .login-prompt-card .btn {
            padding: 15px 25px;
            font-size: 1.2rem;
            border-radius: 50px;
            transition: background-color 0.3s ease;
        }
        .login-prompt-card .btn:hover {
            background-color: #0056b3;
            color: #ffffff;
        }
        .login-prompt-card .btn i {
            margin-right: 8px;
        }
        .animate__animated {
            animation-duration: 1s;
        }
        .animate__fadeIn {
            animation-name: fadeIn;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="login-prompt-container">
        <div class="login-prompt-card animate__animated animate__fadeIn">
            <h1><i class="fas fa-user-lock"></i> Login Required</h1>
            <p class="lead">To make a reservation, you need to be logged in. Please log in to continue.</p>
            <a href="login.php" class="btn btn-primary">
                <i class="fas fa-sign-in-alt"></i> Log In
            </a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
