<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once("../Connections/connection.php");
$con = connection();

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (isset($_POST['signup'])) {
    $email = $_POST['email_address'];
    $password = $_POST['password'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];

    $sql = "INSERT INTO `capstone_login` (`email_address`, `password`, `first_name`, `last_name`) 
            VALUES ('$email', '$password', '$firstName', '$lastName')";

    try {
        $result = $con->query($sql);

        if (!$result) {
            throw new Exception("Error: " . $con->error);
        }
        $_SESSION['UserLogin'] = $con->insert_id;

        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="signup.css">
</head>

<body>
    <div class="signup-container">
        <div class="signup-fields">
            <h2>Welcome to Ticket Traverse</h2>
            <form action="" method="post">
                <label>First Name</label>
                <br>
                <input type="text" name="first_name" id="first_name" required placeholder="Enter your First name here..">
                <br>
                <label>Last Name</label>
                <br>
                <input type="text" name="last_name" id="last_name" required placeholder="Enter your Last name here..">
                <br>
                <label>Email Address</label>
                <br>
                <input type="email" name="email_address" id="email_address" required placeholder="Enter your e-mail address here..">
                <br>
                <label>Password</label>
                <br>
                <input type="password" name="password" id="password" required placeholder="Enter your desired password here..">
                <br>
                <input class="signup" type="submit" name="signup" value="Register">
                <section class="loginLink">Already have an account? <a href="./login.php"> Login</a></section>
            </form>
        </div>
        <div class="rightImage">
            <img src="/image/Sign up-bro.svg" alt="">
        </div>
    </div>

</body>

</html>