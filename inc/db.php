<?php
    // config.php を読み込む
    $config = require_once __DIR__ . '/../config.php';

    $host = $config['host'];
    $port = $config['port'];
    $dbname = $config['dbname'];
    $user = $config['user'];
    $pass = $config['pass'];

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