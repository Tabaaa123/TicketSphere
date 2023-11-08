<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="kb.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    <header>
        <nav class="nav container">
            <h2 class="nav_logo"><a href="index.php">TicketSphere</a></h2>
            <ul class="menu_items">
                <li><i id="menuToggle" class="fa-solid fa-bars"></i></li>
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
            <i id="menuToggle" class="fa-solid fa-bars"></i>
        </nav>
    </header>
    <div class="containerHeading">
        <h2>Welcome to TicketSphere Knowledge Base!</h2>
    </div>
    <div class="flex-container">
        <div class="introContainer">
            <p>Here, you'll find a comprehensive guide to help you navigate and make the most of our ticketing platform. Whether you're new to the system or looking to enhance your experience, our step-by-step instructions, FAQs, and helpful tips will guide you through the ins and outs of signing up, signing in, and effortlessly managing your tickets. Let's embark on a journey to streamline your ticketing processes and make your experience seamless and efficient.</p>
        </div>
        <img src="/image/Project Stages-bro.svg" alt="">
    </div>
    <br>
    <div class="Stepheading">
    <h2>Step-by-Step Guide: From Signup to Ticket Submission in TicketSphere</h2>
    </div><br><br>
    <div class="stepContainer">
        <div class="stepOne">
            <img src="/image//Sign up-cuate.svg" alt="">
            <ul>
                <h5>Step 1: Sign Up</h5>
                <li>
                    <p>Navigate to the Signup Page</p>
                </li>
                <li>
                    <p>Provide User Information: Fill in the required information, including a unique username and a secure password.</p>
                </li>
                <li>
                    <p>Submit the Form: Click on the "Signup" button to submit your information.</p>
                </li>
                <li>
                    <p>Account Creation: Upon successful signup, your account will be created.</p>
                </li>
                <li>
                    <p>
                    <p>Dashboard Access: Upon successful signup, you will be directed to the ticket dashboard or home page.</p>
                    </p>
                </li>
            </ul>
        </div>
        <div class="stepTwo">
            <ul>
                <h5>Step 1: Sign In</h5><br>
                <li>
                    <p>Go to the Signin Page</p>
                </li>
                <li>
                    <p>Enter Credentials: Provide your email-address and password in the respective fields.</p>
                </li>
                <li>
                    <p>Click Signin: Click on the "Signin" button to log in to your account.</p>
                </li>
                <li>
                    <p>Dashboard Access: Upon successful signin, you will be directed to the ticket dashboard or home page.</p>
                </li>
            </ul>
            <img src="/image/Login-cuate.svg" alt="">
        </div>
    </div><br>
    <div class="stepTwoContainer">
        <div class="stepOne">
            <img src="/image/Files sent-cuate.svg" alt="">
            <ul>
                <h5>Step 2: Create a New Ticket</h5><br>
                <li>
                    <p>Access Ticket Creation Page: Look for an option or button to create a new ticket, often labeled as "Create Ticket" or similar.</p>
                </li>
                <li>
                    <p>Fill Ticket Details: Enter details for the new ticket, including status, subject, and a detailed description.</p>
                </li>
                <li>
                    <p>Submit Ticket: Click on the "Submit" or "Create Ticket" button to submit the new ticket.</p>
                </li>
                <li>
                    <p>Confirmation: Yhe new ticket will appear on your dashboard.</p>
                </li>
            </ul>
        </div>
        <div class="stepTwo">
            <ul>
                <h5>Step 3: View and Manage Tickets</h5>
                <li>
                    <p>Navigate to Ticket Dashboard: Find and click on the "Ticket Dashboard" section to view your submitted tickets.</p>
                </li>
                <li>
                    <p>Edit Ticket Details: If needed, you can edit the details of a ticket, such as status, priority, or description.</p>
                </li>
                <li>
                    <p>Delete a Ticket: Systems allow you to delete a ticket if it's no longer relevant. Be cautious, as this action may be irreversible.</p>
                </li>
                <li>
                    <p>Track Ticket Status: Monitor the status of your tickets to stay updated on their progress. </p>
                </li>
            </ul>
            <img src="/image/View.svg" alt="">
        </div>
    </div>
    <div class="accordionHeading">
        <h2>Exploring Frequently Asked Questions (FAQ) – Your Guide to a Smooth Ticketing Experience</h2>
    </div> <!-- Accordion FAQ -->
    <div class="accordion">
        <!-- make a simple accordion -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <i class="fa-solid fa-question-circle"></i> How do I create a new ticket?
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p>Click on the "New Ticket" button to create a new ticket.</p>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <i class="fa-solid fa-question-circle"></i> How do I edit a ticket?
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p>Click on the "Pencil" icon to edit a ticket.</p>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <i class="fa-solid fa-question-circle"></i> How do I delete a ticket?
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p>Click on the "Trash/Bin" icon to delete a ticket.</p>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    <i class="fa-solid fa-question-circle"></i> Can I edit a Contact Name, Contact Email Address, and Contact Phone Number?
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p>Unfortunately, due to privacy policy restrictions, editing a Contact Name, Contact Email Address, and Contact Phone Number is not allowed. However, you can create a new ticket for a new Contact Name, Contact Email Address, or Contact Phone Number.</p>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    <i class="fa-solid fa-question-circle"></i> If I am unable to log in, can I still create a new ticket or access the Ticket Dashboard?
                </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p>No, for security reasons, you are not allowed to create a new ticket or access the Ticket Dashboard.</p>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    <i class="fa-solid fa-question-circle"></i> If I have questions or concerns, do you have support staff that I can reach out to?
                </button>
            </h2>
            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p> We are actively working on expanding our support staff for 24/7 assistance. Currently, you can reach out to us via Facebook, Instagram, or Gmail from Monday to Friday, 8 am to 5 pm.</p>
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




    <script>
        const header = document.querySelector("header");
        const menuToggler = document.querySelectorAll("#menuToggle");
        menuToggler.forEach(toggler => {
            toggler.addEventListener("click", () => header.classList.toggle("showMenu"));
        });
    </script>


    <script src="https://kit.fontawesome.com/8f32176e9c.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

</body>

</html>