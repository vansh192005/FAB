<?php
  require_once("connection.php");
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="submit">Login</button>
        </form>
    </div>

    <?php
    
       if(isset($_POST['submit'])){
         $query = "SELECT * FROM `admin_login` WHERE Admin_Name = '$_POST[username]' AND Admin_Password = '$_POST[password]'";
         $result = mysqli_query($conn,$query);
         if(mysqli_num_rows($result)==1){//Returns How many no.of rows are selected while this query is fired

            session_start();
            $_SESSION['AdminLoginId'] = $_POST['username'];
            header("location: admin_panel.php");
         } 
         else
         {
            echo"<script>alert('Incorrect Password');</script>";
         }
       }
    ?>
</body>
</html>
