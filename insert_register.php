<?php
    session_start();
    $id = $_POST["id_input"];
    $phone_num = $_POST["phone_num"];
    $zipcode = $_POST["zipcode"];
    $Modena = $_POST["Modena"];
    $BNT = $_POST["BNT"];
    $AZ = $_POST["AZ"];
    $MVC = $_POST["MVC"];
    $vaccine_null = false;
    if ($Modena==0&&$BNT==0&&$AZ==0&&$MVC==0){
        $vaccine_null = true;
    }
    if($name==""||$phone_num==""||$vaccine_null==true){
        echo "have_null";
    }
    else{
        //連接資料庫
        $dbms='mysql';
        $host='us-cdbr-east-04.cleardb.com';
        $dbName='heroku_637c771d3a09e83';
        $user='bf7135d612ad3a';
        $pass='5e90df87';
        $dsn="$dbms:host=$host;dbname=$dbName";
        $dbh = new PDO($dsn, $user, $pass);
        $dbh->exec("SET CHARACTER SET utf8mb4"); 
        //新增資料
        $today = date('Ymd');
        $sql = "INSERT INTO register(id,phone_num,zip_code,Modena,BNT,AZ,MVC,date) VALUES (?,?,?,?,?,?,?,?)";
        $sth = $dbh->prepare($sql);
        $values = [
            $id,
            $phone_num,
            $zipcode,
            $Modena,
            $BNT,
            $AZ,
            $MVC,
            $today,
        ];
        $sth->execute($values);
        //修改資料
        $sql = "UPDATE national_information SET register=1 WHERE id = '$id'";
        $result = $dbh->prepare($sql);
        $result->execute();
        //變更session狀態
        $_SESSION["register"] = true;
        echo "not_null";
    }
?>