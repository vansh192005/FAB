<?php
// Database connection details
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "signup_db";
$usertable = "users";
$yourfield = "user_name";

// Create connection
$conn = mysqli_connect($hostname, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to fetch data
$query = "SELECT * FROM $usertable";
$result = mysqli_query($conn, $query);

// Check if query returned results
// if ($result) {
//     while ($row = mysqli_fetch_assoc($result)) {
//         $name = $row['username'];  // Fetch user_name field
//         echo "Name: " . $name . "<br/>";
//     }
// } else {
//     echo "No records found!";
// }

// Close connection
// mysqli_close($conn);
?>
