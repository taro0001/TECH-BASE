<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-5</title>
</head>
<body>
<?php
//DB接続設定
$dsn = 'mysql:dbname=データベース名;host=localhost';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
//テーブル作成
$sql = "CREATE TABLE IF NOT EXISTS tb"
."("
."id INT AUTO_INCREMENT PRIMARY KEY,"
."name CHAR(32),"
."comment TEXT,"
."date TEXT,"
."pass TEXT"
.");";
$stmt = $pdo->query($sql);
//編集実行
if(!empty($_POST["name"]) && !empty($_POST["comment"]) && !empty($_POST["confirm"]) && !empty($_POST["pass1"])){
    $confirm = $_POST["confirm"];
    $name = $_POST["name"];
    $comment = $_POST["comment"];
    $date = date("Y/m/d H:i:s");
    $pass1 = $_POST["pass1"];

    $sql = 'SELECT * FROM tb';
    $stmt = $pdo->query($sql);
    $result = $stmt->fetchAll();
    foreach($result as $editrow){
        if($confirm == $editrow[0]){
            $sql = 'UPDATE tb SET name=:name,comment=:comment,date=:date,pass=:pass WHERE id=:id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name',$name,PDO::PARAM_STR);
            $stmt->bindParam(':comment',$comment,PDO::PARAM_STR);
            $stmt->bindParam(':date',$date,PDO::PARAM_INT);
            $stmt->bindParam(':pass',$pass1,PDO::PARAM_STR);
            $stmt->bindParam(':id',$confirm,PDO::PARAM_INT);
            $stmt->execute();
        }
    }
//投稿フォーム
}elseif(!empty($_POST["name"]) && !empty($_POST["comment"])){
    $name = $_POST["name"];
    $comment = $_POST["comment"];
    $date = date("Y/m/d H:i:s");
    $pass1 = $_POST["pass1"];

    $sql = "INSERT INTO tb(name,comment,date,pass) VALUES(:name, :comment, :date, :pass1)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name',$name,PDO::PARAM_STR);
    $stmt->bindParam(':comment',$comment,PDO::PARAM_STR);
    $stmt->bindParam(':date',$date,PDO::PARAM_STR);
    $stmt->bindParam(':pass1',$pass1,PDO::PARAM_STR);
    $stmt->execute();
}
//削除フォーム
if(!empty($_POST["delete"])){
    $delete = $_POST["delete"];
    $pass2 = $_POST["pass2"];
    $sql = 'SELECT * FROM tb';
    $stmt = $pdo->query($sql);
    $result = $stmt->fetchAll();
    foreach($result as $drow){
        if($drow[0] == $delete && $drow[4] == $pass2){
            $sql = 'delete from tb where id=:id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id',$delete,PDO::PARAM_INT);
            $stmt->execute();
        }
    }
}
//編集フォーム
if(!empty($_POST["editnum"])){
    $editnum = $_POST["editnum"];
    $pass3 = $_POST["pass3"];
    $sql = 'SELECT * FROM tb';
    $stmt = $pdo->query($sql);
    $result = $stmt->fetchAll();
    foreach($result as $row){
        if($row[4] == $pass3){
            if($row[0] != $editnum && $row[4] != $pass3){
            }else{
                $newnum = $row[0];
                $newname = $row[1];
                $newcom = $row[2];
                $newpass = $row[4];
            }
        }
    }
}
?>
    <h2>「趣味について」</h2>
    <form action="" method="POST">
        【投稿フォーム】<br>
        <input type="text" name="name" placeholder="名前" value="<?php if(!empty($newname)){echo "$newname";}?>"><br>
        <input type="text" name="comment" placeholder="コメント" value="<?php if(!empty($newcom)){echo "$newcom";}?>"><br>
        <input type="hidden" name="confirm" placeholder="編集番号確認" value="<?php if(!empty($newnum)){echo "$newnum";}?>">
        <input type="text" name="pass1" placeholder="パスワード" value="<?php if(!empty($newpass)){echo "$newpass";}?>">
        <input type="submit" name="submit" value="送信"><br>
        【削除フォーム】<br>
        <input type="number" name="delete" placeholder="削除番号">
        <input type="text" name="pass2" placeholder="パスワード">
        <input type="submit" name="submit2" value="削除"><br>
        【編集フォーム】<br>
        <input type="number" name="editnum" placeholder="編集番号">
        <input type="text" name="pass3" placeholder="パスワード">
        <input type="submit" name="submit3" value="編集">
    </form>
---------------------------------------------------------<br>
【投稿一覧】<br>
<?php
//表示
$sql = 'SELECT * FROM tb';
$stmt = $pdo->query($sql);
$results = $stmt->fetchAll();
foreach($results as $row){
    echo $row['id'].'.'.$row['name'].'「'.$row['comment'].'」'.$row['date'].'<br>';
}
?>
</body>
</html>