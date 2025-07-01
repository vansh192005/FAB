<?php
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $database = "admin_login";
  
  $conn = mysqli_connect($hostname, $username, $password, $database);
  
                 
  // if(mysqli_connect_error()){
  //     echo"Cannot Connect";
  // }

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
  
?>