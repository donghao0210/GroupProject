<?php
    require_once 'db.php';              //importing dp.php into the page
    
    function userRegister($email, $name, $password, $datetime) {      // register user function
        $conn = connectDatabase();     // connect to database
        $sql = "INSERT INTO `user` (email, `name`, `password`, created_at) VALUES (?, ?, ?, ?);";     // sql command for inserting into `user` table

        $stmt = $conn->prepare($sql);   // prepare sql query statement
        $stmt->bind_param("ssss", $email, $name, $password, $datetime);    // bind the user input into the sql command and assign into $stmt

        if($stmt->execute()) {    // if $smt is successfully executed
        echo "<div class='text-success'>Registration Successful!</div>";    // print registration successfully
        echo "redirecting you to login page...";
        echo "<meta http-equiv="."refresh"." content="."2.03;login.php"." /> ";   // redirect user to login page

        }
        else {    // if statement is failed to execute
          echo "*".$conn->error;    // print the error message
        }

        $stmt->close();   // close sql statement
        $conn->close();   // close database connection

    }

    function userLogin($email, $password) {   // login user function
        $conn = connectDatabase();     // connect to database
        $sql = "SELECT name, email, password, id FROM user WHERE email = ?";    // sql command to select user information from the database with user input email
    
        $stmt = $conn->prepare($sql);   // prepare sql query statement
        $stmt->bind_param("s", $email); // bind the user input email into the sql command and assign into $stmt
    
        if($stmt->execute()) {      // if successfully execute $stmt
          $stmt->bind_result($name, $email, $pass, $user_id);   // bind the result into the variables
          if($stmt->fetch()) {
              if(strcmp($password, $pass) == 0) {     // if user input password is same as the password retrived from the database
                  $_SESSION["loggedin"] = true;       // assign the variables into $_SESSION
                  $_SESSION["name"] = $name;
                  $_SESSION["email"] = $email;
                  $_SESSION["user_id"] = $user_id;
                  echo '<script language="javascript">window.location.href ="'.'../view/index.php'.'"</script>';    // redirect user to home page

              }
              else {     // if user input password is not the same as the password retrived from the database
                $msg = "<div class='text-danger'> *Login Failed. Invalid Email/Password.</div>";
              }
          }
          else {
            $msg = "<div class='text-danger'> *Login Failed. Invalid Email/Password.</div>";
          }
        }
        else {    // if statement is failed to execute
          $msg = $conn->error;
        }
    
        $stmt->close();     // close statement
        $conn->close();     // close database connection

        if(!isset($msg)) {    // if $msg is not exist
            $msg = "<div class='text-success'> *Login Successfully</div>";
        }
    
        return $msg;    // return $msg
      }

    function userLogout() {   // logout user function
        session_destroy();    // delete session all of the data associated with the current session 
        header("Location: login.php");    // redirect user to login page
        $msg = "Logout Successfully";

        return $msg;          // return $msg
    }

?>