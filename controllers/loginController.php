<?php
    require_once 'db.php';

    if(isset($_POST)) {
        if(!isset($_POST["email"]) || !isset($_POST["password"])) {     // if $_POST["email"] or $_POST["password"] is not existed
            echo "Invalid Form Submission";
            return;
        }

        $email = $_POST["email"];       // assign user input email into $email
        $password = $_POST["password"]; // assign user input password into $password

        if($email == "" || $password == "") {      // if $email or $password is empty
            echo "All Field is Mandatory";
            return;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format";
            return;
        }

        userLogin($email, $password);
    }
?>