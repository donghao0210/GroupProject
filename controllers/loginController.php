<?php
    require_once 'db.php';

    if(isset($_POST)) {
        if(!isset($_POST["email"]) || !isset($_POST["password"])) {     // if $_POST["email"] or $_POST["password"] is not existed
            $errorMsg = "Invalid Form Submission";
            echo $errorMsg;
            return;
        }

        $email = $_POST["email"];       // assign user input email into $email
        $password = $_POST["password"]; // assign user input password into $password

        if($email == "" || $password == "") {      // if $email or $password is empty
            $errorMsg = "All Field is Mandatory";
            echo $errorMsg;
            return;
        }

        userLogin($email, $password);

        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
            echo '<script>alert("logined.'.$_SESSION['email'].'\n'.$_SESSION['password'].'")</script>';
            echo "Email :: ".$_SESSION["email"]."<br />";
            echo "Name :: ".$_SESSION["name"]."<br />";
        }
    }
?>