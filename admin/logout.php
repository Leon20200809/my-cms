<?php
session_start();
session_destroy(); // セッションをすべて消す
header('Location: login.php'); // ログイン画面に戻る
exit;