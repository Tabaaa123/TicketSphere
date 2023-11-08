<?php

if (!isset($_SESSION)) {
    session_start();
}
include_once("../Connections/connection.php");
$con = connection();

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (isset($_SESSION['UserLogin'])) {
    $userID = $_SESSION['UserLogin'];
    $userDataQuery = "SELECT * FROM capstone_login WHERE id = $userID";
    $userDataResult = $con->query($userDataQuery);

    if ($userDataResult->num_rows > 0) {
        $userData = $userDataResult->fetch_assoc();
    } else {
        header("Location: login.php");
        exit();
    }
} else {
    echo "User not logged in";
    exit();
}



if (isset($_GET['submit'])) {
    $accountOwner = $_GET['accountOwner'];
    $status = $_GET['status'];
    $subject = $_GET['Subject'];
    $description = $_GET['description'];
    $contactName = $_GET['contactName'];
    $contactEmail = $_GET['contactEmail'];
    $contactPhone = $_GET['contactPhone'];
    $organization = $_GET['Organization'];
    $priority = $_GET['Priority'];
    $ticketDateSubmitted = $_GET['ticketDateSubmitted'];

    $stmt = $con->prepare("INSERT INTO `dashboard_ticket`(`Account Owner`, `Status`, `Subject`, `Description`, `Contact Name`, `Contact Email Address`, `Organization`, `Priority`, `Ticket Date Submitted`, `Contact Phone Number`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $accountOwner, $status, $subject, $description, $contactName, $contactEmail, $organization, $priority, $ticketDateSubmitted, $contactPhone);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();

    // Add a delay before redirection
    sleep(1);
    header("Location: TicketDashboard.php");
    exit();

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="newticket.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    <header>
        <nav class="nav container">
            <h2 class="nav_logo"><a href="index.php">TicketSphere</a></h2>
            <ul class="menu_items">
                <li><i id="MenuToggle" class="fa-solid fa-bars"></i></li>
                <li><a href="index.php" class="nav_link">Home</a></li>
                <li><a href="kb.php" class="nav_link">About</a></li>
                <li><a href="profile.php" class="nav_link">Profile</a></li>
                <li><a href="TicketDashboard.php" class="nav_link">Ticket</a></li>
                <?php
                if (isset($_SESSION['UserLogin'])) {
                ?>
                    <li><a href="logout.php" class="nav_link">Logout</a></li>
                <?php
                } else {
                ?>
                    <li><a href="login.php" class="nav_link">Login</a></li>
                <?php
                }
                ?>
            </ul>
            <i id="MenuToggle" class="fa-solid fa-bars"></i>
        </nav>
    </header>

    <h2>New Ticket Form</h2> <br>
    <div class="FormContainer">
        <form action="newticket.php" method="get">
            <div class="firstForm">
                <h2>Ticket Details</h2>
                <label for="accountOwner">Account Owner</label>
                <input type="text" name="accountOwner" id="Account Owner">
                <label for="status">Ticket Status</label>
                <input type="text" name="status" id="Status">
                <label for="Priority">Priority</label>
                <input type="text" name="Priority" id="Priority">
                <label for="Subject">Subject</label>
                <input type="text" name="Subject" id="Subject"><br>
                <!-- Description -->
                <label for="description">Description</label><br>
                <textarea id="Description" class="form-control" name="description" rows="4" cols="50" id="Description"></textarea><br>

            </div>
            <div class="secondForm">

                <h2>Contact Details</h2><br>
                <label for="ticketDateSubmitted">Ticket Date Submitted</label>
                <input type="date" name="ticketDateSubmitted" id="Ticket Date Submitted"><br>
                <label for="contactName">Contact Name</label>
                <input type="text" name="contactName" id="Contact Name"><br>
                <label for="contactEmail">Contact Email Address</label>
                <input type="text" name="contactEmail" id="Contact Email Address"><br>
                <label for="contactPhone">Contact Phone number</label>
                <input type="text" name="contactPhone" id="Contact Phone Number"><br>
                <label for="Organization">Organization</label>
                <input type="text" name="Organization" id="Organization"><br>
                <button type="submit" name="submit" class="btn btn-success">Submit</button>
                <input type="hidden" name="submit" value="1">
            </div>
        </form>
    </div>
    <!-- footer -->
    <div class="footer">
        <div class="topFooter">
            <p>&copy; 2023 Ticket Traverse. All rights reserved.</p>
            <p>Bldg. A. Masunurin City Lagazpi 2030</p>
        </div>
        <div class="bottomFooter">
            <p>Privacy Policy | Terms of Service</p>
            <ul>
                <li><a href="https://www.facebook.com/ticketsphere/" target="_blank"><i class="fa-brands fa-facebook"></i></a></li>
                <li><a href="#" target="_blank"><i class="fa-brands fa-github"></i></a></li>
                <li><a href="https://www.youtube.com/@ticketSphere" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
            </ul>

        </div>
    </div>
    <script>
    const header = document.querySelector("header");
    const menuToggler = document.querySelectorAll("#MenuToggle");
    menuToggler.forEach(toggler => {
      toggler.addEventListener("click", () => header.classList.toggle("showMenu"));
    });
  </script>
    <script src="https://kit.fontawesome.com/8f32176e9c.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

</body>

</html>