<?php
    session_start();
    include("connection.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/admin11.css">
    <link rel="icon" type="image/x-icon" href="logo1.png">
</head>
<body>
    <div class="container">
        <div class="navigation">
            <div class="logo">
                <a href="">
                    <span class="icon"><img src="Images/logo1.png" alt="" class="invert"></span>
                    <span class="title">Flicker</span>
                </a>
                 <div class="close">
                        <img src="images/close.png" alt="">
                    </div>
            </div>
            <ul>
                <li>
                    <a href="admin.php">
                        <span class="icon"><img src="Images/home.png" alt="" class="invert"></span>
                        <span class="title">Home</span>
                    </a>
                </li>
                <li>
                    <a href="customer.php">
                        <span class="icon"><img src="Images/user.png" alt="" class="invert"></span>
                        <span class="title">Customers</span>
                    </a>
                </li>
                <li>
                    <a href="addmovie.php">
                        <span class="icon"><img src="Images/clapperboard.png" alt="" class="invert"></span>
                        <span class="title">Movies</span>
                    </a>
                </li>
                <li>
                    <a href="theatre1.php">
                        <span class="icon"><img src="Images/movie-ticket.png" alt="" class="invert"></span>
                        <span class="title">Theatres</span>
                    </a>
                </li>
                <li>
                    <a href="addseat.php">
                        <span class="icon"><img src="Images/seat.png" alt="" class="invert"></span>
                        <span class="title">Seats</span>
                    </a>
                </li>
                <li>
                    <a href="showtime.php">
                        <span class="icon"><img src="Images/cinema.png" alt="" class="invert"></span>
                        <span class="title">Showtime</span>
                    </a>
                </li>
                <li>
                    <a href="shows.php">
                        <span class="icon"><img src="Images/shows.png" alt="" class="invert"></span>
                        <span class="title">Shows</span>
                    </a>
                </li>
                <li>
                    <a href="ticketbook.php">
                        <span class="icon"><img src="Images/movie-ticket.png" alt="" class="invert"></span>
                        <span class="title">Bookings</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>

    <!-- ==========main============= -->

    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <img src="Images/Hamburger.png" alt="">
            </div>

            <div class="search">
                <label>
                    <input type="search" placeholder="search here">
                    <img src="Images/search-interface-symbol.png" alt="">
                </label>
            </div>

            <div class="user">
                <img src="Images/Aryan.jpg" alt="">
            </div>

            <div class="dashboard">
                <h1>Dashboard</h1>
            </div>
            <?php

             if(!empty($_SESSION['user'])) {
            $username = $_SESSION['user'];
            echo "<div class='user1'>Welcome, $username</div>";
            echo "<button><a href='logout.php'>Logout</a></button>"; // Logout button
         } else {
            echo "<button><a href='login.php'>Sign in</a></button>"; // Sign in button
         }

        ?>
        </div>

        <!-- cards -->

        <div class="cardbox">
            <div class="card">
                <div>
        <?php

        $query = "SELECT COUNT(*) AS total_records FROM movie";
        $data = mysqli_query($conn,$query);
        $total = mysqli_num_rows($data);

        if($total>0)
        {

            while($result = mysqli_fetch_assoc($data))
            {

                echo "<div class='numbers'>".$result['total_records']."</div>";
            }
        }
        ?>
                    <div class="cardname">Movies</div>
                </div>
                <img src="images/clapperboard.png" alt="">
            </div>

            <div class="card">
                <div>
                <?php

                    $query = "SELECT COUNT(*) AS total_records FROM theatres";
                    $data = mysqli_query($conn,$query);
                    $total = mysqli_num_rows($data);

                    if($total>0)
                    {

                        while($result = mysqli_fetch_assoc($data))
                        {

                            echo "<div class='numbers'>".$result['total_records']."</div>";
                        }
                    }
                ?>
                    <div class="cardname">Theatres</div>
                </div>
                <img src="images/movie-ticket.png" alt="">
            </div>

            <div class="card">
                <div>
                <?php

                    $query = "SELECT COUNT(*) AS total_records FROM customer";
                    $data = mysqli_query($conn,$query);
                    $total = mysqli_num_rows($data);

                    if($total>0)
                    {

                        while($result = mysqli_fetch_assoc($data))
                        {

                            echo "<div class='numbers'>".$result['total_records']."</div>";
                        }
                    }
                ?>
                    <div class="cardname">Customers</div>
                </div>
                <img src="images/user.png" alt="">
            </div>

            <div class="card">
                <div>
                <?php

                $query = "SELECT COUNT(*) AS total_records FROM (
                    SELECT m.mname, m.image, m.ctype, m.language, 
                        (SELECT GROUP_CONCAT(CONCAT(s.sid, ':', DATE_FORMAT(s.time, '%h:%i %p')) ORDER BY s.time SEPARATOR ', ') 
                        FROM showtimes s 
                        WHERE s.mid = m.mid) AS timeslots
                    FROM movie m
                ) AS movie_times";

                    $data = mysqli_query($conn,$query);
                    $total = mysqli_num_rows($data);

                    if($total>0)
                    {

                        while($result = mysqli_fetch_assoc($data))
                        {

                            echo "<div class='numbers'>".$result['total_records']."</div>";
                        }
                    }
                ?>
                    <div class="cardname">Shows</div>
                </div>
                <img src="images/shows.png" alt="">
            </div>

            <div class="card">
                <div>
                <?php

                    $query = "SELECT COUNT(*) AS total_records FROM bookings";
                    $data = mysqli_query($conn,$query);
                    $total = mysqli_num_rows($data);

                    if($total>0)
                    {

                        while($result = mysqli_fetch_assoc($data))
                        {

                            echo "<div class='numbers'>".$result['total_records']."</div>";
                        }
                    }
                ?>
                    <div class="cardname">Bookings</div>
                </div>
                <img src="images/cinema.png" alt="">
            </div>
        </div>

        

    </div>

    <!-- ====script==== -->
    <script src="js/admin1.js"></script>
</body>
</html>