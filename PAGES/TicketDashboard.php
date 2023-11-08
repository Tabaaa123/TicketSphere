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
    header("Location: login.php");
    exit();
}

// Check if the form is submitted for updating
if (isset($_POST['update'])) {
    $ticketId = $_POST['ticketId'];
    $priority = $_POST['editPriority'];
    $status = $_POST['editStatus'];
    $subject = $_POST['editSubject'];
    $description = $_POST['editDescription'];
    $editContactName = $_POST['editContactName'];
    $editContactEmail = $_POST['editContactEmailAddress'];
    $editContactPhoneNumber = $_POST['editContactPhoneNumber'];


    $sql = "UPDATE dashboard_ticket SET Status = ?, Subject = ?, Description = ?, `Contact Name` = ?, `Contact Email Address` = ?, `Contact Phone Number` = ?, Priority = ? WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssssssi", $status, $subject, $description, $editContactName, $editContactEmail, $editContactPhoneNumber, $priority, $ticketId);
    $stmt->execute();
    $stmt->close();

    // Redirect to the ticket dashboard page after updating
    header("Location: ticketDashboard.php");
    exit();
}
// delete form submission
if (isset($_POST['delete'])) {
    $ticketId = $_POST['ticketId'];
    $sql = "DELETE FROM dashboard_ticket WHERE id = $ticketId";
    $con->query($sql) or die($con->error);
    header("Location: ticketDashboard.php");
    exit();
}



$sql = "SELECT id, Status, `Account Owner`, Organization, Priority, Subject, Description, `Contact Name`, `Contact Email Address`, `Contact Phone Number`,`Ticket Date Submitted`FROM dashboard_ticket";
$result = $con->query($sql);

// Initialize $rowCount to 0
$rowCount = $result->num_rows;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Dashboard</title>
    <link rel="stylesheet" href="TicketDashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <header>
        <nav class="nav container">
            <h2 class="nav_logo"><a href="index.php">TicketSphere</a></h2>
            <ul class="menu_items">
                <li><i id="menu_Toggle" class="fa-solid fa-bars"></i></li>
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
            <i id="menu_Toggle" class="fa-solid fa-bars"></i>
        </nav>
    </header>

    <!-- content -->
    <div class="container">
        <!-- Search bar -->
        <br>
        <div>
            <input type="text" class="form-control" id="searchInput" placeholder="Search by Account Owner, ID etc...">
            <i class="bi bi-search"></i>
        </div>
        <br>
        <!-- add button -->
        <a href="newticket.php"><button class="btn btn-success add-btn"> <i class="fa-solid fa-circle-plus"></i> New Ticket</button></a>
        <!-- table -->
        <table class="table table-bordered">
        <h2>Ticket Dashboard</h2>
            <thead>
                <tr>
                    <th>Ticket ID</th>
                    <th>Ticket Date Submitted</th>
                    <th>Status</th>
                    <th>Account Owner</th>
                    <th>Contact Name</th>
                    <th>Organization</th>
                    <th>Priority</th>
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($rowCount > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr data-contact-name='{$row['Contact Name']}' data-contact-email='{$row['Contact Email Address']}' data-contact-phone-number='{$row['Contact Phone Number']}'>
            <td>{$row['id']}</td>
            <td style='white-space: nowrap;'>{$row['Ticket Date Submitted']}</td>
            <td style='white-space: nowrap;'>{$row['Status']}</td>
            <td style='white-space: nowrap;'>{$row['Account Owner']}</td>
            <td style='white-space: nowrap;'>{$row['Contact Name']}</td>
            <td style='white-space: nowrap;'>{$row['Organization']}</td>
            <td style='white-space: nowrap;'>{$row['Priority']}</td>
            <td style='white-space: nowrap;'>{$row['Subject']}</td>
            <td style='white-space: nowrap;'>{$row['Description']}</td>
            <td class='d-inline-flex'>                
                    <button class='btn btn-primary edit-btn' data-id='{$row['id']}'><i class='fa-regular fa-pen-to-square'></i></button>
                <form method='POST' class='delete-form'>
                    <input type='hidden' name='ticketId' value='{$row['id']}'>
                    <button type='submit' name='delete' class='btn btn-danger delete-btn'><i class='fa-regular fa-trash-can'></i></button>
                </form>
            </td>
        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='15'>No data available</td></tr>";
                }
                ?>
            </tbody>



        </table>
        <!-- Bootstrap modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Ticket</h5>
                    </div>
                    <div class="modal-body">
                        <form method="POST" class="edit-form-row">
                            <input type="hidden" name="ticketId" id="editTicketId" value="">
                            <div class="mb-3">
                                <label for="editContactName" class="form-label">Contact Name</label>
                                <input type="text" class="form-control" name="editContactName" id="editContactName" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="editContactEmailAddress" class="form-label">Contact Email Address</label>
                                <input type="text" class="form-control" name="editContactEmailAddress" id="editContactEmailAddress" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="editContactPhoneNumber" class="form-label">Contact Phone Number</label>
                                <input type="text" class="form-control" name="editContactPhoneNumber" id="editContactPhoneNumber" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="editStatus" class="form-label">Status</label>
                                <input type="text" class="form-control" name="editStatus" id="editStatus" required>
                            </div>
                            <div class="mb-3">
                                <label for="editPriority" class="form-label">Priority</label>
                                <input type="text" class="form-control" name="editPriority" id="editPriority" required>
                            </div>
                            <div class="mb-3">
                                <label for="editSubject" class="form-label">Subject</label>
                                <input type="text" class="form-control" name="editSubject" id="editSubject" required>
                            </div>
                            <div class="mb-3">
                                <label for="editDescription" class="form-label">Description</label>
                                <textarea id="editDescription" class="form-control" name="editDescription" rows="4" cols="50" id="editDescription" required></textarea>
                            </div>
                            <button type="submit" name="update" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-danger cancel-edit-btn">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
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
        <!-- script -->
        <script src="https://kit.fontawesome.com/8f32176e9c.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
        <script src="TicketDashboard.js"></script>
</body>

</html>