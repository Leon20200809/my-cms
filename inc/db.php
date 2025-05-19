<?php
    $host = 'localhost';
    $port = '3306';
    $dbname = 'xs981006_5exsi';
    $user = 'xs981006_3ukoo';
    $pass = 'mgz9zixzgx';
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    // エラーが出たときに、「例外（エラーの情報）」を投げるようにする設定
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

    // データベースに接続 try は「やってみて、もしエラーが起きたら…」という意味
    try { // 成功すると $pdo に「接続情報」が入る
        $pdo = new PDO($dsn, $user, $pass, $options);
        
    } catch (PDOException $e) { // catch は「エラーが起きたときに実行する処理」
        exit('DB接続失敗: ' . $e->getMessage());
    }
?>