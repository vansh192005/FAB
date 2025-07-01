<?php
$host = 'localhost'; // change if your DB host is different
$db = 'post_event'; // your database name
$user = 'root'; // your database username
$pass = ''; // your database password

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventName = $conn->real_escape_string($_POST['eventName']);
    $eventDescription = $conn->real_escape_string($_POST['eventDescription']);
    $eventDate = $conn->real_escape_string($_POST['eventDate']);
    $eventLocation = $conn->real_escape_string($_POST['eventLocation']);

    $sql = "INSERT INTO posted_events (event_name, event_desc, event_date, event_loc)
            VALUES ('$eventName', '$eventDescription', '$eventDate', '$eventLocation')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Event saved successfully!'); window.location.href='event-2.html';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
