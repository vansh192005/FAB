<?php
include('signup.php'); // Database connection
$query = "SELECT * FROM users";
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
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Birthdate</th>
            <th>Gender</th>
            <th>Username</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$row['firstName']}</td>
                    <td>{$row['lastName']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['birthDate']}</td>
                    <td>{$row['gender']}</td>
                    <td>{$row['username']}</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No users found.</td></tr>";
        }
        ?>
    </table>

</body>

</html>