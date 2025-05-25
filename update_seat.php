<?php
session_start();
include("connection.php");

if (!isset($_SESSION['user'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $selectedSeats = json_decode($_POST['seats'], true);
    $theatre_id = $_POST['theatre_id'];
    $showtime_id = $_POST['showtime_id'];

    if (empty($selectedSeats)) {
        echo json_encode(["status" => "error", "message" => "No seats selected"]);
        exit();
    }

    // Update the seat status to "booked"
    foreach ($selectedSeats as $seat) {
        $query = "UPDATE seats SET status='booked' WHERE theatre_id='$theatre_id' AND seat_number='$seat'";
        mysqli_query($conn, $query);
    }

    echo json_encode(["status" => "success", "message" => "Seats booked successfully!"]);
}
?>
