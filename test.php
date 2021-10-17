<?php
    session_start();
    $id = $_SESSION["id"];
    $dbms='mysql';
    $host='127.0.0.1';
    $dbName='vaccine_appointment';
    $user='root';
    $pass='takming';
    $dsn="$dbms:host=$host;dbname=$dbName";
    $dbh = new PDO($dsn, $user, $pass);
    $sql = "select * from national_information where id = '$id'";
    $rs = $dbh->query($sql);
    $row = $rs->fetch();
    echo $row["register"];
    if ($row["register"]){
        echo "true";
    }
    else{
        echo "false";
    }
?>