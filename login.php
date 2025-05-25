<?php
include "connection.php";

// Session maintain ---- start
session_start();
$_SESSION['user'] = '';
$_SESSION['id'] = '';

// Initialization of variables
$user = $passwordlogin = '';
$usererror = $passwordloginerror = '';

if (isset($_POST['login'])) {
    // User name validation
    if (empty(trim($_POST['txtuser']))) {
        $usererror = "Enter a valid UserName";
    } else {
        $user = trim($_POST['txtuser']);
    }

    // Password validation
    if (empty(trim($_POST['txtpasswordlogin']))) {
        $passwordloginerror = "Enter the Password";
    } elseif (strlen(trim($_POST['txtpasswordlogin'])) != 6) {
        $passwordloginerror = "Password should be 6 Characters";
    } else {
        $passwordlogin = trim($_POST['txtpasswordlogin']);
        $soltedpasswordlogin = $passwordlogin . "@#$%^";
    }

    // Check the error and login
    if (empty($usererror) && empty($passwordloginerror)) {
        // Check in customer table
        $query = "SELECT * FROM customer WHERE (password='$soltedpasswordlogin') AND (mobile='$user' OR email='$user' OR name='$user')";
        $data = mysqli_query($conn, $query);
        $count = mysqli_num_rows($data);
        if ($count == 1) {
            while ($result = mysqli_fetch_assoc($data)) {
                $_SESSION['user'] = $result['name'];
                $_SESSION['id'] = $result['customer_id'];
                $user = $_SESSION['user'];
                $redirect_page = isset($_SESSION['redirect_after_login']) ? $_SESSION['redirect_after_login'] : 'index.php';
                unset($_SESSION['redirect_after_login']); // Clear stored URL
                header("Location: $redirect_page"); 
                exit();
            }
        } else {
            // Check in admin table
            $query = "SELECT * FROM admin WHERE (password='$soltedpasswordlogin') AND (mobile='$user' OR email='$user' OR name='$user')";
            $data = mysqli_query($conn, $query);
            $count = mysqli_num_rows($data);
            if ($count == 1) {
                while ($result = mysqli_fetch_assoc($data)) {
                    $_SESSION['user'] = $result['name'];
                    $_SESSION['id'] = $result['id'];
                    header("Location: admin.php"); // Redirect to admin page
                    exit();
                }
            } else {
                echo "<script>alert('Invalid Password or Username');</script>";
            }
        }
    } else {
        echo "<script>alert('Please enter your username and password..');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login11.css">
    <link rel="icon" type="image/x-icon" href="logo1.png">
    <title>Login Page</title>
</head>
<body>
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 right">
                    <div class="input-box">
                        <header>Login Here</header>
                        <form method="post">
                            <div class="input-field">
                                <input type="text" class="input" name="txtuser" autocomplete="off" value="<?php echo htmlspecialchars($user); ?>">
                                <label>UserName</label>
                                <span style="color:red"><?php echo $usererror; ?></span>
                            </div>
                            <div class="input-field">
                                <input type="password" class="input" name="txtpasswordlogin">
                                <label>Password</label>
                                <span style="color:red"><?php echo $passwordloginerror; ?></span>
                            </div>
                            <div class="input-field">
                                <input type="submit" class="submit" name="login" value="Log In">
                            </div>
                        </form>
                        <div class="signin">
                            <span>Don't have an account? <a href="register.php">Register here</a></span>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</body>
</html>