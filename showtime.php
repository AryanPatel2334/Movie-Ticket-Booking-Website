<?php
include("connection.php");

// Initialize variables
$tid = $mid = $time = $price = "";
$errorMessage = $successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tid = trim($_POST["tid"]);
    $mid = trim($_POST["mid"]);
    $time = trim($_POST["time"]);
    $price = trim($_POST["price"]);

    // Check if the showtime already exists for the given theatre and time
    $query3 = "SELECT * FROM showtimes WHERE theatre_id = '$tid' AND time = '$time'";
    $data3 = mysqli_query($conn, $query3);
    
    if ($data3) {
        if (mysqli_num_rows($data3) > 0) {
            $errorMessage = "Showtime already exists for this theatre at this time!";
        } else {
            // Proceed to insert if no duplicate found
            $query = "INSERT INTO showtimes (theatre_id, mid, time, price) VALUES ('$tid', '$mid', '$time', '$price')";
            if (mysqli_query($conn, $query)) {
                $successMessage = "Showtime added successfully!";
                echo "<script>setTimeout(() => window.location.href = 'showtime.php', 1500);</script>";
            } else {
                $errorMessage = "Failed to add showtime.";
            }
        }
    } else {
        $errorMessage = "Failed to fetch existing showtimes.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/admin1.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/addmovie1.css">
    <link rel="icon" type="image/x-icon" href="logo1.png">
    <script src="Jquery/jquery-3.7.1.min.js"></script>
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
                </a></li>
                <li><a href="customer.php"><span class="icon"><img src="Images/user.png" alt="" class="invert"></span><span class="title">Customers</span></a></li>
                <li><a href="addmovie.php"><span class="icon"><img src="Images/clapperboard.png" alt="" class="invert"></span><span class="title">Movies</span></a></li>
                <li><a href="theatre1.php"><span class="icon"><img src="Images/movie-ticket.png" alt="" class="invert"></span><span class="title">Theatres</span></a></li>
                <li><a href="addseat.php"><span class="icon"><img src="Images/seat.png" alt="" class="invert"></span><span class="title">Seats</span></a></li>
                <li><a href="showtime.php"><span class="icon"><img src="Images/cinema.png" alt="" class="invert"></span><span class="title">Showtime</span></a></li>
                <li><a href="shows.php"><span class="icon"><img src="Images/shows.png" alt="" class="invert"></span><span class="title">Shows</span></a></li>
                <li><a href="ticketbook.php"><span class="icon"><img src="Images/movie-ticket.png" alt="" class="invert"></span><span class="title">Bookings</span></a></li>
            </ul>
        </div>
    </div>

    <div class="main">
        <div class="topbar">
            <div class="toggle"><img src="Images/Hamburger.png" alt=""></div>
            <div class="search">
                <label>
                    <input type="search" placeholder="search here">
                    <img src="Images/search-interface-symbol.png" alt="">
                </label>
            </div>
            <div class="user"><img src="Images/Aryan.jpg" alt=""></div>
        </div>

        <?php if ($successMessage) { ?>
            <div class="alert alert-success"><?php echo $successMessage; ?></div>
        <?php } ?>

        <?php if ($errorMessage) { ?>
            <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
        <?php } ?>

        <form action="" method="post">
            <h1>Add Showtime Details</h1>
            <div class="id">
                <label for="theatre_id">Select Theatre:</label>
                <select name="tid" id="theatre_id" required>
                    <option value="">-- Select Theatre --</option>
                    <?php
                    $query = "SELECT theatre_id, name FROM theatres";
                    $data = mysqli_query($conn, $query);
                    if (mysqli_num_rows($data) > 0) {
                        while ($result = mysqli_fetch_assoc($data)) {
                            $id = $result['theatre_id'];
                            $name = $result['name'];
                            echo "<option value='$id'>$id - $name</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="movie_id">
                <label for="show_time">Movie Id:</label>
                <select name="mid" id="mid" required>
                    <option value="">-- Select Movie_id --</option>
                    <?php
                    $query = "SELECT mname, mid from movie";
                    $data = mysqli_query($conn, $query);
                    if (mysqli_num_rows($data) > 0) {
                        while ($result = mysqli_fetch_assoc($data)) {
                            $id = $result['mid'];
                            $name = $result['mname'];
                            echo "<option value='$id'>$id - $name</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="time">
                <label for="time">Show time:</label>
                <input type="time" name="time" id="time" required>
                <div id="error" class="error-message"></div>
            </div>

            <div class="ticket_price">
                <label for="ticket_price">Ticket Price:</label>
                <input type="number" step="0.01" name="price" required>
            </div>

            <button type="submit" name="insert" class="insert">Insert</button>
        </form>

        <script>
            $(document).ready(function(){
                // Remove the JavaScript validation since it's handled in PHP
            });
        </script>
    </div>

    <script src="js/admin1.js"></script>
</body>
</html>