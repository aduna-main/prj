<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Page</title>
    <link rel="stylesheet" href="./include/style/style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome To Dropdown Page</h1>
        <p>This is the dropdown page for project</p>
    </div>
</body>
</html>

<?php
    session_start();
    #require_once './include/connect/dbcon.php';
    if(isset($_SESSION["UserName"]))
    {
        echo '<h3>Login Success, Welcome - '.$_SESSION["UserName"].'<h3>';
        echo '<br><br><a href="/prj/home.php">Home</a>';
        echo '<br><br><a href="./crud/read.php">Add User</a>';
        echo '<br><br><a href="/prj/logout.php">Logout</a>';

        echo "<br><br><br><br><br>";
        echo "Select UserName";

        $pdoConnect=new PDO("mysql:host=localhost; dbname=dbtest", "root", "");
        $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pdoQuery="SELECT username From tbuser";
        $pdoResult=$pdoConnect->query($pdoQuery);

        $dropdown = "<select name='users'>";
        foreach($pdoResult as $row)
        {
            $dropdown .= "\r\n<option value='{$row['username']}'>{$row['username']}</option>";

        }
        $dropdown .="\r\n</select>";
        echo $dropdown;
        echo '</select>';

        echo "<br><br><br><br><br><br><br>";
        echo "This is a sample code to fetch data from database and display it on dropdown menu";

    }
    else{

        header("location:index.php");
    }
?>