<?php
//    require_once "validation.php";
//    require_once "dbConnection.php";


//    $validation= new validation();
//    if()
//    if(validation validate() )
//        if ($err_msg_title === "" && $err_msg_article === "" && $err_msg_strlen_title === "" && $err_msg_strlen_article === "") {
//            $message = "書き込み成功";
//        }
    $err_msg_title = "";
    $err_msg_article = "";
    $err_msg_strlen_title = "";
    $err_msg_strlen_article = "";
    $message = "";
    //titleがあるなら"title"なげる
    $title = (isset($_POST["title"]) === true) ? $_POST["title"] : "";
    //commentがあるなら"comment"なげる
    $article = (isset($_POST["article"]) === true) ? $_POST["article"] : "";
    $strlen_title = strlen($title);
    $strlen_article = strlen($article);
    if (isset($_POST["send"]) === true) {
        if ($title === "") {
            $err_msg_title = "タイトルを入力してください";
        }

        if ($article === "") {
            $err_msg_article = "コメントを入力してください";
        }

        if ($strlen_title >= 10) {
            $err_msg_strlen_title = "タイトルの文字数を10文字以下にしてください";
        }

        if ($strlen_article >= 200) {
            $err_msg_strlen_article = "記事の文字数を200文字以下にしてください";
        }
        if ((isset($title)) && (isset($article)) && (!($strlen_title >= 10)) && (!($strlen_article >= 200))){
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
                header('location: newArticle.php');
                exit();

            } catch (PDOException $e) {
                exit('データベース接続失敗。'.$e->getMessage());
            }

        }
    }
?>

<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8"/>
    <title>新規投稿</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="nav">
    <ul>
        <li><a href="index.php">トップ</a></li>
        <li>新規投稿</li>
        <li><a href="post.php">記事一覧</a></li>
    </ul>
</div>

<?php echo $message; ?>
<form method="post" action="">
    タイトル：<input type="text" name="title" value="<?php echo $title; ?>">
    <p class="warming"><?php echo $err_msg_title; ?></p>
    <p class="warming"><?php echo $err_msg_strlen_title; ?></p>
    記事：<textarea name="article" rows="4" cols="100"><?php echo $article; ?></textarea>
    <p class="warming"><?php echo $err_msg_article; ?></p>
    <p class="warming"><?php echo $err_msg_strlen_article; ?></p>
    <br>
    <input type="submit" name="send" value="作成">
</form>


</body>
</html>