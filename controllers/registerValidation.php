<?php
    require_once 'db.php';              //importing dp.php into the page
    require_once 'userController.php';  // importing userController.php into the page


    if(isset($_POST)) {
        if(!isset($_POST["name"]) || !isset($_POST["email"]) || !isset($_POST["password"])) {     // if $_POST["email"] or $_POST["password"] is not existed
            echo "*Invalid Form Submission";
            return;
        }

        $name = $_POST["name"];         // assign user input name into $name
        $email = $_POST["email"];       // assign user input email into $email
        $password = $_POST["password"]; // assign user input password into $password
        date_default_timezone_set("Asia/Singapore");        // set default timezone to "Asia/Singapore"
        $datetime = date("Y-m-d H:i:s");    // assign the current datetime into $datetime
        
        if($name == "" || $email == "" || $password == "") {      // if $email or $password is empty
            echo "*All Field is Mandatory";
            return;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {          // if $email has no email format
            echo "*Invalid email format";
            return;
        }

        $msg = userRegister($email, $name, $password, $datetime);       // call function userRegister in userController.php
    }
?>