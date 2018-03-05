<!doctype html>
<html lang=ja>
<head>
    <meta charset="UTF-8">
    <title>記事一覧</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="nav">
    <ul>
        <li><a href="index.php">トップ</a></li>
        <li><a href="newArticle.php">新規投稿</a></li>
        <li>記事一覧</li>
    </ul>
</div>
<?php
$user = 're.build';
$password = 'hoge';
$dbName = 'blog';
$host = 'localhost:8888';
$dsn = "mysql:host=localhost:3306;dbname=blog;charset=utf8";
$pdo = new PDO($dsn,$user,$password);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

$sql_display = "select title,article from blog order by id desc;";
$stm = $pdo -> prepare($sql_display);

try {
    $stm->execute();
//    var_dump($pdo);
//    die;
} catch (PDOException $e) {
    exit('データベース接続失敗。'.$e->getMessage());
}

if(isset($_POST['title'])){
    $title=$_POST['title'];
}
if(isset($_POST['article'])){
    $article=$_POST['article'];
}
//var_dump($_POST);
//die;


$result=$stm->fetchAll(PDO::FETCH_ASSOC);
//var_dump($result);
//die;

foreach($result as $row){
echo "<p>".($row['title'])."</p>";
echo "<p>".($row['article'])."</p>";
}

?>

</body>
</html>
