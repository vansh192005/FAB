<?php

$host = 'localhost'; // change if your DB host is different
$db = 'post_event'; // your database name
$user = 'root'; // your database username
$pass = ''; // your database password

$conn = new mysqli($host, $user, $pass, $db);
// include('save_event-2.php'); // Database connection
$query = "SELECT * FROM posted_events";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <style>
        .page-title {
            text-align: center;
            margin-top: 20px;
            font-size: 28px;
        }

        .user-table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .user-table th,
        .user-table td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }

        .user-table th {
            background-color: #2c3e50;
            color: white;
        }
    </style>
</head>

<body>

    <h2 class="page-title">User List</h2>

    <table class="user-table">
        <tr>
            <th>Event Name</th>
            <th>Event Description</th>
            <th>Event Date</th>
            <th>Event Location</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$row['event_name']}</td>
                    <td>{$row['event_desc']}</td>
                    <td>{$row['event_date']}</td>
                    <td>{$row['event_loc']}</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No users found.</td></tr>";
        }
        ?>
    </table>

</body>

</html>