<?php
if (!isset($_SESSION)) {
  session_start();
}
include_once("../Connections/connection.php");
$con = connection();


if (isset($_SESSION["UserLogin"])) {
  $user_id = $_SESSION["UserLogin"];
  $user_sql = "SELECT email_address FROM capstone_login WHERE id = $user_id";
  $user_result = $con->query($user_sql) or die($con->error);
  $user_row = $user_result->fetch_assoc();
}

$sql = "SELECT * FROM capstone_login ORDER BY id DESC";


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="index.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-dfSN5ovvR8CBlgO2JkE8Rok1O2FJyMIqVz9tlTA9d/rvxSx1p8J7S2Py3RdI3l+2" crossorigin="anonymous">

</head>

<body>
  <header>
    <nav class="nav container">
      <h2 class="nav_logo"><a href="#">TicketSphere</a></h2>
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
      <i id="menu_toggle" class="fa-solid fa-bars"></i>
    </nav>
  </header>
  <section class="hero">
    <div class="row container">
      <div class="column">
        <h2>Top free tool and extension to <br />radiply grow your business</h2>
        <p> Welcome to TicketSphere, where seamless ticketing meets exceptional experiences your gateway to hassle-free event management.
        </p>
        <div class="buttons">
          <a href="kb.php"><button class="btn">Read More</button></a>
        </div>
      </div>
      <div class="column">
        <img src="/image/FirstRightContent.svg" alt="heroImg" class="hero_img" />
      </div>
    </div>
  </section>
  <!-- Hero End-->
  </main>

  <!-- content2 -->
  <div class="secondcontainer">
    <div class="heading">
      <h2>What makes TicketSphere unique? </h2><br>
      <p> Our personalized approach, seamless integration, and commitment to user-friendly experiences not just a tool but a partner in your event success story.</p><br>
    </div><br>

    <div class="cards">
      <div class="Firstcards">
        <p>Proactive Issue Prevention</p>
        <img src="/image/firstCards.svg" alt="">
      </div>
      <br>
      <div class="Secondcards">
        <p>Increase customer satisfaction</p>
        <img src="/image/secondCards.png" alt="firstCards">
      </div>
      <br>
      <div class="Thirdcards">
        <p>Continously Improve Customer Satisfaction</p>
        <img src="/image/thirdCards.svg" alt="">
      </div>
      <br>
      <div class="Fourthcards">
        <p>Increase customer loyalty</p>
        <img src="/image/fourthCards.png" alt="">
      </div>
      <br>
    </div>
  </div>
  <br>
  <!-- content3 -->
  <div class="heading">
    <h2>How TicketSphere Empowers You:</h2><br><br>
  </div>
  <div class="Thirdrow">
    <div class="col">
      <div class="FirstColumn">
        <div class="FirstColumn_top">
          <img src="/image/cpimg1-1.svg" alt="second_image">
          <p> <b>Seamless Event Setup:</b> Effortlessly create and customize support ticket requests with our intuitive interface.</p>
        </div>
        <br>
        <br>
        <div class="FirstColumn_bottom">
          <img src="/image/cpimg1.svg" alt="third_image">
          <p> <b>Robust Ticketing System:</b>Utilize our powerful ticketing tools to manage IT requests,
            prioritize tasks, and gather comprehensive
            user information. </p><br><br>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="SecondColumn">
        <div class="SecondColumn_top">
          <p> <b>Real-time Analytics: </b>Gain insights with comprehensive analytics
            to track support ticket performance
            and user engagement. </p>
          <img src="/image/cpimg2-2.svg" alt="second_image">

        </div>
        <br>
        <br>
        <div class="SecondColumn_bottom">
          <p> <b>User Experience Optimization: </b> Elevate the user experience with easy ticket submission,
            secure processing, and personalized communication.</p>
          <img src="/image/cpimg2.svg" alt="second_image">

        </div>
      </div>
    </div>
  </div>
  <br>
  <br>
  <!-- content 4 -->
  <div class="fourthContainer">
    <div class="heading">
      <h2>Discover why more than 180,000 businesses trust TicketSphere for their event ticketing needs.</h2>
    </div>
    <div class="partnership">
      <div class="brandImages">
        <img id="firstbrand" src="/image/firstbrand.png" alt="firstbrand">
      </div>
      <div class="brandImages">
        <img id="secondbrand" src="/image/secondbrand.png" alt="secondbrand">
      </div>
      <div class="brandImages">
        <img id="thirdbrand" src="/image/thirdbrand.jpg" alt="thirdbrand">
      </div>
      <div class="brandImages">
        <img id="frthbrand" src="/image/frthbrand.png" alt="fourthbrand">
      </div>
      <div class="brandImages">
        <img id="fifthbrand" src="/image/fifthbrand.png" alt="fifthbrand">
      </div>
    </div>
    <div class="Secondpartnership">
      <div class="secondbrandImages">
        <img id="sixbrand" src="/image/sixbrand.png" alt="sixthbrand">
      </div>
      <div class="secondbrandImages">
        <img id="sevenbrand" src="/image//sevenbrand.png" alt="seventhbrand">
      </div>
      <div class="secondbrandImages">
        <img id="eightbrand" src="/image/eightbrand.svg" alt="eightbrand">
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
        <li><a href="#"><i class="fa-brands fa-github" target="_blank"></i></a></li>
        <li><a href="https://www.youtube.com/@ticketSphere"><i class="fa-brands fa-youtube" target="_blank"></i></a></li>
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
</body>

</html>