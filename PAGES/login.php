<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once("../Connections/connection.php");
$con = connection();

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email_address'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM `capstone_login` WHERE `email_address` = ? AND `password` = ?";
    
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User exists, fetch user information
        $row = $result->fetch_assoc();
        $_SESSION['UserLogin'] = $row['id']; // Assuming 'id' is the user ID column in your table
        header("Location: index.php");
        exit();
    } else {
        echo "Invalid email or password.";
    }

    $stmt->close();
} 
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="loginform-container">
        <div class="loginform-fields">
            <h2>Log in to your account</h2>
            <form action="login.php" method="post">
                <div class="inputdata">
                    <input type="text" name="email_address" id="email_address" required placeholder="Email Address"> <br>
                    <input type="password" name="password" id="password" required placeholder="Password">
                </div>
                <input class="login" type="submit" value="Login">
                <p>New Here?<span class="register"><a href="./signup.php"> Register</a> </span></p>
                <section class="login-check"><input type="checkbox" name="agree" required><span>
                        <p>By continuing I agree to the terms and conditions.</p>
                    </span></section>
            </form>
        </div>
        <div class="rightImage">
            <img src="/image/Login-amico.svg" alt="">
        </div>
    </div>
</body>

</html>