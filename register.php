<?php
include("connection.php");

if (isset($_POST["submit"])) {
    // Retrieve form data
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $phone_number = $_POST["phone_number"];
    $email = $_POST["email"];
   $password = $_POST["password"];
    $role=$_POST["role"];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the query
    $query = "INSERT INTO users (first_name, last_name, phone_number, email, password, role) 
              VALUES ('$first_name', '$last_name', '$phone_number', '$email', '$hashed_password', '$role')";

   $result=mysqli_query($conn, $query);

    // Check if query execution was successful
    if (!$result) {
        // Print the error message if query fails
        die('Error executing query: ' . mysqli_error($conn));
    } else {
       header('location:login.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="amani.css"> 
   <style>
    .logo{
            width:20%;
    transform:translate(200%);
    border:1px solid grey;
         }
    .select{
        width:95%;
        padding:10px;
    }

   </style>
</head>
<body>
    <div class="container">
      
        <form action="register.php" method="POST">
        <img src="liblogo1.jpeg" alt="logo" class="logo">
            <h1>Student Registration</h2>
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required><br>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required><br>

            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

        

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <label>Role:</label>
            
            <select name="role">
                <option>Buyer</option>
                <option>Owner</option>
                
            </select>

            
            <br><br>

         
            <button type="submit" name="submit">Register</button>
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </form>
    </div>



</body>

</html>

