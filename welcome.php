<?php
require_once 'config.php';

// Check if the user is logged in. If not, redirect to login page.
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$first_name = $_SESSION['first_name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Custom style for the welcome page */
        .welcome-content {
            text-align: center;
            padding: 40px 0;
        }
        .welcome-content h1 {
            color: #28a745;
            font-size: 2.5em;
        }
        .welcome-content p {
            color: #6c757d;
            font-size: 1.1em;
            margin-top: 15px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="welcome-content">
        <h1>Welcome, <?php echo htmlspecialchars($first_name); ?>!</h1>
        <p>You have successfully logged in to your secure dashboard.</p>
        <p>This is your personalized area.</p>
        
        <a href="logout.php" class="btn" style="background: #dc3545; margin-top: 30px;">Log Out</a>
    </div>
</div>
</body>
</html>