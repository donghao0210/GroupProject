<?php
    require_once 'db.php';
    
    function userRegister($email, $name, $password, $datetime) {
        $conn = connectDatabase();     // connect to database
        $sql = "INSERT INTO `user` (email, `name`, `password`, created_at) VALUES (?, ?, ?, ?);";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $email, $name, $password, $datetime);

        if($stmt->execute()) {
        echo "<div class='text-success'>Registration Successful!</div>";
        echo "redirecting you to login page...";
        echo "<meta http-equiv="."refresh"." content="."2.03;login.php"." /> "; 

        }
        else {
          echo "*".$conn->error;
        }

        $stmt->close();
        $conn->close();

    }

    function userLogin($email, $password) {
        $conn = connectDatabase();     // connect to database
        $sql = "SELECT name, email, password FROM user WHERE email = ?";    // sql command to select user information from the database with user input email
    
        $stmt = $conn->prepare($sql);   // prepare sql query statement
        $stmt->bind_param("s", $email); // bind the user input email into the sql command and assign into $stmt
    
        if($stmt->execute()) {      // if successfully execute $stmt
          $stmt->bind_result($name, $email, $pass);   // bind the result into the variables
          if($stmt->fetch()) {
              if(strcmp($password, $pass) == 0) {     // if user input password is same as the password retrived from the database
                  $_SESSION["loggedin"] = true;       // assign the variables into $_SESSION
                  $_SESSION["name"] = $name;
                  $_SESSION["email"] = $email;
                  echo '<script language="javascript">window.location.href ="'.'../view/index.php'.'"</script>';

              }
              else {
  //           $errorMsg = "<div class=text-danger> *Login Failed. Invalid Email/Password</div>";
                $msg = "<div class='text-danger'> *Login Failed. Invalid Email/Password.</div>";
              }
          }
          else {
            $msg = "<div class='text-danger'> *Login Failed. Invalid Email/Password.</div>";
          }
        }
        else {
          $msg = $conn->error;
        }
    
        $stmt->close();     // close statement
        $conn->close();     // close database connection

        if(!isset($msg)) {
            $msg = "<div class='text-success'> *Login Successfully</div>";
        }
    
        return $msg;
      }

    function userLogout() {
        session_destroy();
        header("Location: login.php");
        $msg = "Logout Successfully";

        return $msg;
    }

?>