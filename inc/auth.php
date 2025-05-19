<?php
    // ユーザーがログインしているかどうかを「セッション変数」で判断するため、必ずこれが最初に必要
    session_start();
    function checkLogin() {
        // セッション変数 $_SESSION['user'] が
        // **空（ログインしてない）**ならログイン画面（login.php）に強制的に移動させて、処理を止める
        if (empty($_SESSION['user'])) {
            header('Location: admin/login.php');
            exit;
        }
    }
?>