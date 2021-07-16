<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register || GP Talk</title>

    <!-- Main css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style/register.css">

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

            xmlhttp.open("POST", "../controllers/registerValidation.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(postData);
        }
    </script>
</head>
<body>
    <!-- Register form -->
    <div class="container">
        <div class="row g-0">
            <div class="col-md-7">
                <div class="mb-5">
                    <h2 class="fw-bolder">Register</h2>
                </div>
                <form method="POST" class="register-form" id="register-form">
                    <div class="mb-3">
                        <input class="form-control" type="text" name="name" id="name" placeholder="Your Name" required/>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="email" name="email" id="email" placeholder="Your Email" required/>
                    </div>
                    <div class="mb-4">
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password" required/>
                    </div>
                    <p id="errorMsg" class='text-danger'></p>
                    <div class="form-group form-button">
                        <input type="button" name="signup" id="signup" class="btn btn-outline-dark" value="Register" onclick="registerFunction()"/>
                    </div>
                    <div class="mt-5">
                        Already a member?&nbsp
                    <a href="./login.php" class="link-dark">Login</a>
                </div>
                </form>
            </div>
            <div class="col-md-5">
                <figure><img src="style/images/signup-image.jpg" alt="sing up image"></figure>
            </div>
        </div>
    </div>
</body>
</html>