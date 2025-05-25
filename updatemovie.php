<?php
    include("connection.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/adminn.css">
</head>
<body>
    <div class="container">
        <div class="navigation">
            <div class="logo">
                <a href="">
                    <span class="icon"><img src="Images/apple-logo.png" alt="" class="invert"></span>
                    <span class="title">Flicker</span>
                </a>
            </div>
            <ul>
                <li>
                    <a href="">
                        <span class="icon"><img src="Images/home.png" alt="" class="invert"></span>
                        <span class="title">Home</span>
                    </a>
                </li>
                <li>
                    <a href="">
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
                    <a href="theatre.php">
                        <span class="icon"><img src="Images/movie-ticket.png" alt="" class="invert"></span>
                        <span class="title">Theatres</span>
                    </a>
                </li>
                <li>
                    <a href="showtime.php">
                        <span class="icon"><img src="Images/cinema.png" alt="" class="invert"></span>
                        <span class="title">Showtime</span>
                    </a>
                </li>
                <li>
                    <a href="">
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
            <button class="Tamil">Tamil</button>
            <button class="Telugu">Telugu</button>
        </div>

        <form action="" method="post">
            <h1>Update Details Of Movies</h1>
            <div class="id">
                <label for="">Select MovieId:</label>
                <select name="" id="">
                    <?php
                         $query="select*from hindi";
                         $data=mysqli_query($conn,$query);
                         $total=mysqli_num_rows($data);
     
                         if($total>0)
                         {
     
                             while($result=mysqli_fetch_assoc($data))
                             {
                                 $id = $result['mid'];
                                 $name = $result['name'];

                                 echo "<option value='$id'>$mid - $name</option>";
                             }
                            }
     
                    ?>
                </select>
            </div>
            <div class="image">
                <label for="">Upload Movie Image:</label>
                <input type="file" name="image">
            </div>
            <div class="name">
                <label for="">Enter movies name:</label>
                <input type="text" name="mname">
            </div>
            <div class="certification">
                <label for="">Enter certification Type:</label>
                <input type="text" name="ctype">
            </div>
            <div class="language">
                <label for="">Enter Language:</label>
                <input type="text" name="language">
            </div>
            <button name="update" class="update">Update</button>
        </form>
    </div>

    <!-- ====script==== -->
    <script src="js/admin.js"></script>
</body>
</html>


<?php

if(isset($_POST["update"]))
{
    // $image = file_get_contents($_FILES["image"]);
    $image = $_POST["image"];
    $mname = $_POST["mname"];
    $ctype = $_POST["ctype"];
    $language = $_POST["language"];

    $query = "update hindi set image=$image,mname=$mname,ctype=$ctype,language=$language where mid=$mid";
    $data = mysqli_query($conn,$query);
    error_reporting(0);

    if($data)
    {
        echo "1 record is inserted..";
    }
    else{
        echo "record is not inserted..";
    }

}

?>