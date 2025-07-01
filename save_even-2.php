<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "event_db"; 

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo"<script>
    alert('Connection failed');
    </script>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['eventName']) ? $_POST['eventName'] : '';
    $description = isset($_POST['eventDescription']) ? $_POST['eventDescription'] : '';
    $date = isset($_POST['eventDate']) ? $_POST['eventDate'] : '';
    $location = isset($_POST['eventLocation']) ? $_POST['eventLocation'] : '';
    
    if (!empty($name) && !empty($description) && !empty($date) && !empty($location)) {
        $stmt = $conn->prepare("INSERT INTO posted_events (event_name, event_desc, event_date, event_loc) VALUES ($name, $description, $date, $location)");
        $stmt->bind_param("ssss", $name, $description, $date, $location);
        
        if ($stmt->execute()) {
            echo "Event successfully added.";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "Please fill in all fields.";
    }
}

$conn->close();
?>
