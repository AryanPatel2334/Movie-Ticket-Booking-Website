<?php
session_start();

if (empty($_SESSION['user'])) {
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI']; // Save current page
    header("Location: login.php");
    exit();
}
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flicker - Booking Summary</title>
    <link rel="stylesheet" href="css/utility2.css">
    <link rel="stylesheet" href="css/bookingsummary11.css">
    <link rel="icon" type="image/x-icon" href="logo1.png">
</head>

<body>
<div class="top">
    <div class="info">
        <?php
        $movieName = isset($_GET['movieName']) ? urldecode($_GET['movieName']) : 'Unknown Movie';
        $sid = isset($_GET['sid']) ? urldecode($_GET['sid']) : 'Unknown sid';
        $price = isset($_GET['price']) ? urldecode($_GET['price']) : 'Unknown price';
        $tid = isset($_GET['tid']) ? urldecode($_GET['tid']) : 'Unknown theatre';
        $time = isset($_GET['time']) ? urldecode($_GET['time']) : 'Unknown time';

        $query = "SELECT name, location FROM theatres WHERE theatre_id = '$tid'";
        $data = mysqli_query($conn, $query);
        $theatre = mysqli_fetch_assoc($data);
        $name = $theatre['name'] ?? 'Unknown';
        $location = $theatre['location'] ?? 'Unknown';
        ?>

        <div class="title"><?php echo htmlspecialchars($movieName); ?></div>
        <div class="theatre">
            <p><?php echo htmlspecialchars($name); ?>: <?php echo htmlspecialchars($location); ?> | Today, 21 Jan, <?php echo htmlspecialchars($time); ?></p>
        </div>
    </div>
    <?php
    // Retrieve maxSeats safely
    $seat = isset($_GET['maxSeats']) ? intval($_GET['maxSeats']) : 0;

    echo "<div class='ticket'>
        <p>$seat Tickets</p>
    </div>";
?>

</div>
<div class="line1"></div>
<div class="main">
    <div class="summary">
        <div class="circle1"></div>
        <div class="circle2"></div>
        <p>BOOKING SUMMARY</p>
        <div class="tickets">
            <p>Tickets</p>
            <p>Rs. <?php echo htmlspecialchars($price); ?></p>
        </div>
        <div class="fees">
            <p>There is no convenience fees</p>
        </div>
        <div class="line2"></div>
        <div class="total">
            <p>Sub total</p>
            <p>Price</p>
        </div>
        <div class="payable">
            <div class="text">Amount Payable: Rs. <?php echo htmlspecialchars($price); ?></div>
        </div>
    </div>

    <form method="POST" action="">
        <input type="hidden" name="movieName" value="<?php echo htmlspecialchars($movieName); ?>">
        <input type="hidden" name="tid" value="<?php echo htmlspecialchars($tid); ?>">
        <input type="hidden" name="sid" value="<?php echo htmlspecialchars($sid); ?>">
        <input type="hidden" name="price" value="<?php echo htmlspecialchars($price); ?>">
        <button class="pay" id="bookButton" name="pay">
            <p>TOTAL: Rs. <?php echo htmlspecialchars($price); ?></p>
        </button>
    </form>
</div>
<script src="js/bookingsummary11.js"></script>
</body>

</html>

<?php
            $id = isset($_GET['id']) ? urldecode($_GET['id']) : 'Unknown theatre';   
            $query="SELECT name, location FROM theatres where theatre_id = '$id'";   
            $data=mysqli_query($conn,$query);
            while($result=mysqli_fetch_assoc($data)) {
               $name = $result['name'];
               $location = $result['location'];
               echo "<p>$name: $location</p>";
            }

            ?>

<?php

include("connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['pay'])) {
    $movieName = mysqli_real_escape_string($conn, urldecode($_POST['movieName']));
    $tid = mysqli_real_escape_string($conn, urldecode($_POST['tid']));
    $sid = mysqli_real_escape_string($conn, urldecode($_POST['sid']));
    $price = mysqli_real_escape_string($conn, urldecode($_POST['price']));
    $seat = isset($_GET['maxSeats']) ? intval($_GET['maxSeats']) : 0;
    $user_name = mysqli_real_escape_string($conn, $_SESSION['user']);
    $time = isset($_GET['time']) ? urldecode($_GET['time']) : 'Unknown time';


    $query = "SELECT customer_id FROM customer WHERE name= '$user_name'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $customer_id = $row['customer_id'] ?? null;

        if (!$customer_id) {
            die("Error: Customer ID not found.");
        }
    } else {
        die("Error fetching customer ID: " . mysqli_error($conn));
    }

    $theatre_id = $tid;
    $showtime_id = $sid;
    $mname = $movieName;
    $tname = $name;
    $total_seats = $seat;
    $time = $time;


    // Insert booking record
    $sql = "INSERT INTO bookings (customer_id, theatre_id, sid, mname, total_seats, total_price) 
            VALUES ('$customer_id', '$theatre_id', '$showtime_id', '$mname', '$total_seats', '$price')";
    $data = mysqli_query($conn, $sql);

    if ($data) {
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'payment.php?sid=$sid&movieName=$movieName&tname=$tname&price=$price&time=$time&total_seats=$total_seats'; 
                }, 2000);
              </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    $query = "SELECT name, location FROM theatres WHERE theatre_id = '$tid'";
    $location = $theatre['location'] ?? 'Unknown';

    require 'phpmailer/Exception.php';
    require 'phpmailer/PHPMailer.php';
    require 'phpmailer/SMTP.php';
    
    // Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'patelaryan232004@gmail.com';                     // SMTP username
        $mail->Password   = 'syiz znrg zwga pbwi';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable implicit TLS encryption
        $mail->Port       = 465;                                    // TCP port to connect to
    
        $query = "SELECT email FROM customer WHERE name = '$user_name'";
        $data = mysqli_query($conn, $query); 
    
        while ($result = mysqli_fetch_assoc($data)) {
            $email = $result['email'];
    
            // Recipients
            $mail->setFrom('patelaryan232004@gmail.com', 'Flicker');
            $mail->addAddress("$email", "$user_name"); // Add a recipient
    
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Your Tickets';
            $mail->Body    = "🎬 Movie Name: $mname <br> 📍Theatre: $tname : $location <br> 🎟 Total Seats: $total_seats <br> 💰Price: $price <br> 📅 Showtime : $time";
    
            // Send the email
            $mail->send();
            echo 'Message has been sent to ' . $email . '<br>';
            
            // Clear all addresses for the next iteration
            $mail->clearAddresses();
        }
    } catch (Exception $e) {
        echo "Message could not be sent.";
    }
}

?>