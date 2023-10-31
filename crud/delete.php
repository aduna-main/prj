<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add and Display</title>
    <link rel="stylesheet" href="../include/style/style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to CRUD OPERATIONS</h1>
        <p>This is the landing page of your project.</p>
    </div>
</body>
</html>
<?php
    require_once "../include/connect/dbcon.php";

    if(isset($_GET['id'])){
        $pdoQuery="DELETE FROM tbuser WHERE id = :id";
        $pdoResult=$pdoConnect->prepare($pdoQuery);
        $pdoResult->execute(array(':id' => $_GET['id']));

        header("location:read.php");
    }else{
        echo "Invalid request. Please provide a valid id.";

    }
$pdoConnect=null;
?>