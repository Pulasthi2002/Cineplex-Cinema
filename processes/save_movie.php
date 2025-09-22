<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../config.php';

// Ensure user is an admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

$response = array('success' => false, 'message' => '', 'errors' => array());

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $showtime = trim($_POST['showtime']);
    
    // Validate input
    if (empty($title)) {
        $response['errors']['title'] = 'Title is required.';
    }
    if (empty($description)) {
        $response['errors']['description'] = 'Description is required.';
    }
    if (empty($showtime)) {
        $response['errors']['showtime'] = 'Showtime is required.';
    }
    
    // Handle image upload
    $image = $_FILES['image'];
    $targetDir = "../assets/images/";
    $targetFile = $targetDir . basename($image["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image
    $check = getimagesize($image["tmp_name"]);
    if ($check === false) {
        $response['errors']['image'] = 'File is not an image.';
        $uploadOk = 0;
    }

    // Check file size
    if ($image["size"] > 500000) { // 500KB limit
        $response['errors']['image'] = 'Sorry, your file is too large.';
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        $response['errors']['image'] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $response['message'] = 'Sorry, your file was not uploaded.';
    } else {
        if (move_uploaded_file($image["tmp_name"], $targetFile)) {
            $imagePath = 'assets/images/' . basename($image["name"]);
            
            // Insert movie into database
            $sql = "INSERT INTO movies (title, description, image_url) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $title, $description, $imagePath);

            if ($stmt->execute()) {
                $movieId = $stmt->insert_id; // Get the last inserted movie ID

                // Insert the showtime
                $stmt = $conn->prepare("INSERT INTO showtimes (movie_id, showtime) VALUES (?, ?)");
                $stmt->bind_param("is", $movieId, $showtime);
                if ($stmt->execute()) {
                    $response['success'] = true;
                    $response['message'] = 'Movie added successfully with showtime.';
                } else {
                    $response['message'] = 'Error adding showtime: ' . $stmt->error;
                }
            } else {
                $response['message'] = 'Error adding movie: ' . $stmt->error;
            }

            $stmt->close();
        } else {
            $response['message'] = 'Sorry, there was an error uploading your file.';
        }
    }

    echo json_encode($response);
}
?>
