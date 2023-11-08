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
        $user = $userDataResult->fetch_assoc(); // Fix: Use $user instead of $userData
    } else {
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}

// Handle the navigation logic
$currentMonth = isset($_GET['month']) ? intval($_GET['month']) : date('n');
$currentYear = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

function generateCalendar($currentMonth, $currentYear)
{
    $numDays = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

    echo "<h3>" . date("F Y", mktime(0, 0, 0, $currentMonth, 1, $currentYear)) . "</h3>";
    echo "<table border='1'>";
    echo "<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>";

    $firstDay = date("w", mktime(0, 0, 0, $currentMonth, 1, $currentYear));
    $dayCount = 1;

    echo "<tr>";
    for ($i = 0; $i < $firstDay; $i++) {
        echo "<td></td>";
        $dayCount++;
    }

    for ($day = 1; $day <= $numDays; $day++) {
        echo "<td>$day</td>";

        if ($dayCount % 7 == 0) {
            echo "</tr><tr>";
        }

        $dayCount++;
    }

    echo "</tr>";
    echo "</table>";

    // Add "Next" and "Previous" icons for navigating to the next and previous months
    $nextMonth = date('n', strtotime('+1 month', mktime(0, 0, 0, $currentMonth, 1, $currentYear)));
    $nextYear = date('Y', strtotime('+1 month', mktime(0, 0, 0, $currentMonth, 1, $currentYear)));
    $prevMonth = date('n', strtotime('-1 month', mktime(0, 0, 0, $currentMonth, 1, $currentYear)));
    $prevYear = date('Y', strtotime('-1 month', mktime(0, 0, 0, $currentMonth, 1, $currentYear)));

    echo "<a href='?month=$prevMonth&year=$prevYear'>Previous <i class='fa-solid fa-angles-left'></i></a>";
    echo " | ";
    echo "<a href='?month=$nextMonth&year=$nextYear'><i class='fa-solid fa-angles-right'></i></i> Next</a>";
}


if (isset($_POST['submit'])) {
    $notes = $_POST['notes'];
    $noteDate = $_POST['date'];
    $userID = $_SESSION['UserLogin'];

    // Check if a record for the user already exists
    $checkQuery = "SELECT * FROM capstone_login WHERE id = $userID";
    $checkResult = $con->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // If a record exists, update it
        $updateQuery = "UPDATE capstone_login SET capstone_notes = '$notes', note_date = '$noteDate' WHERE id = $userID";
        $updateResult = $con->query($updateQuery);

        if ($updateResult) {
            echo "<script>alert('Notes Updated');</script>";
        } else {
            echo "<script>alert('Notes Not Updated');</script>";
        }
    } else {
        // If no record exists, insert a new one
        $insertQuery = "INSERT INTO capstone_login (id, capstone_notes, note_date) VALUES ($userID, '$notes', '$noteDate')";
        $insertResult = $con->query($insertQuery);

        if ($insertResult) {
            echo "<script>alert('Notes Submitted');</script>";
        } else {
            echo "<script>alert('Notes Not Submitted');</script>";
        }
    }
}







$userID = $_SESSION['UserLogin'];
$sql = "SELECT `capstone_notes`,`note_date` FROM capstone_login WHERE id = $userID";
$result = $con->query($sql);

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="profile.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <header>
        <nav class="nav container">
            <h2 class="nav_logo"><a href="index.php">TicketSphere</a></h2>
            <ul class="menu_items">
                <li><i id="menu_toggle" class="fa-solid fa-bars"></i></li>
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
            <i id="menu_toggle" class="menu_toggle fa-solid fa-bars"></i>
        </nav>
    </header>

    <!-- content -->
    <main>
        <section class="profile_container">
            <div class="profile_avatar">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="personalContainer">
                <h2>Personal Details</h2>
                <ul>
                    <li>First Name: <?php echo $user['first_name']; ?></li><br>
                    <li>Last Name: <?php echo $user['last_name']; ?></li><br>
                    <li>Email Address: <?php echo $user['email_address']; ?></li>
                </ul>
            </div>
            <div class="CompanyContainer">
                <h2>Organization Details</h2>
                <ul>
                    <li>Company Name: <?php echo $user['CompanyName']; ?></li><br>
                    <li>Department: <?php echo $user['Department']; ?></li><br>
                    <li>Title: <?php echo $user['Title']; ?></li>
                </ul>
            </div>
        </section>
        <div class="calendar2023">
            <?php generateCalendar($currentMonth, $currentYear); ?>
        </div>
        <div class="To-Do-List">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Notes</th>
                        <th>Notes Date Submitted</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "
                        <tr>
                            <td>{$row['capstone_notes']}</td>
                            <td>{$row['note_date']}</td>
                        </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>No data available</td></tr>";
                    }
                    ?>
                </tbody>
                <form method="POST" action="">
                    <tr>
                        <td>
                            <input type="text" class="form-control" name="notes" id="capstone_notes" placeholder="Enter Notes">
                        </td>
                        <td>
                            <input type="date" class="form-control" name="date" id="note_date" placeholder="Enter Date">
                        </td>
                        <td>
                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                        </td>
                    </tr>
                </form>
            </table>
        </div>
    </main>

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
        const menuToggler = document.querySelectorAll("#menu_toggle");
        menuToggler.forEach(toggler => {
            toggler.addEventListener("click", () => header.classList.toggle("showMenu"));
        });
    </script>



    <script src="https://kit.fontawesome.com/8f32176e9c.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

</body>

</html>