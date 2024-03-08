<?php
    //DB接続設定
    echo "DB接続開始<br>";
    $dsn = 'mysql:dbname=データベース名;host=localhost';
    $user = 'ユーザー名';
    $password = 'パスワード';
    $pdo = new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    echo "DB接続完了<br>";
    //データ入力
    $name = 'たろう';
    $comment = 'おはよう';

    $sql = "INSERT INTO tbtest(name,comment) VALUES(:name, :comment)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name',$name,PDO::PARAM_STR);
    $stmt->bindParam(':comment',$comment,PDO::PARAM_STR);
    $stmt->execute();
    //bindParamの引数名（:name など）はテーブルのカラム名に併せるとミスが少なくなります。最適なものを適宜決めよう。
?>