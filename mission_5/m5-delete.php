<?php
    //DB接続設定
    echo "接続開始<br>";
    $dsn = 'mysql:dbname=データベース名;host=localhost';
    $user = 'ユーザー名';
    $password = 'パスワード';
    $pdo = new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    echo "接続完了<br>";
    //注意！
    //テーブルごと削除
    $sql = 'DROP TABLE tb';
    $stmt = $pdo->query($sql);
?>