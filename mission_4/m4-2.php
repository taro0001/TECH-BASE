<?php
    //DB接続設定
    echo "接続開始<br>";
    $dsn = 'mysql:dbname=データベース名;host=localhost';
    $user = 'ユーザー名';
    $password = 'パスワード';
    $pdo = new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    echo "接続完了<br>";
    //テーブル作成
    $sql = "CREATE TABLE IF NOT EXISTS tbtest"
    ."("
    ."id INT AUTO_INCREMENT PRIMARY KEY,"
    ."name CHAR(32),"
    ."comment TEXT"
    .");";
    $stmt = $pdo->query($sql);
?>