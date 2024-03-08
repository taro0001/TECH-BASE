<?php
    //DB接続設定
    echo "DB接続開始<br>";
    $dsn = 'mysql:dbname=データベース名;host=localhost';
    $user = 'ユーザー名';
    $password = 'パスワード';
    $pdo = new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    echo "DB接続完了<br>";
    //テープル内容確認
    $sql = 'SHOW CREATE TABLE tbtest';
    $result = $pdo->query($sql);
    foreach($result as $row){
        echo $row[1];
    }
    echo "<hr>";
?>