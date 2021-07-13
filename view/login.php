
<!DOCTYPE html>
<html lang="en">
<head>
<?php
    session_start();        // starting session
    $errorMsg = "";
    require_once '../controllers/loginController.php';
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In || GPTalk</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style/login_register.css">
    <!-- icon -->
    <link rel="icon" href="./style/images/GPTalk.png">
</head>
<body>

    <div class="main">

        <!-- Sign up form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="style/images/signin-image.jpg" alt="sing up image"></figure>
                        <a href="./register.php" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Log In</h2>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your email" required/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password" required/>
                            </div>
                            <p id="errorMsg">
                                <?php
                                    if(!empty($errorMsg)) {
                                        echo $errorMsg;
                                    }
                                ?>
                            </p>
                            <div class="form-group form-button">
                                <input type="submit" name="login" id="login" class="form-submit" value="Sign in"/>
                            </div>
                        </form>
                        <p id="errorMsg" class='text-danger'></p>
                        <?php 
                        
                            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = true){ 
                                echo "<a href= 'logout.php'>Logout</a>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>