<?php
// Database connection
$hostname = "localhost";
$username = "root";
$password = "";
$database = "signup_db";

$conn = mysqli_connect($hostname, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $birthDate = mysqli_real_escape_string($conn, $_POST['birthDate']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encrypt password

    // Insert data into database
    $sql = "INSERT INTO users (firstName, lastName, email, phone, birthDate, gender, username, password)
            VALUES ('$firstName', '$lastName', '$email', '$contact', '$birthDate', '$gender', '$username', '$password')";

    if (mysqli_query($conn, $sql)) {
        // Show alert message and redirect using JavaScript
        echo "<script>
                alert('Signup successful! Redirecting to home page.');
                window.location.href = 'home.html'; // Change to your actual login page
              </script>";
        exit();
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

// Close connection
mysqli_close($conn);
?>
