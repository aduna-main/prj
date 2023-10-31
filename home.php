<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="./include/style/style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to Project Dashboard Page</h1>
        <p>This is the Project Dashboard Page for your project. You can customize it as needed</p>

    </div>
</body>
</html>

<?php
    session_start();
    require_once './include/connect/dbcon.php';
    if(isset($_SESSION["UserName"]))
    {
        echo '<h3>Login Success, Welcome - '.$_SESSION["UserName"].'<h3>';
        echo '<br><br><a href="./crud/read.php">Add User</a>';
        echo '<br><br><a href="dropdown.php">sample Drop-down Menu</a>';

        echo '<br><br><a href="logout.php">Logout</a>';

        
    }
    else{
        header("location:index.php");
    }
?>