<?php
    session_start();
    include("connection.php");

    if(!empty($_SESSION['user']))
     {
     $username = $_SESSION['user'];
      }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/order1.css">
    <link rel="stylesheet" href="css/utility12.css">
    <link rel="icon" type="image/x-icon" href="logo1.png">
    <title>Flicker - Your Orders</title>
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
        <div class="main">
                        <?php
        date_default_timezone_set("Asia/Kolkata");
        $current_time = date("H:i");

        if (!empty($_SESSION['user'])) {
            $username = $_SESSION['user'];
            // echo " <p class='username'>$username Your Ticket is here</p>";

            $query = "SELECT 
                b.mname AS movie_name, 
                t.name AS theatre_name, 
                b.total_price AS ticket_price, 
                c.name AS customer_name, 
                m.image As image1,
                DATE_FORMAT(s.time, '%h:%i %p') AS formatted_time, 
                DATE_FORMAT(b.booking_date, '%h:%i %p') AS dateandtime,
                b.total_seats
            FROM bookings b
            JOIN theatres t ON b.theatre_id = t.theatre_id
            JOIN customer c ON b.customer_id = c.customer_id
            JOIN movie m ON b.mname = m.mname
            JOIN showtimes s ON b.sid = s.sid
            WHERE c.name = '$username'";

            $data = mysqli_query($conn, $query);

            if (!$data) {
                die("Query Failed: " . mysqli_error($conn));
            }

            $total = mysqli_num_rows($data);

            if ($total > 0) {
                while ($result = mysqli_fetch_assoc($data)) {
                    $mname = $result['movie_name'];
                    $tname = $result['theatre_name'];
                    $price = $result['ticket_price'];
                    $bdate = $result['dateandtime'];
                    $showtime = $result['formatted_time'];
                    $seat = $result['total_seats'];
                    $image = $result['image1'];

                    echo " <div class='ticket'>
                <div class='img'>
                    <img src='Movies/All/$image' alt=''>
                </div>
                <div class='cutout1'>
    
                </div>
                <div class='cutout2'>
    
                </div>
                <div class='linee'></div>
                <div class='details'>
                    
                    <div class='mname'>
                        <p>$mname</p>
                    </div>
                    <div class='date'>
                        <p>Bookingtime: $bdate | Showtime: $showtime</p>
                    </div>
                    <div class='tname'>
                        <p>$tname : Katargam</p>
                    </div>
                    <div class='seats'>
                        <p>Quantity : $seat</p>
                        <div class='total'>
                            <img src='Images/seat.png' alt=''>
                            <p>SILVER - F Row</p>
                        </div>
                    </div>
                    <div class='screen'>
                        <p>Screen 2</p>
                    </div>
                    <div class='price'>
                        <p>Ticket Price</p>
                        <p>₹ $price</p>
                    </div>
                    
                    <div class='fees'>
                        <p>No convenience fees</p>
                    </div>
                    <div class='linee2'></div>
                    <div class='paid'>
                        <p>Amount Paid</p>
                        <p class='fprice'>₹ $price</p>
                    </div>
    
                    </div>
                </div>";
                }
            } else {
                echo "<div class='no-tickets'><p>No tickets booked yet.</p></div>";
            }
        } else {
            echo "<div class='no-tickets'><p>Please log in to view your orders.</p></div>";
        }
?>

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
</body>
</html>
