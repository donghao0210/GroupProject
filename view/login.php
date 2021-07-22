<?php

include './nav_bar.php'; //navbar 

    $msg = "";


    if(isset($_POST["login"])) {
        if(!isset($_POST["email"]) || !isset($_POST["password"])) {     // if $_POST["email"] or $_POST["password"] is not existed
            $msg = "Invalid Form Submission";
            return;
        }

        $email = $_POST["email"];       // assign user input email into $email
        $password = $_POST["password"]; // assign user input password into $password

        if($email == "" || $password == "") {      // if $email or $password is empty will pop up warning message
            $msg = "All Field is Mandatory";
            return;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {  // if $email is invalid format will pop up warning message
            $msg = "Invalid email format";
            return;
        }

        $msg = userLogin($email, $password);
    }

    if(isset($_POST["logout"])) { //logout
        $msg = userLogout();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In || GPTalk</title>
    <!-- Main css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style/login.css">
    <!-- icon -->
    <link rel="icon" href="./style/images/GPTalk.png">
</head>
<body>
    <!-- Login form -->
    <div class="c1"> 
    <div class="container">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="style/images/signin-image.jpg" alt="sing up image">
            </div>

            <div class="col-md-8">
                <div class="mb-5">
                    <h2 class="fw-bolder">Log In</h2>
                </div>

                <form method="POST" class="login-form" id="login-form">
                    <div class="mb-3">
                        <input class="form-control" type="email" name="email" id="email" placeholder="Your email" required/>
                    </div>
                    <div class="mb-4">
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password" required/>
                    </div>

                    <p id="errorMsg">
                        <?php
                        //echo errorMsg
                            if(!empty($msg)) {
                                echo $msg;
                            }
                        ?>
                    </p>
                    <div class="form-group form-button">
                        <input type="submit" name="login" id="login" class="btn btn-outline-dark" value="Sign in"/>
                    </div>
                </form>
                
                <div class="mt-5">
                    Do not have an account?&nbsp
                    <a href="./register.php" class="link-dark">Register</a>
                </div> 
            </div>
        </div>
    </div>
</div>
</body>
</html>