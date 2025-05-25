<?php
    include("connection.php");

// Fetch existing theatre names
$existingNames = [];
$query3 = "SELECT mname FROM movie";
$data3 = mysqli_query($conn, $query3);
while ($rs = mysqli_fetch_assoc($data3)) {
    $existingNames[] = $rs['mname'];
}
$existingNamesJson = json_encode($existingNames); // Encode for JavaScript

// Initialize variables
$image = $mname = $ctype = $language ="";
$errorMessage = $successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $image = trim($_POST["image"]);
    $mname = trim($_POST["mname"]);
    $ctype = trim($_POST["ctype"]);
    $language = isset($_POST['language']) ? implode(',', $_POST['language']) : '';

    if (isset($_POST["insert"])) {  
        if (in_array($mname, $existingNames)) {
            $errorMessage = "Movie already exists!";
        } else {
            $query = "INSERT INTO movie VALUES ('','$image', '$mname','$ctype','$language')";
            if (mysqli_query($conn, $query)) {
                $successMessage = "Movie added successfully!";
                echo "<script>setTimeout(() => window.location.href = 'addmovie.php', 1500);</script>";
            } else {
                $errorMessage = "Failed to add movie.";
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
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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

        
    <?php if ($successMessage) { ?>
        <div class="alert alert-success"><?php echo $successMessage; ?></div>
    <?php } ?>

    <?php if ($errorMessage) { ?>
        <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
    <?php } ?>

        
        <form action="" method="post" id="myform">
            <h3>Movies Management</h3>
            <div class="image">
                <label for="">Upload Movie Image:</label>
                <input type="file" name="image" id="image" class="form-control" value="<?php echo htmlspecialchars($image); ?>" required>
            </div>

            <div class="name">
                <label for="">Enter movies name:</label>
                <input type="text" name="mname" id="mname" class="form-control" value="<?php echo htmlspecialchars($mname); ?>" required>
                <div id="error" class="error-message"></div>
            </div>
            <div class="certification">
                <label for="">Enter certification Type:</label>
                <input type="text" name="ctype" class="form-control" value="<?php echo htmlspecialchars($ctype); ?>" required>
               
            </div>
            <div class="language">
                <label>Select languages:</label>
                <input type="checkbox" name="language[]" value="Hindi" class="checkbox" style="bottom:-29px;left:-242px">Hindi
                <input type="checkbox" name="language[]" class="checkbox" value="English">English
                <input type="checkbox" name="language[]" class="checkbox" value="Gujarati">Gujarati
                <input type="checkbox" name="language[]" class="checkbox" value="Tamil">Tamil
                <input type="checkbox" name="language[]" class="checkbox" value="Telugu">Telugu
            </div> 
            <div class="buttons1">
                <button name="insert" class="insert">Insert</button>
                <!-- <button name="update" class="update">Update</button> -->
                <button name="delete" class="delete">Delete</button>
            </div> 
        </form>

             
<script>
        $(document).ready(function(){
            var existingNames = <?php echo json_encode($existingNames); ?>;

            $('#mname').on('input',function (e) { 
                e.preventDefault();
                var name = $('#mname').val();
                if (existingNames.includes(name)) {
                    $('#mname').css('border', '2px solid red');
                    $('#error').text('already exist');
                } else {
                    $('#mname').css('border', ''); 
                    $("#error").text(" ");
                }
            });
        });
    </script>


    </div>

    <!-- ====script==== -->
    <script src="js/admin11.js"></script>
</body>
</html>

