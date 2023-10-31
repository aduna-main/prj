<?php
    if(isset($_POST['insert']))
    {
        try{
            $pdoConnect = new PDO("mysql:host=localhost; dbname=dbtest", "root", "");
            $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $exc){
            echo $exc->getMessage();
            exit();
        }

        $id = $_POST['id'];
        $User = $_POST['User'];
        $Pass = $_POST['Pass'];
        $Fname = $_POST['FName'];

        $pdoQuery = "INSERT INTO tbuser (Username, PassWord, FullName) VALUES(:User, :Pass, :FName)";
        $pdoResult = $pdoConnect->prepare($pdoQuery);
        $pdoExec=$pdoResult->execute(array(":User"=>$User,":Pass"=>$Pass, ":FName"=>$Fname));

        if($pdoExec)
        {
            $pdoQuery='SELECT * FROM tbuser';
            $pdoResult=$pdoConnect->prepare($pdoQuery);
            $pdoResult->execute();
            while($row = $pdoResult->fetch()){
                echo $row['id'] . "|" . $row['UserName'] . "|" . $row['PassWord'] . "|" . $row['FullName'] . "<br>";

            }
            header("location:read.php");
            exit;
        }else{
            echo 'Data Not Inserted';
        }
    }
$pdoConnect=null;
?>