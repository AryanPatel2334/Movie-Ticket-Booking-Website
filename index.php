<?php
    session_start();
    include("connection.php");
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style11.css">
    <link rel="stylesheet" href="css/utility12.css">
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
    
        <div class="slider">
            <img src="Images/slide1.avif" alt="">
            <img src="Images/slide2.avif" alt="">
            <img src="Images/slide1.avif" alt="">
            <img src="Images/slide2.avif" alt="">
        </div>
        <section class="main">
            <div class="leftpart">
                <p class="heading">Filters</p>
                <div class="box languages">
                    <img src="Images/down-arrow.png" alt="" height="15px" class="dropdown">
                    <p>Languages</p>
                    <div class="multibox">
                        <div class="All">All</div>
                        <div class="Hindi">Hindi</div>
                        <div class="English">English</div>
                        <div class="Gujarati">Gujarati</div>
                        <div class="Tamil">Tamil</div>
                        <div class="Telugu">Telugu</div>
                        <div class="Malyalam">Malyalam</div>
                        <div class="Kannada">Kannada</div>
                        <div class="Marathi">Marathi</div>
                    </div>
                </div>
                <div class="box genres">
                    <img src="Images/down-arrow.png" alt="" height="15px">
                    <p>Genres</p>
                    <div class="multibox">
                        <div class="Drama">Drama</div>
                        <div class="Action">Action</div>
                        <div class="Thriller">Thriller</div>
                        <div class="Adventure">Adventure</div>
                        <div class="Animation">Animation</div>
                        <div class="Comedy">Comedy</div>
                        <div class="Family">Family</div>
                        <div class="Crime">Crime</div>
                        <div class="Fantasy">Fantasy</div>
                        <div class="Historical">Historical</div>
                        <div class="Musical">Musical</div>
                        <div class="Period">Period</div>
                        <div class="Romantic">Romantic</div>
                        <div class="Sci-Fi">Sci-Fi</div>
                    </div>
                </div>
                <div class="box format">
                    <img src="Images/down-arrow.png" alt="" height="15px">
                    <p>Format</p>
                    <div class="multibox">
                        <div class="D2">2D</div>
                        <div class="D3">3D</div>
                        <div class="DX4">4DX</div>
                        <div class="IMAX3">IMAX 3D</div>
                        <div class="DX43">4DX 3D</div>
                        <div class="IMAX2">IMAX 2D</div>
                    </div>
                </div>
            </div>
            <div class="rightpart">
                <p class="heading">Movies In Surat</p>
                <div class="lanchoice">
                    <div class="box">Hindi</div>
                    <div class="box">English</div>
                    <div class="box">Gujarati</div>
                    <div class="box">Tamil</div>
                    <div class="box">Telugu</div>
                    <div class="box">Malyalam</div>
                    <div class="box">Kannada</div>
                    <div class="box">Marathi</div>
                </div>
                <div class="comming">
                    <p>Comming Soon</p>
                    <p>Explore Upcomming Movies<img src="Images/down-arrow.png" alt="" height="15px"></p>
                </div>
                <div class="movies" id="movies">
                    <?php

                        $query="select*from movie";
                        $data=mysqli_query($conn,$query);
                        $total=mysqli_num_rows($data);

                        if($total>0)
                        {
                        
                            while($result=mysqli_fetch_assoc($data))
                            {
                                $image = $result['image'];
                                $mname = $result['mname'];
                                $ctype = $result['ctype'];
                                $language = $result['language'];
                        
                        
                            echo "<div class='movie'>
                             <a href='booking.php?image=$image&mname=$mname&ctype=$ctype&language=$language'>
                                    <img src='Movies/All/$image' alt='$mname'>
                            </a>
                                        <p class='title'>$mname</p>
                                        <p class='mtype'>$ctype</p>
                                        <p class='Language'>$language</p>
                                    </div>";
                            }
                        }
                    ?>
                   
                </div>
        </section>
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
<script src="js/script1.js"></script>
</body>

</html>
