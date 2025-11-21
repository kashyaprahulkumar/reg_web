<?php
require_once 'config.php'; // Include database connection and session_start()

$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // Hash the password for security
    $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Prepare and execute the statement
    // NOTE: This version is still using string concatenation in the SQL, 
    // but the inputs are escaped with mysqli_real_escape_string. 
    // For best practice, switch to Prepared Statements (mysqli_stmt_prepare).
    $sql = "INSERT INTO users (first_name, last_name, gender, email, password, phone)
            VALUES ('$first_name', '$last_name', '$gender', '$email', '$password_hash', '$phone')";

    if ($conn->query($sql) === TRUE) {
        $message = "<div class='message success'>Registration successful! You can now log in.</div>";
    } else {
        // Specifically check for duplicate email error (Error 1062)
        if ($conn->errno == 1062) {
             $message = "<div class='message error'>Error: This email is already registered.</div>";
        } else {
            $message = "<div class='message error'>Error: " . $conn->error . "</div>";
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Register</h2>
    <?php echo $message; ?>
    <form action="register.php" method="POST">
        <label>First Name:</label>
        <input type="text" name="first_name" required>

        <label>Last Name:</label>
        <input type="text" name="last_name" required>

        <label>Gender:</label>
        <select name="gender" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <label>Phone Number:</label>
        <input type="text" name="phone" required>

        <input type="submit" value="Register" class="btn">
    </form>
    <p class="link-text">Already have an account? <a href="login.php">Log In</a></p>
</div>
</body>
</html>