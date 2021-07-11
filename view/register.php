<?php
    session_start();        // starting session
?>

<!DOCTYPE HTML>
<html lang = "en">
<head>
	<meta charset = "UTF-8">
	<title> GP Talk | Register </title>
	<link rel = "icon" type = "image.png" href = "" />
	<link href = "style/-register.css" rel = "stylesheet" type = "text/css" />

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
    <div class = "center">
        <div class = "form">
            <form method="POST">
            <input type="text" name="name" id="name" placeholder="Name" required/><br />
            <input type="text" name="email" id="email" placeholder="Email" required/><br />
            <input type="password" name="password" id="password" placeholder="Password" required/><br />
            <input type="button" name="register" id="register" value="register" onClick="registerFunction()"/>
            </form>
        </div>

        <p id="errorMsg"></p>
    </div>
</body>
</html>