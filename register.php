<?php
    include "connection.php";
?>
<?php
     //intialization of all error variable 
     $name = $category = $gender = $mobile = $email = $password ='';
     $nameerror = $categoryerror = $gendererror = $ageerror = $mobileerror = $emailerror = $passworderror ='';

    if(isset($_POST['insert']))
    {
       
         
        //name validation
        if(empty(trim($_POST['txtname'])))
        {
            $nameerror="Enter the Name";
        }
        else
        {
            $name=trim($_POST['txtname']);
        }
        
        //gender validation
        if(empty(isset($_POST['gen'])))
        {
           $gendererror="Select the Gender";
        }
        else
        {
            $gender=$_POST['gen'];
        }

        //age validation
        // if(empty(trim($_POST['txtage'])))
        // {
        //     $ageerror="Enter the Age";
        // }
        // elseif(!preg_match('/^[0-9]{2}$/',trim($_POST['txtage'])))
        // {
        //     $gendererror="Enter the Age in Proper format";
        // }
        // else
        // {
        //     $age= trim($_POST['txtage']);
        // }

        //mobile number validation
        if(empty(trim($_POST['txtmobile'])))
        {
            $mobileerror="Enter the Mobile Number";
        }
        elseif(!preg_match('/^[0-9]{10}$/',trim($_POST['txtmobile'])))
        {
            $mobileerror="Enter the Mobile Number in proper format";
        }
        else
        {
            $mobile=trim($_POST['txtmobile']);
        }

        //email validation 
        if(empty(trim($_POST['txtemail'])))
        {
            $emailerror="Enter the E-mail";
        }
        elseif(preg_match('/^[a-zA-z0-9]+[@gmail.com]$/',trim($_POST['txtemail'])))
        {
            $emailerror="Enter the E-mail in proper format";
        }
        else
        {
            $email=trim($_POST['txtemail']);
        }

        //password validation
        if(empty(trim($_POST['txtpassword'])))
        {
            $passworderror="Enter the Password";
        }
        elseif(strlen(trim($_POST['txtpassword']))!=6)
        {
            $passworderror="Password should be 6 Charcter";
        }
        else
        {
            $password=trim($_POST['txtpassword']);
            $soltedpassword=$password."@#$%^";
        }

       //category validation
        // if(empty(isset($_POST['txtcategory'])))
        // {
        //     $categoryerror="Please Select the Category";
        // }
        // else
        // {
        //     $category=$_POST['txtcategory'];
        // }
         
        // insert the record in this selected category 
        if (empty($nameerror) && empty($categoryerror) && empty($gendererror) && empty($ageerror) && empty($mobileerror) && empty($emailerror) && empty($passworderror))
        {
            // if($category=="customer")

            // {
            $age = $_POST['txtage'];


                $query="insert into customer values('','$name','$gender','$age','$mobile','$email','$soltedpassword')";
                $rs=mysqli_query($conn,$query);
                if($rs)
                {
                    header("Location:login.php");
                }
                else
                {
                    echo " Not Inserted...";
                }
            // }
            // elseif($category=="admin")
            // { 
                // $query="insert into admin values('','$name','$gender','$age','$mobile','$email','$soltedpassword')";
                // $rs=mysqli_query($cn,$query);
                // if($rs)
                // {
                //     header("Location:login.php");
                // }
                // else
                // {
                //     echo " Not Inserted...";
                // }
            // }
            // else
            // {
            //     echo " Something is Wrong...."; 
            // }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css"  rel="stylesheet" href="css/register11.css">
    <link rel="icon" type="image/x-icon" href="logo1.png">
    <title>Register Page</title>
</head>
<body>
    <div class="wrapper">
      <div class="container main">
          <div class="row">
              <div class="col-md-6 right">
                  
                  <div class="input-box">
                     
                     <header>Register Here</header>
                     <form method="post">
            
                        <div class="input-field">
                            <input type="text" class="input" name="txtname"  id="Name" required="" autocomplete="off">
                            <label for="name" class="name">Name</label> 
                            <span style="color:red"><?php echo $nameerror; ?></span>
                        </div> 
                        <!-- Gender -->
                        <div class="input-field">
                            <div class="rgroup">
                                <input type="radio"  name="gen" id="male" value="male" required="" autocomplete="off">  Male
                                <input type="radio"  name="gen" id="female" value="female" required="" autocomplete="off">  Female
                                <input type="radio"  name="gen" id="other" value="other" required="" autocomplete="off">  Other
                            </div>
                            <label for="gen" class="gen">Gender</label> 
                            <span style="color:red"><?php echo $gendererror; ?></span>
                        </div> 
                        <!-- Age -->
                        <div class="input-field">
                            <input type="date" class="input" name="txtage" id="age" required="" autocomplete="off" min="1975-02-20" max="2007-02-20">
                            <label for="age" class="age">Age</label> 
                            <span style="color:red"><?php echo $ageerror; ?></span>
                        </div> 
                        <!-- Mobile -->
                        <div class="input-field">
                            <input type="text" class="input" name="txtmobile" id="mobile" required="" autocomplete="off">
                            <label for="Mobile" class="mobile">Mobile</label> 
                            <span style="color:red"><?php echo $mobileerror; ?></span>
                        </div> 
                        <!-- Email -->
                        <div class="input-field">
                            <input type="email" class="input" name="txtemail" id="email" required="" autocomplete="off">
                            <label for="email" class="email">Email</label> 
                            <span style="color:red"><?php echo $emailerror; ?></span>
                        </div> 
                        <!-- Password -->
                        <div class="input-field">
                            <input type="password" class="input" name="txtpassword" id="password" required="">
                            <label for="password" class="password">Password</label>
                            <span style="color:red"><?php echo $passworderror; ?></span>
                        </div>
                        
                        <div class="input-field">
                            
                            <input type="submit" class="submit" id="insert" name="insert" value="Sign Up">
                        </div> 
                        <div class="signin">
                        <span>Already have an account? <a href="login.php">Login here</a></span>
                        </div>
                            
                     </form>

                  </div>  
              </div>
          </div>
      </div>
  </div>
  </body>
</html>