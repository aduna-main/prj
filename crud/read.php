<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read and Display page</title>
    <link rel="stylesheet" href="../include/style/style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to Read and Display Page</h1>
        <p>This is the read and display page for your project.</p>

    </div>

    <?php
        
        session_start();
        require_once '../include/connect/dbcon.php';
        if(isset($_SESSION["UserName"])){
            
            echo '<h3>Login Success, Welcome - '.$_SESSION["UserName"].'<h3>';
            echo '<br><br><a href="/prj/home.php">Home</a>';
            echo '<br><br><a href="/prj/dropdown.php">sample Drop-down Menu</a>';
    
            echo '<br><br><a href="/prj/logout.php">Logout</a>';
    

        }else{
            header("location:index.php");

        }
    ?>
    <br>
    <form action="create.php" method="post">
        <input type="hidden" name="Id">
        Username:<input type="text" name="User" required placeholder="Username"><br>
        Password: &nbsp;<input type="password" name="Pass" required placeholder="Password"><br>
        FullName:<input type="text" name="FName" required placeholder="FullName"><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="insert" value="Save"><br><br><br>
        
    </form>
    <form action="search.php" method="post">
        Search: &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="Id"  placeholder="Enter Data here"><br><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="Find" value="Search"><br><br><br>
        
    </form>
    <br>
    <?php
        $pdoQuery = "SELECT * FROM tbuser";
        $pdoResult=$pdoConnect->prepare($pdoQuery);
        $pdoResult->execute();
        echo "<table border='2' cellpadding='7'>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>UserName</th>";
        echo "<th>PassWord</th>";
        echo "<th>FullName</th>";
        echo "<th>Action</th>";
        echo "</tr>";
        while($row = $pdoResult->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$UserName</td>";
            echo "<td>$PassWord</td>";
            echo "<td>$FullName</td>";
            echo "<td><a href='update.php?id=$id';>Edit</a> <a href='delete.php?id=$id';>Delete</a></td>";
            echo "</tr>";
        }
    ?>
</body>
</html>