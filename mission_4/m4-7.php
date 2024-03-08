<?php
    //DB接続設定
    echo "接続開始<br>";
    $dsn = 'mysql:dbname=データベース名;host=localhost';
    $user = 'ユーザー名';
    $password = 'パスワード';
    $pdo = new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    echo "接続完了<br>";
    //データレコード編集
    $id = 1;//変更する投稿番号
    $name = "太郎";
    $comment = "こんにちは";
    $sql = 'UPDATE tbtest SET name=:name,comment=:comment WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name',$name,PDO::PARAM_STR);
    $stmt->bindParam(':comment',$comment,PDO::PARAM_STR);
    $stmt->bindParam(':id',$id,PDO::PARAM_INT);
    $stmt->execute();
    //データ表示
    $sql = 'SELECT * FROM tbtest';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    foreach($results as $row){
        //$rowの中にはテーブルのカラム名
        echo $row['id'].',';
        echo $row['name'].',';
        echo $row['comment'].'<br>';
    echo "<hr>";
    }
?>