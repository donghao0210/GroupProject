<?php
    require_once 'db.php';

    if(isset($_POST["login"])) {
        if(!isset($_POST["email"]) || !isset($_POST["password"])) {     // if $_POST["email"] or $_POST["password"] is not existed
            $errorMsg = "Invalid Form Submission";
            return;
        }

        $email = $_POST["email"];       // assign user input email into $email
        $password = $_POST["password"]; // assign user input password into $password

        if($email == "" || $password == "") {      // if $email or $password is empty
            $errorMsg = "All Field is Mandatory";
            return;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMsg = "Invalid email format";
            return;
        }

        $errorMsg = userLogin($email, $password);
    }
?>