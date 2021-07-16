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
?>