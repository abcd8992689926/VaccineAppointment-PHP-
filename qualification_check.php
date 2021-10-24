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
    //設定施打輪數
    $Th_round = 2;
    //取得疫苗資格資料
    $sql = "select * from appointment_qualification where Th_round = '$Th_round'";
    $rs = $dbh->query($sql);
    $row = $rs->fetch();
    $today = getdate();
    $year = $today["year"];
    $age = ($year - $row["age"])."-12-31";
    $manufacturer = $row["manufacturer"];
    $sql_manufacturer = "rg.".$row["manufacturer"];
    $dose = $row["dose"];
    $date = $row["date"];
    //資格審查
    if ($dose==1){
        $sql = "select ni.id,ni.birthday,$sql_manufacturer,ni.dose,rg.date from national_information ni natural join register rg where ni.id='$id' and ni.birthday < '$age' and $sql_manufacturer = 1 and ni.dose = $dose-1 and rg.date > '$date'";
        $rs = $dbh->query($sql);
        if($rs->rowCount()){
            echo "verify";
        }
        else{
            echo "您不符合本輪預約資格";
        }
    }
    else{
        $sql = "select ni.id,ni.birthday,ni.dose,vr.manufacturer,vr.date from national_information ni natural join vaccine_record vr where ni.id='$id' and ni.birthday < '$age' and manufacturer='$manufacturer' and ni.dose = $dose-1 and vr.date<'$date'";
        $rs = $dbh->query($sql);
        if($rs->rowCount()){
            echo "verify";
        }
        else{
            echo "您不符合本輪預約資格";
        }
    }
    ?>