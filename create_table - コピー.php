<?php
    require 'inc/db.php';

    // データベースに接続 try は「やってみて、もしエラーが起きたら…」という意味
    try { // 成功すると $pdo に「接続情報」が入る
        $pdo = new PDO($dsn, $user, $pass, $options);
        
        // テーブルを作成するSQL
        $create_table = "CREATE TABLE IF NOT EXISTS espo_users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            icon VARCHAR(255),
            role ENUM('user', 'admin') DEFAULT 'user',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        $create_table2 = "CREATE TABLE IF NOT EXISTS espo_files (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            filename VARCHAR(255) NOT NULL,
            original_name VARCHAR(255),
            file_type VARCHAR(50),
            description TEXT,
            tags VARCHAR(255),
            uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        )";

        // カラムを追加するSQL
        $add_column = "ALTER TABLE mycms_users ADD COLUMN icon VARCHAR(255) DEFAULT NULL;";

        // SQLを実行
        $pdo->exec($create_table2);
        echo "テーブル作成成功！";
        
    } catch (PDOException $e) { // catch は「エラーが起きたときに実行する処理」
        exit('DB接続失敗: ' . $e->getMessage());
    }
?>