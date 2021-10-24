<?php
    session_start();
    $id =$_SESSION["id"];
    //連接資料庫
    $dbms='mysql';
    $host='us-cdbr-east-04.cleardb.com';
    $dbName='heroku_637c771d3a09e83';
    $user='bf7135d612ad3a';
    $pass='5e90df87';
    $dsn="$dbms:host=$host;dbname=$dbName";
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->exec("SET CHARACTER SET utf8mb4"); 
    //取得個人詳細資料
    $sql = "select * from national_information where id = '$id'";
    $rs = $dbh->query($sql);
    $row = $rs->fetch();
    $birthday = $row["birthday"];
    //設定施打輪數
    $Th_round = 1;
    //取得疫苗資格資料
    $sql = "select * from appointment_qualification where Th_round = '$Th_round'";
    $rs = $dbh->query($sql);
    $row = $rs->fetch();
    $today = getdate();
    $year = $today["year"];
    echo $year;
    echo "<br>";
    $age = ($year - $row["age"])."-12-31";
    echo $age;
    $manufacturer = $row["manufacturer"];
    $dose = $row["dose"];
    $date = $row["date"];
    //資格審查
    $sql = "select * from national_information where birthday < '$age'";
    $rs = $dbh->query($sql);
    $row = $rs->fetch();
    echo $row["id"];
    
?>