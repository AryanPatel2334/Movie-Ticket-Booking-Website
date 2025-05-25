<?php
    session_start();
    include("connection.php");

    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/utility12.css">
    <link rel="stylesheet" href="css/booking11.css">
    <link rel="icon" type="image/x-icon" href="logo1.png">
    <title>Flicker - Movie Ticket Booking</title>
</head>

<body>
<header>
        <div class="left">
            <img src="Images/logo1.png" alt="">
            <img src="Images/search-interface-symbol.png" alt="" class="search">
            <input type="search " placeholder="Search for Movies and Theatres">
        </div>
        <div class="right">
            <span>Surat</span>
            <img src="Images/down-arrow.png" alt="" height="13px">
            <?php
        if(!empty($_SESSION['user'])) {
            $username = $_SESSION['user'];
            echo "<div class='user'>Welcome, $username</div>";
            echo "<button><a href='logout.php'>Logout</a></button>"; // Logout button
        } else {
            echo "<button><a href='login.php'>Sign in</a></button>"; // Sign in button
        }
    ?>
        </div>
    </header>
    <nav>
        <ul>
        <li><a href="index.php">Home</a></li>
            <li><a href="#movies">Movies</a></li>
            <li><a href="showtheatre.php">Theatres</a></li>
            <li><a href="order.php">Orders</a></li>
            <li><a href="#contact">Contact us</a></li>
        </ul>
    </nav>
    <main>
        <div class="poster">
            <div class="img">
            <?php

            $image = isset($_GET['image']) ? urldecode($_GET['image']) : 'default.jpg';
            $mname = isset($_GET['mname']) ? urldecode($_GET['mname']) : 'Unknown Movie';

            ?>
                <img src="Movies/All/<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($mname); ?>">
            </div>
            <div class="details">
                <p class="title"><?php echo htmlspecialchars($mname); ?></p>
                <p class="language">Hindi</p>
                <div class="info">
                    <p class="time">2h 10m</p>
                    <p class="genres">Action, Thriller</p>
                    <p class="mtype">A</p>
                    <p class="data">10 jan,2025</p>
                </div>

                <button>
                <a href='showtheatre.php?mname=<?php echo urlencode($mname); ?>'>Book Now</a>
                </button>
            </div>
        </div>
        <div class="about">
            <p class="title">About the Movie</p>
            <p class="para"><?php echo htmlspecialchars($mname); ?> : <?php echo htmlspecialchars($mname); ?> picks up from the explosive events of the first part, following <?php echo htmlspecialchars($mname); ?>`s meteoric rise as he expands his red sandalwood empire beyond borders. As tensions escalate with rival factions and the authorities, his growing ambitions draw him into intense confrontations and political upheavals.</p>
        </div>
      
    </main>
    <footer>
        <div class="contact" id="contact">
        <div class="customer">
            <div class="care">
                <img src="Images/customer-care.png" alt="">
                <p>24/7 CUSTOMER CARE</p>
            </div>
            <div class="resend">
                <img src="Images/confirmation.png" alt="">
                <p>RESEND BOOKING CONFIRMATION</p>
            </div>
            <div class="subscribe">
                <img src="Images/email.png" alt="">
                <p>SUBSCRIBE TO THE NEWSLETTER</p>
            </div>
        </div>
        <div class="moviee">
            <div class="now">
                <p class="title">MOVIES NOW SHOWING IN SURAT</p>
                <P class="description">Sikandar | All The Best Pandya | Chhaava | A Minecraft Movie | Faati Ne? | Umbarro</P>
            </div>
            <div class="upcomming">
                <p class="title">UPCOMING MOVIES IN SURAT</p>
                <P class="description">IPL T20 2025 Live Screening | JACK | Bazooka | Vaamana | Akaal</P>
            </div>
            <div class="updates">
                <p class="title">MOVIE UPDATE AND CELEBRITIES</p>
                <P class="description">Upcoming Movies | Movies Now Showing | Movie Celebrities </P>
            </div>
        </div>
        <div class="logo">
            <div class="line1"></div>
            <img src="Images/logo1.png" alt="">
            <div class="line2"></div>
        </div>
        <div class="social">
            <img src="Images/facebook.png" alt="">
            <img src="Images/twitter.png" alt="">
            <img src="Images/instagram.png" alt="">
            <img src="Images/youtube.png" alt="">
            <img src="Images/pinterest.png" alt="">
            <img src="Images/linkedin.png" alt="">
        </div>
        <div class="copy">
            <p>Copyright 2025 &copy Flicker Entertainment Pvt. Ltd. All Rights Reserved.</p>
        </div>
        </div>
    </footer>
    <script src="js/booking1.js"></script>
</body>

</html>