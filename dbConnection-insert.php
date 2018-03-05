<?php

class connection{

    $user = 're.build';
    $password = 'hoge';
    $dbName = 'blog';
    $host = 'localhost:8888';
    $dsn = "mysql:host=localhost:3306;dbname=blog;charset=utf8";
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql_insert = "insert into blog(title,article) values(:title,:article)";
    //var_dump($pdo);
    //    die;
    $stm = $pdo->prepare($sql_insert);
    $stm->bindValue(':title', $title, PDO::PARAM_STR);
    $stm->bindValue(':article', $article, PDO::PARAM_STR);
    try {

        $stm->execute();
    //    var_dump($pdo);
    //    die;


    } catch (PDOException $e) {
    //exit('データベース接続失敗。'.$e->getMessage());
    }
}

?>
