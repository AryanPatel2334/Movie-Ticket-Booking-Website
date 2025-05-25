<?php
    include("connection.php");

// Fetch existing theatre names
 // Encode for JavaScript

// Initialize variables
$theatre_id = $rows = $seat_number = "";
$errorMessage = $successMessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $theatre_id = $_POST["id"];
    $rows = $_POST["rows"]; // Row labels
    $seat_number = $_POST["number"];        
    $seats_per_row = 15; // Number of seats per row

    $existingNames = [];
$query3 = "SELECT row_label FROM seats where theatre_id = $theatre_id  ";
$data3 = mysqli_query($conn, $query3);
while ($rs = mysqli_fetch_assoc($data3)) {
    $existingNames[] = $rs['row_label'];
}
$existingNamesJson = json_encode($existingNames);

    if (isset($_POST["insert"])) {  
        if (in_array($rows, $existingNames)) {
            $errorMessage = "Seats already exist!";
        } else {
            $allQueriesSuccessful = true; // Track query execution

            for ($i = 1; $i <= $seats_per_row; $i++) {
                $sql = "INSERT INTO seats (theatre_id, row_label, seat_number, status) 
                        VALUES ('$theatre_id', '$rows', '$i', 'available')";

                if (!mysqli_query($conn, $sql)) {
                    $allQueriesSuccessful = false; // If any query fails
                    break;
                }
            }

            if ($allQueriesSuccessful) {
                $successMessage = "Seats added successfully!";
                echo "<script>setTimeout(() => window.location.href = 'addseat.php', 1500);</script>";
            } else {
                $errorMessage = "Failed to add seats: " . mysqli_error($conn);
            }
        }
    }
}


   
    if (isset($_POST["delete"])) {
        $query_check = "SELECT * FROM movie WHERE mname='$mname'";
        $result_check = mysqli_query($conn, $query_check);
        if (mysqli_num_rows($result_check) > 0) {
        $query = "DELETE FROM movie WHERE mname='$mname'";
        mysqli_query($conn, $query);
        $successMessage = "Movie deleted successfully!";
        echo "<script>setTimeout(() => window.location.href = 'addmovie.php', 1500);</script>";
        } else {
        $errorMessage = "Movie does not exist!";
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
    <link rel="stylesheet" href="css/addseat11.css">
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

                    
            <?php if ($successMessage) { ?>
                <div class="alert alert-success"><?php echo $successMessage; ?></div>
            <?php } ?>

            <?php if ($errorMessage) { ?>
                <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
            <?php } ?>


       
        <form action="" method="post">
            <h1>Add Seats</h1>
    
                <div class="id">
                    <label for="theatre_id">Select Theatre:</label>
                    <select name="id" id="theatre_id" required>
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

            <div class="rows">
                <label for="rows">Row Label:</label>
                <select name="rows" id="rows" required>
                        <option value="">-- Select Row-label --</option>
                        <option value="A">A --Last row</option>
                        <option value="B">B --Seventh row</option>
                        <option value="C">C --Sixth-row</option>
                        <option value="D">D --Fifth-row</option>
                        <option value="E">E --Fourth-row</option>
                        <option value="F">F --Third-row</option>
                        <option value="G">G --Second-row</option>
                        <option value="H">H --First-row</option>
                    </select>
                    <div id="error" class="error-message"></div>
            </div>

            <div class="number">
                <label for="number">Seat Number:</label>
                <input type="text" name="number" required>
            </div>
        
            <button type="submit" name="insert" class="insert">Insert</button>
        </form>

                        
    <script>
            $(document).ready(function(){
                var existingNames = <?php echo json_encode($existingNames); ?>;

                $('#rows').on('change',function (e) { 
                    e.preventDefault();
                    var name = $('#rows').val();
                    if (existingNames.includes(name)) {
                        $('#rows').css('border', '2px solid red');
                        $('#error').text('already exist');
                    } else {
                        $('#rows').css('border', ''); 
                        $("#error").text(" ");
                    }
                });
            });
        </script>


        
    </div>

    <!-- ====script==== -->
    <!-- <script src="js/admin11.js"></script> -->
</body>
</html>
