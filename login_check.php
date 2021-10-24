<?php
    session_start();
    $id = $_POST["id_input"];
    $NHI_1 = $_POST["NHI_1"];
    $NHI_2 = $_POST["NHI_2"];
    $NHI_3 = $_POST["NHI_3"];
    $NHI = $NHI_1.$NHI_2.$NHI_3;
    //連接資料庫
    $dbms='mysql';
    $host='us-cdbr-east-04.cleardb.com';
    $dbName='heroku_637c771d3a09e83';
    $user='bf7135d612ad3a';
    $pass='5e90df87';
    $dsn="$dbms:host=$host;dbname=$dbName";
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->exec("SET CHARACTER SET utf8mb4"); 
    //查詢資料
    $sql = "select * from national_information where id = '$id'";
    $rs = $dbh->query($sql);
    if ($rs->rowCount()){
        $row=$rs->fetch();
        if ($NHI==$row['NHI_id']){
            $_SESSION["login"] = true;
            $_SESSION["id"] = $id;
            $_SESSION["register"] = $row["register"];
            $_SESSION["name"] = $row["name"];
            echo ("verify");
        }
        else {
            $_SESSION["login"] = false;
            echo ("nfind");
        }
    }
    else{
        $_SESSION["login"] = false;
        echo ("nfind");
    }

?>