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

  function userRegister($email, $name, $password, $datetime) {
    $conn = connectDatabase();     // connect to database
    $sql = "INSERT INTO `user` (email, `name`, `password`, created_at) VALUES (?, ?, ?, ?);";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $email, $name, $password, $datetime);

    if($stmt->execute()) {
      echo "Registration Successful!";
    }
    else {
      echo  $conn->error;
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
          }
          else {
            echo "Login Failed. Invalid Email/Password.";
          }
      }
      else {
        echo "Login Failed. Invalid Email/Password.";
      }
    }
    else {
      echo $conn->error;
    }

    $stmt->close();     // close statement
    $conn->close();     // close database connection
  }
?>