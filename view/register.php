
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register || GP Talk</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style/login_register.css">

    
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>


    <!-- icon -->
    <link rel="icon" href="./style/images/GPTalk.png">
    <script>
        function registerFunction() {
            var errorMsg = document.getElementById("errorMsg")
            var name = document.getElementById("name").value
            var email = document.getElementById("email").value
            var password = document.getElementById("password").value

            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if(this.readyState == 4 && this.status == 200) {
                    errorMsg.innerHTML = this.response; 
                }
            }

            var postData = `&name=${name}&email=${email}&password=${password}`;

            xmlhttp.open("POST", "../controllers/registerController.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(postData);
        }
    </script>
</head>
<body>

    <div class="main">
    <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Register</h2>
                        <form method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name" required/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email" required/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password" required/>
                            </div>
                            <div class="alreadyMember">
                                <a href="./login.php" class="signup-image-link">I am already member</a>
                            </div>
                            <p id="errorMsg"></p>
                            <div class="form-group form-button">
                                <input type="button" name="signup" id="signup" class="form-submit" value="Register" onclick="registerFunction()"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="style/images/signup-image.jpg" alt="sing up image"></figure>
                        <button class="btn btn2" onclick="window.location.href = 'index.php'"> Back </button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>