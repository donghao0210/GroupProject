
<!DOCTYPE html>
<html lang="en">
<head>
<?php
    session_start();        // starting session
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In || GPTalk</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="style/login_register.css">
    <!-- icon -->
    <link rel="icon" href="./style/images/GPTalk.png">
    <script>
        function loginFunction() {
            var errorMsg = document.getElementById("errorMsg")
            var email = document.getElementById("email").value
            var password = document.getElementById("password").value

            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if(this.readyState == 4 && this.status == 200) {
                    errorMsg.innerHTML = this.response; 
                }
            }

            var postData = `email=${email}&password=${password}`;

            xmlhttp.open("POST", "../controllers/loginController.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(postData);
        }
    </script>
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
                                <input type="text" name="email" id="email" placeholder="Your email"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password"/>
                            </div>
                            <div class="form-group form-button">
                                <input type="button" name="login" id="login" class="form-submit" value="Sign in" onClick="loginFunction()"/>
                            </div>
                        </form>
                        <p id="errorMsg"></p>
                        <?php 
                            echo "<a href= 'logout.php'>Logout</a>";
                        ?>
                        <!-- <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div> -->
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