<?php
require_once 'config.php';

// If the user is already logged in, redirect them to the welcome page
if (isset($_SESSION['user_id'])) {
    header("Location: welcome.php");
    exit;
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Retrieve user record based on email
    $sql = "SELECT id, first_name, password FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $hashed_password = $user['password'];

        // Verify the password against the hash
        if (password_verify($password, $hashed_password)) {
            // Success: Set session variables and redirect
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];
            header("Location: welcome.php");
            exit;
        } else {
            $message = "<div class='message error'>Invalid email or password.</div>";
        }
    } else {
        $message = "<div class='message error'>Invalid email or password.</div>";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Log In</h2>
    <?php echo $message; ?>
    <form action="login.php" method="POST">
        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <input type="submit" value="Log In" class="btn">
    </form>
    <p class="link-text">Don't have an account? <a href="register.php">Register Here</a></p>
</div>
</body>
</html>