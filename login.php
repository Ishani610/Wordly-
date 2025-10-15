<?php
// public/login.php

// Load config
$config = require __DIR__ . '/../config/config.php';

// Create DB connection
$conn = mysqli_connect(
    $config['db_host'],
    $config['db_user'],
    $config['db_pass'],
    $config['db_name'],
    $config['db_port']
);

// Check connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Initialize variables
$message = "";

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
   // echo $email ."<br>";
   // echo $password ."<br>";


    // Check credentials (password stored as MD5 here for demo)
    $query = "SELECT * FROM users WHERE email='$email' AND password='123456'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $message = "<div class='success-message'>Login successful! Welcome, $email 🎉</div>";
    } else {
        $message = "<div class='error-message'>Invalid email or password ❌</div>";
    }

    mysqli_free_result($result);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wordly - Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1 style="text-align: center; color: #667eea; margin-bottom: 10px; font-size: 2.5rem;">Wordly</h1>
        <p style="text-align: center; color: #666; margin-bottom: 30px;">Master languages one word at a time</p>
        <h2>Login</h2>
        
        <form method="POST" action="practice.php">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn">Login</button>
        </form>

        <!-- Message after form -->
        <?= $message ?>
    </div>
</body>
</html>
