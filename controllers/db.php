<?php
  function connectDatabase() {    // the funtion to connect to database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $defaultDB = "gptalk";

    $conn = new mysqli($servername, $username, $password, $defaultDB);
  
    if($conn->connect_error) {    // if database connection failed
      die("Connection Failed: ".$conn->connect_error);
    }

    return $conn;
  }

  // function userRegister($email, $name, $password, $datetime) {
  //   $conn = connectDatabase();     // connect to database
  //   $sql = "INSERT INTO `user` (email, `name`, `password`, created_at) VALUES (?, ?, ?, ?);";

  //   $stmt = $conn->prepare($sql);
  //   $stmt->bind_param("ssss", $email, $name, $password, $datetime);

<<<<<<< HEAD
  //   if($stmt->execute()) {
  //     echo "Registration Successful!";
  //   }
  //   else {
  //     echo  $conn->error;
  //   }
=======
    if($stmt->execute()) {
      echo "<div class='text-success'>Registration Successful!</div>";
      echo "redirecting you to home page...";
      echo "<meta http-equiv="."refresh"." content="."2.03;index.php"." /> "; 
    }
    else {
      echo "<div class='text-danger'>*Email already registered.</div>";
      // echo  $conn->error;
    }
>>>>>>> 2b62a12697c81e9f0390adf5913572f3afa4fa48

  //   $stmt->close();
  //   $conn->close();

  // }

<<<<<<< HEAD
  // function userLogin($email, $password) {
  //   $conn = connectDatabase();     // connect to database
  //   $sql = "SELECT name, email, password FROM user WHERE email = ?";    // sql command to select user information from the database with user input email
=======
  function userLogin($email, $password) {
    $errorMsg ='';
    $conn = connectDatabase();     // connect to database
    $sql = "SELECT id, name, email, password FROM user WHERE email = ?";    // sql command to select user information from the database with user input email
>>>>>>> 2b62a12697c81e9f0390adf5913572f3afa4fa48

  //   $stmt = $conn->prepare($sql);   // prepare sql query statement
  //   $stmt->bind_param("s", $email); // bind the user input email into the sql command and assign into $stmt

<<<<<<< HEAD
  //   if($stmt->execute()) {      // if successfully execute $stmt
  //     $stmt->bind_result($name, $email, $pass);   // bind the result into the variables
  //     if($stmt->fetch()) {
  //         if(strcmp($password, $pass) == 0) {     // if user input password is same as the password retrived from the database
  //             $_SESSION["loggedin"] = true;       // assign the variables into $_SESSION
  //             $_SESSION["name"] = $name;
  //             $_SESSION["email"] = $email;
  //         }
  //         else {
  //           $errorMsg = "Login Failed. Invalid Email/Password.";
  //         }
  //     }
  //     else {
  //       $errorMsg = "Login Failed. Invalid Email/Password.";
  //     }
  //   }
  //   else {
  //     $errorMsg = $conn->error;
  //   }
=======
    if($stmt->execute()) {      // if successfully execute $stmt
      $stmt->bind_result($id, $name, $email, $pass);   // bind the result into the variables
      if($stmt->fetch()) {
          if(strcmp($password, $pass) == 0) {     // if user input password is same as the password retrived from the database
              $_SESSION["loggedin"] = true;       // assign the variables into $_SESSION
              $_SESSION["user_id"] = $id;
              $_SESSION["name"] = $name;
              $_SESSION["email"] = $email;
              echo '<script language="javascript">window.location.href ="'.'../view/index.php'.'"</script>';

          }
          else {
            $errorMsg = "<div class=text-danger> *Login Failed. Invalid Email/Password</div>";

          }
      }
      else {
        $errorMsg = "<div class=text-danger>*Login Failed. Invalid Email/Password</div>";
      }
    }
    else {
      $errorMsg = $conn->error;
    }
>>>>>>> 2b62a12697c81e9f0390adf5913572f3afa4fa48

  //   $stmt->close();     // close statement
  //   $conn->close();     // close database connection

  //   return $errorMsg;
  // }
?>