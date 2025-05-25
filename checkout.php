<?php
    include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>

        form{
            margin: 200px 500px;
            border: 2px solid gray;
            background-color: rgb(243, 243, 243);
        }  
        
        form h1{
            text-align: center;
        }

        form .details{
            margin: 10px;
            display: flex;
            width: 500px;
            flex-direction: column;
            gap: 10px;
        }

        form input{
            height: 30px;
            font-size: 17px;
        }

        .details button{
            background-color: rgb(64, 156, 64);
            border: none;
            color: white;
            height: 35px;
            cursor: pointer;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <h1>Checkout Form</h1>
        <div class="details">
            <label>Full Name:</label>
            <input type="text" name="name">
            <label>Email:</label>
            <input type="email" name="email">
            <label>Mobile</label>
            <input type="text" name="mobile">
            <label>Address</label>
            <input type="textarea" name="address">
            <button name="pay">Pay Now</button>
        </div>
    </form>
</body>
</html>

<?php
    if(isset($_POST['pay']))
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];

        $query = "insert into checkout values('','$name','$email','$mobile','$address')";
        $data = mysqli_query($conn,$query);

        if($data){
            echo "Data is inserted...";
        }
        else{
            echo "Something is wrong...";
        }
    }
?>
