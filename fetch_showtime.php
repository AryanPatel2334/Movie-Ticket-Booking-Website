<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flicker";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT theatres.name AS theatre, showtimes.time, showtimes.price 
        FROM showtimes 
        JOIN theatres ON showtimes.theatre_id = theatres.id";

$result = $conn->query($sql);
$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
?>
