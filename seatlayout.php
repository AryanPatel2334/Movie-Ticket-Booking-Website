<?php
    session_start();
    include("connection.php");

    
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flicker - Movie Ticket Booking</title>
    <link rel="stylesheet" href="css/seatlayout.css">
    <link rel="icon" type="image/x-icon" href="logo1.png">
    <link rel="stylesheet" href="css/utility2.css">
</head>

<body>
    <div class="top">
        <div class="info">
            
        <?php
            $price = isset($_GET['price']) ? urldecode($_GET['price']) : 'Price?';
            $mname = isset($_GET['mname']) ? urldecode($_GET['mname']) : 'Unknown Movie';
         ?>
            <div class="title"><?php echo htmlspecialchars($mname); ?></div>
            <div class="theatre">
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
            </div>
        </div>
        <div class="ticket">
            <p>2 Tickets</p>
        </div>
    </div>
    <div class="time">
        <p>5:20 PM</p>
        <p>9:00 PM</p>
        <p>10:25 PM</p>
    </div>
    <div class="line1"></div>

    <div class="middle">
        <div class="selection">
            <p>How many seats?</p>
            <div class="seatno">
                <div><p class="seat1" onclick="selectNumber1(this)">1</p></div>
                <div><p class="seat2" onclick="selectNumber1(this)">2</p></div>
                <div><p class="seat3" onclick="selectNumber1(this)">3</p></div>
                <div><p class="seat4" onclick="selectNumber1(this)">4</p></div>
                <div><p class="seat5" onclick="selectNumber1(this)">5</p></div>
                <div><p class="seat5" onclick="selectNumber1(this)">6</p></div>
                <div><p class="seat5" onclick="selectNumber1(this)">7</p></div>
                <div><p class="seat5" onclick="selectNumber1(this)">8</p></div>
                <div><p class="seat5" onclick="selectNumber1(this)">9</p></div>
                <div><p class="seat5" onclick="selectNumber1(this)">10</p></div>
            </div>
            <div class="line"></div>
            <div class="seattype">
                <div class="royalrc">
                    <p class="tname">ROYAL RECLINER</p>
                    <p class="rupees">Rs. 480</p>
                    <p class="avail">Available</p>
                </div>
                <div class="royal">
                    <p class="tname">ROYAL</p>
                    <p class="rupees">Rs. 270</p>
                    <p class="avail">Available</p>
                </div>
                <div class="club">
                    <p class="tname">CLUB</p>
                    <p class="rupees">Rs. 250</p>
                    <p class="avail">Available</p>
                </div>
                <div class="executive">
                    <p class="tname">Executive</p>
                    <p class="rupees">Rs. 230</p>
                    <p class="avail">Available</p>
                </div>
            </div>
            <button onclick="submitSelection()">Select Seats</button>
        </div>
        <div class="line2"></div>
        <?php
         $id = isset($_GET['id']) ? urldecode($_GET['id']) : 'Unknown theatre'; 
        $theatre_id = $id; // Set theatre ID dynamically based on selection
        $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H']; // Row labels
        $seats_per_row = 15; // Number of seats per row

        $query = "SELECT * FROM seats WHERE theatre_id = $theatre_id ORDER BY row_label, seat_number";
        $result = $conn->query($query);

        $seats = [];
        while ($row = $result->fetch_assoc()) {
        $seats[$row['row_label']][] = $row;
        }
        ?>

<div class="seatlayout">
    <?php foreach ($seats as $row_label => $seat_row): ?>
        <div class="row">
            <div class="divison"><?= $row_label ?></div>
            <div class="seats">
                <?php foreach ($seat_row as $seat): ?>
                    <div class="seat <?= $seat['status'] === 'booked' ? 'disabled' : '' ?>" 
                         data-seat="<?= $seat['seat_number'] ?>">
                        <?= $seat['seat_number'] ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<style>
    .seat.disabled { background: red; cursor: not-allowed; }
</style>


        
        <div class="screen">
            <img src="Images/screen.png" alt="">
        </div>


    </div>
    <div class="bottom">
        <div class="bestseller">
            <div class="seat"></div>
            <p>Bestseller</p>
        </div>
        <div class="available">
            <div class="seat"></div>
            <p>Available</p>
        </div>
        <div class="select">
            <div class="seat"></div>
            <p>Selected</p>
        </div>
        <div class="sold">
            <div class="seat"></div>
            <p>Sold</p>
        </div>

        <?php
    $price = isset($_GET['price']) ? urldecode($_GET['price']) : 'Price?';
    $mname = isset($_GET['mname']) ? urldecode($_GET['mname']) : 'Unknown Movie';
    $sid = isset($_GET['sid']) ? urldecode($_GET['sid']) : 'Unknown Movie';
    $tid = isset($_GET['id']) ? urldecode($_GET['id']) : 'Unknown theatre'; 
    $time = isset($_GET['time']) ? urldecode($_GET['time']) : 'Unknown time'; 
    $location = isset($_GET['location']) ? urldecode($_GET['location']) : 'Unknown location'; 

?> 

    <button class="confirm-Btn" style="display: none;" 
    data-price="<?php echo htmlspecialchars($price); ?>" 
    data-mname="<?php echo htmlspecialchars($mname); ?>"
    data-sid="<?php echo htmlspecialchars($sid); ?>"
    data-tid="<?php echo htmlspecialchars($tid); ?>"
    data-time="<?php echo htmlspecialchars($time); ?>"
    data-location="<?php echo htmlspecialchars($location); ?>"
    <a href="bookingsummary.php?sid=5&movieName=Chhaava&tid=1&price=698">Pay Rs. <?php echo htmlspecialchars($price); ?></a>
    </button>


    </div>
    <script src="js/seatlayout3.js"></script>
</body>

</html>