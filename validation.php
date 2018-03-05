<?php

class validation
{
    public $err_msg_title = "";
    public $err_msg_article = "";
    public $err_msg_strlen_title = "";
    public $err_msg_strlen_article = "";
    public $message = "";
    //titleがあるなら"title"なげる
    public $title = (isset($_POST["title"]) === true) ? $_POST["title"] : "";
    //commentがあるなら"comment"なげる
    public $article = (isset($_POST["article"]) === true) ? trim($_POST["article"]) : "";
    public $strlen_title = strlen($title);
    public $strlen_article = strlen($article);

    function validate(){
        if (isset($_POST["send"]) === true)
        {
        if ($title === "")
        {
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
        }
    }
}
?>