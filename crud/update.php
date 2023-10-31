<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to prj2</title>
    <link rel="stylesheet" href="../include/style/style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to prj</h1>
        <p>This is the landing page for your project.</p>
    </div>
   <?php
        session_start();
        require_once '../include/connect/dbcon.php';

        if(isset($_SESSION["UserName"])){
            echo '<h3>Login Success, welcome - '.$_SESSION['UserName'].'</h3>';
            echo '<br><br><a href="/prj/home.php">Home</a>';
            echo '<br><br><a href="/prj/dropdown.php">Sample Drop-Down Menu</a>';
    
            echo '<br><br><a href="/prj/logout.php">Logout</a><br><br>';
        
        }else{
            header("location:index.php");
        }

    ?>
     <br>
   <form action="update.php?id=<?php echo $_GET["id"]; ?>" method="post">
        Username: <input type="text" name="User" value="<?php echo $pdoResult[0]['UserName'];?>" required placeholder="UserName"><br><br>
        Password: <input type="password" name="Pass" value="<?php echo $pdoResult[0]['PassWord'];?>" required placeholder="Password"><br><br>
        Username: <input type="text" name="FName" value="<?php echo $pdoResult[0]['FullName'];?>" required placeholder="FullName"><br><br>
       <input type="submit" name="modify" value="Update">

   </form>
   <br>
    <?php   
        if(!empty($_POST["modify"])){
            $userName = htmlspecialchars($_POST['User']);
            $password = htmlspecialchars($_POST['Pass']);
            $fullName = htmlspecialchars($_POST['FName']);

            $pdoQuery = $pdoConnect->prepare("UPDATE tbuser set UserName = :userName, PassWord = :password, FullName = :fullName WHERE id=:id");
            $pdoResult=$pdoQuery->execute(array(
                ':userName' => $userName,
                ':password' => $password,
                ':fullName' => $fullName,
                ':id' => $_GET["id"]
            ));

            if($pdoResult){
                header("location:read.php");
            }
            
        }
        $pdoQuery = $pdoResult->prepare("SELECT * FROM tbuser WHERE id = :id");
        $pdoQuery->execute(array(':id' => $_GET["id"]));
        $pdoResult=$pdoQuery->fetchAll();
        $pdoConnect=null;
   ?>

  
</body>
</html>