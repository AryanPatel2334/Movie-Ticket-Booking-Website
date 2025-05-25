<?php
    include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/admin1.css">
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
        </div>
        <div class="buttons">
            <button class="Hindi">Hindi</button>
            <button class="English">English</button>
            <button class="Gujarati">Gujarati</button>
        </div>

        <h1 class="mheading">English Movies</h1>

        <?php

            $query = "SELECT * FROM movie WHERE language LIKE '%English%';";
            $data = mysqli_query($conn,$query);
            $total = mysqli_num_rows($data);

            if($total>0)
            {
                ?>
                <table border="2px" class="tbtheatre">
                <tr>
                <th>MovieId</th>
                <th>Movie Name</th>
                <th>Certificate Type</th>
                <th>Language</th>
                </tr>

                <?php

                while($result = mysqli_fetch_assoc($data))
                {

                echo "<tr><td>".$result['mid']."</td>
                <td>".$result['mname']."</td>
                <td>".$result['ctype']."</td>
                <td>".$result['language']."</td></tr>";
                }
                }

            else{
            echo "</p>Movies are not found.</p>";
            }
    ?>
</table>

    </div>

    <!-- ====script==== -->
    <script src="js/admin11.js"></script>
</body>
</html>
