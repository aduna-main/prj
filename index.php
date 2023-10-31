<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./include/style/style.css">
</head>
<body>
    <br>
    <div style="width: 500px;" class="container">
    <?php
        if(isset($message))
        {
            echo '<label>'.$message.'<label>';
        }
    ?>
    <h3 align="">Login Page</h3><br>
    <form action="index.php" method="post">
        Username
        <input type="text" name="UserName">
        <br>
        Password
        <input type="password" name="PassWord" >
        <br>
        <input type="submit" name="login" value="Login">
    </form>
    </div>
</body>
</html>

<?php
    session_start();
    require_once './include/connect/dbcon.php';

    try{
        $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(isset($_POST["login"]))
        {
            if(empty($_POST["UserName"]))
            {
                $message = '<label> All fields are required';
            }
            else{
                $pdoQuery = "SELECT * FROM tbuser WHERE UserName = :UserName AND PassWord = :PassWord";
                $pdoResult = $pdoConnect->prepare($pdoQuery);
                $pdoResult->execute(
                    array(
                        'UserName' => $_POST["UserName"],
                        'PassWord' => $_POST["PassWord"]
                    )
                );
                $count = $pdoResult->rowCount();
                if($count > 0)
                {
                    $_SESSION["UserName"] = $_POST["UserName"];
                    header("location:home.php");
                }
                else
                {
                    $message = '<label>Wrong Data</label>';
                }
            }
        }

    }
    catch(PDOException $error){
        $message=$error->getMessage();
    }
?>