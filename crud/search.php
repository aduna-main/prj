<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search page</title>
    <link rel="stylesheet" href="../include/style/style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to Search Page</h1>
        <p>This is the Search Page for your project.</p>
    </div>
    
</body>
</html>

<?php
    session_start();
    #require_once '../include/connect/dbcon.php';
    if(isset($_SESSION["UserName"])){
        echo '<h3>Login Success, welcome - '.$_SESSION['UserName'].'</h3>';
        echo '<br><br><a href="/prj/home.php">Home</a>';
        echo '<br><br><a href="/prj/dropdown.php">Sample Drop-Down Menu</a>';

        echo '<br><br><a href="/prj/logout.php">Logout</a>';
    
    }else{
        header("location:index.php");
    }

   $id="";
    $UserName="";
    $PassWord="";
    $FullName="";

    if(isset($_POST['Find'])){
        try{
            $pdoConnect=new PDO("mysql:host=localhost;dbname=dbtest", "root", "");
        }catch(PDOException $exc){
            echo $exc->getMessage();
            exit();
        }

        $id = filter_input(INPUT_POST, 'Id', FILTER_VALIDATE_INT);

        if($id !== false && $id !== null){
            $pdoQuery="SELECT * FROM tbuser WHERE id = :id";
            $pdoResult=$pdoConnect->prepare($pdoQuery);
            $pdoExec = $pdoResult->execute(array(":id" => $id));

            echo "<table border='2' cellpadding='7'>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>UserName</th>";
            echo "<th>PassWord</th>";
            echo "<th>FullName</th>";
            echo "<th>Action</th>";
            echo "</tr>";

            if($pdoExec){
                if($pdoResult->rowCount() > 0){
                    while($row = $pdoResult->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                        echo "<tr>";
                        echo "<td>$id</td>";
                        echo "<td>$UserName</td>";
                        echo "<td>$PassWord</td>";
                        echo "<td>$FullName</td>";
                        echo "<td><a href='update.php?id=$id';>Edit</a> <a href='delete.php?id=$id';>Delete</a></td> ";
                        echo "</tr>";
                    }
                }else{
                    echo '<br><br><br><br><br>';
                    echo "No data";
                }
            }
        }else{
            echo '<br><br><br><br><br>';
            echo "Invalid ID";
        }
        $pdoConnect=null;
    }
?>