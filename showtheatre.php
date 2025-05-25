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
    <link rel="stylesheet" href="css/theatres.css">
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
            <li><a href="index.php">Movies</a></li>
            <li><a href="showtheatre.php">Theatres</a></li>
            <li><a href="order.php">Orders</a></li>
            <li><a href="#contact">Contact us</a></li>
        </ul>
    </nav>
    <main>
        <div class="titlee">
            <?php
            $mname = isset($_GET['mname']) ? urldecode($_GET['mname']) : 'Unknown Movie';
            ?>
            <div class="mname">
                <p><?php echo htmlspecialchars($mname); ?></p>
            </div>
            <div class="capsules">
                <div class="capsule1">
                    <p>ACTION</p>
                </div>
                <div class="capsule2">
                    <P>THRILLER</P>
                </div>
            </div>
            <div class="linee"></div>
            <div class="detailss">
                <div class="dates">
                    <div class="date1">
                        <p class="day">MON</p>
                        <p class="date">13</p>
                        <p class="month">JAN</p>
                    </div>
                    <div class="date2">
                        <p class="day">THU</p>
                        <p class="date">14</p>
                        <p class="month">JAN</p>
                    </div>
                    <div class="date2">
                        <p class="day">WED</p>
                        <p class="date">15</p>
                        <p class="month">JAN</p>
                    </div>
                    <div class="date2">
                        <p class="day">THU</p>
                        <p class="date">16</p>
                        <p class="month">JAN</p>
                    </div>
                </div>
                <div class="filters">
                    <div class="linee"></div>
                    <div class="ttype">
                        <p>Hindi-2D</p>
                    </div>
                    <div class="linee"></div>
                    <div class="region">
                        <p>Filter Sub Regions</p>
                    </div>
                    <div class="linee"></div>
                    <div class="price">
                        <p>Filter Price Range</p>
                    </div>
                    <div class="linee"></div>
                    <div class="timing">
                        <p>Filter Show Timings</p>
                    </div>
                    <div class="linee"></div>   
                </div>
            </div>
        </div>
        <div class="AllTheatres">
            <div class="theatres">
                <div class="headingg">
                    <div class="dot1"></div>
                    <p>AVAILABLE</p>
                    <div class="dot2"></div>
                    <p>FAST AVAILABLE</p>
                    <p class="lan">LAN</p>
                    <p>SUBTITLES LANGUAGE</p>
                </div>

                <?php
                    date_default_timezone_set("Asia/Kolkata"); // Set the correct timezone
                    $current_time = date("H:i"); // Get current time in 24-hour format (HH:MM)

                    $query="SELECT * FROM theatres";    
                    $data=mysqli_query($conn,$query);
                    $total=mysqli_num_rows($data);

                    if($total>0) {
                        while($result=mysqli_fetch_assoc($data)) {
                        $theatre_id = $result['theatre_id'];
                        $name = $result['name'];
                        $location = $result['location'];

                            echo "<div class='separater'></div>
                                <div class='theatre'>
                                    <div class='name'>
                                        <p>$name: $location</p>
                                    </div>
                                    <div class='info'>
                                        <p>info</p>
                                    </div>";

        // Fetch showtimes for this theatre
        $mname = isset($_GET['mname']) ? mysqli_real_escape_string($conn, urldecode($_GET['mname'])) : '';
        $query1="SELECT DATE_FORMAT(time, '%H:%i') AS raw_time, DATE_FORMAT(time, '%h:%i %p') AS formatted_time, sid, price, theatre_id FROM showtimes WHERE theatre_id = '$theatre_id' and  mid = (SELECT mid FROM movie WHERE mname = '$mname')";
        $data1=mysqli_query($conn,$query1);
        $total1=mysqli_num_rows($data1);

        if($total1>0) {
            echo "<div class='times'>";
            while($result1=mysqli_fetch_assoc($data1)) {
                $time = $result1['formatted_time'];
                $raw_time = $result1['raw_time'];
                $price = $result1['price'];
                $id = $result1['theatre_id'];
                $sid = $result1['sid'];

                // Check if the showtime is in the past
                $past_class = ($raw_time < $current_time) ? "past-time" : "";

                echo "<div class='time $past_class' data-time='$raw_time' data-price='₹$price'>
                <p> <a href='seatlayout.php?&mname=$mname&sid=$sid&time=$time&price=$price&id=$id&location=$location' class='seat-link'>
                          $time</a></p>
            </div>"; 
            }
            echo "</div>";
        }

        echo "</div>"; // Close theatre div
    }
}
?>

            </div>
        </div>
    </main>
    <footer>
        <div class="contactt" id="contact">
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
    <script src="js/theatres.js"></script>
</body>
</html>