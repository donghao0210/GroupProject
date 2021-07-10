<?php
  function connectDatabase($defaultDB = null) {
    $servername = "localhost";
    $username = "root";
    $password = "";
  
    //connect to db
    if(isset($defaultDB)) {
      $conn = new mysqli($servername, $username, $password, $defaultDB);
    }
    else {
      $conn = new mysqli($servername, $username, $password);
    }
  
    if($conn->connect_error) {
      die("Connection Failed: ".$conn->connect_error);
    }

    return $conn;
  }

?>