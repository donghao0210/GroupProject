<?php
    session_start();        // starting session
?>

<!DOCTYPE HTML>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title> GP Talk | Login </title>
	<link rel = "icon" type = "image.png" href = "" />
	<link href = "style/-login.css" rel = "stylesheet" type = "text/css" />

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
    <div class = "center">
        <div class = "form">
            <form method="POST">
            <input type="text" name="email" id="email" placeholder="Email" required/><br />
            <input type="password" name="password" id="password" placeholder="Password" required/><br />
            <input type="button" name="login" id="login" value="Login" onClick="loginFunction()"/>
            </form>
        </div>

        <p id="errorMsg"></p>
        <?php 
            echo "<a href= 'logout.php'>Logout</a>"; 
        ?>
    </div>
</body>
</html>