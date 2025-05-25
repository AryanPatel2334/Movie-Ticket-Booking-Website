<?php
include("connection.php");

// Fetch existing theatre names
$existingNames = [];
$query3 = "SELECT name FROM theatres";
$data3 = mysqli_query($conn, $query3);
while ($rs = mysqli_fetch_assoc($data3)) {
    $existingNames[] = $rs['name'];
}
$existingNamesJson = json_encode($existingNames); // Encode for JavaScript

// Initialize variables
$tname = $location = "";
$errorMessage = $successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tname = trim($_POST["tname"]);
    $location = trim($_POST["location"]);

    if (isset($_POST["insert"])) {
        if (in_array($tname, $existingNames)) {
            $errorMessage = "Theatre already exists!";
        } else {
            $query = "INSERT INTO theatres (name, location) VALUES ('$tname', '$location')";
            if (mysqli_query($conn, $query)) {
                $successMessage = "Theatre added successfully!";
                echo "<script>setTimeout(() => window.location.href = 'theatre1.php', 1500);</script>";
            } else {
                $errorMessage = "Failed to add theatre.";
            }
        }
    }

   


    if (isset($_POST["delete"])) {
        $query_check = "SELECT * FROM theatres WHERE name='$tname'";
        $result_check = mysqli_query($conn, $query_check);
        if (mysqli_num_rows($result_check) > 0) {
        $query = "DELETE FROM theatres WHERE name='$tname'";
        mysqli_query($conn, $query);
        $successMessage = "Theatre deleted successfully!";
        echo "<script>setTimeout(() => window.location.href = 'theatre1.php', 1500);</script>";
        } else {
        $errorMessage = "Theatre does not exist!";
        }
       
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/addtheatre1.css">
    <script src="Jquery/jquery-3.7.1.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->

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

        <h2 class="text-center">Theatre Management</h2>

    <?php if ($successMessage) { ?>
        <div class="alert alert-success"><?php echo $successMessage; ?></div>
    <?php } ?>

    <?php if ($errorMessage) { ?>
        <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
    <?php } ?>

    <form action="" method="post" class="bg-white p-4 rounded shadow-sm">
        <div class="mb-3">
            <label for="tname" class="form-label">Theatre Name</label>
            <input type="text" name="tname" id="tname" class="form-control" value="<?php echo htmlspecialchars($tname); ?>" required>
            <div id="error" class="error-message"></div>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" id="location" class="form-control" value="<?php echo htmlspecialchars($location); ?>" required>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" name="insert" class="btn btn-success">Add Theatre</button>
            <button type="submit" name="delete" class="btn btn-danger">Delete Theatre</button>
        </div>
    </form>

        <div class="table-container">
            <h3 class="text-center mb-3">Available Theatres</h3>

            <?php
            $query = "SELECT * FROM theatres";
            $data = mysqli_query($conn, $query);
            if (mysqli_num_rows($data) > 0) {
                echo '<div class="table-responsive">
                        <table class="table table-striped table-hover shadow-sm rounded">
                            <thead class="text-white" style="background: linear-gradient(45deg, #007bff, #0056b3);">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Location</th>
                                </tr>
                            </thead>
                            <tbody>';

                while ($result = mysqli_fetch_assoc($data)) {
                    echo "<tr>
                            <td>{$result['theatre_id']}</td>
                            <td>{$result['name']}</td>
                            <td>{$result['location']}</td>
                        </tr>";
                }

                echo '</tbody></table></div>';
            } else {
                echo "<p class='text-center text-muted mt-3'>No theatres found.</p>";
            }
    ?>

       
<script>
        $(document).ready(function(){
            var existingNames = <?php echo json_encode($existingNames); ?>;

            $('#tname').on('input',function (e) { 
                e.preventDefault();
                var name = $('#tname').val();
                if (existingNames.includes(name)) {
                    $('#tname').css('border', '2px solid red');
                    $('#error').text('already exist');
                } else {
                    $('#tname').css('border', ''); 
                    $("#error").text(" ");
                }
            });
        });
    </script>

        </div>
    </div>

 


    <!-- ====script==== -->
    <!-- <script src="js/admin11.js"></script> -->
</body>
</html>