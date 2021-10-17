<?php
    session_start();
    $id = $_POST["id_input"];
    $NHI_1 = $_POST["NHI_1"];
    $NHI_2 = $_POST["NHI_2"];
    $NHI_3 = $_POST["NHI_3"];
    $NHI = $NHI_1.$NHI_2.$NHI_3;
    //連接資料庫
    $dbms='mysql';
    $host='127.0.0.1';
    $dbName='vaccine_appointment';
    $user='root';
    $pass='takming';
    $dsn="$dbms:host=$host;dbname=$dbName";
    $dbh = new PDO($dsn, $user, $pass);
    //查詢資料
    $sql = "select * from national_information where id = '$id'";
    $rs = $dbh->query($sql);
    if ($rs->rowCount()){
        $row=$rs->fetch();
        if ($NHI==$row['NHI_id']){
            $_SESSION["login"] = true;
            $_SESSION["id"] = $id;
            $_SESSION["register"] = $row["register"];
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