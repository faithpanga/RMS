<?php
include("connection.php");
session_start();

if (isset($_POST["submit"])) {
    // Retrieve form data
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Escape email to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $email);

    // Query to find the user by email
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    // Check if a result was returned
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on user role
            if ($user['role'] === 'buyer') {
                header('Location: buyer_dashboard.php'); 
            } elseif ($user['role'] === 'owner') {
                header('Location: owner_dashboard.php'); 
            } elseif ($user['role'] === 'admin') {
                header('Location: admin_dashboard.php'); 
            } else {
                echo 'Unknown role';
            }
            exit();
        } else {
            echo 'Wrong email or password';
        }
    } else {
        echo 'No user found with that email';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .logo {
            width: 80px;
            transform: translate(10%);
            border: 1px solid grey;
        }
        .container {
            text-align: center;
            background-color: white;
            border: 2px solid black;
            padding: 20px;
            border-radius: 10px;
            margin: 50px auto;
            width: 40%;
            font-size: large;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        .btn {
            border-radius: 5px;
            padding: 5px 20px;
            color: #fff;
            font-size: 15px;
            background-color: blue;
            display: inline-block;
            margin-right: 10px;
        }
        .btn:hover {
            background-color: grey;
        }
        input {
            width: 90%;
            padding: 10px;
            margin-bottom: 10px;
        }
        .links {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .link-button {
            margin: 0 10px;
            text-decoration: none;
            color: #007BFF;
            font-weight: 500;
        }
        .link-button:hover {
            color: #0056b3;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="links">
        <a href="index.php" class="link-button">Home</a>
        <a href="register.php" class="link-button">Register</a>
        <a href="contact_us.php" class="link-button">Contact Us</a>
        <a href="about_us.php" class="link-button">About Us</a>
    </div>

    <div class="container">
        <form action="login.php" method="POST">
            <img src="logo.png" alt="logo" class="logo">
            <h1><u>Login</u></h1>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="password" id="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="submit" class="btn">Login</button>
            <p>Don't have an account? <a href="register.php">Register here</a></p>
            <p>Forgot your password? <a href="forgot_password.php">Reset Password</a></p>
        </form>
    </div>
</body>
</html>
