<?php
    // require は「他のファイルを読み込む」命令
    require 'inc/db.php';
    require 'inc/auth.php';
    checkLogin();

    $sql = "SELECT mycms_posts.*, mycms_users.username, mycms_users.icon
            FROM mycms_posts
            JOIN mycms_users ON mycms_posts.user_id = mycms_users.id
            ORDER BY mycms_posts.created_at DESC
        ";

    // データベースに命令（SQL）を送ってデータ（posts テーブルの全てのデータ）を取得
    $stmt = $pdo->query($sql);
?>

    <?php require './inc/header.php'; ?>

    <main>
        <div class="inner">
            <h1>PHPで作った、Twitter風の自作CMS</h1>

            <ul class="contents">
                <?php foreach ($stmt as $row): ?>
                    <li class="item">
                        <div class="flex">
                            <div class="left">
                                <img class="user-icon" src="/KR_portfolio/my-cms/uploads/user_icons/<?= htmlspecialchars($row['icon'] ?: 'default.png'); ?>" alt="">
                            </div>

                            <div class="right">
                                <p class="username"><?= $row['username']; ?></p>
                                <p class="created_at"><?= $row['created_at'] ?></p>
                                <p><?= htmlspecialchars($row['title']) ?></p>
                                
                            </div>
                        </div>
                        
                        <div class="bottom">
                            <?php if (!empty($row['image_path'])): ?>
                                <div class="post-img">
                                    <img src="uploads/<?= htmlspecialchars($row['image_path']) ?>" alt="投稿画像">
                                </div>
                            <?php endif; ?>

                            <p class="content"><?= $row['content'] ?></p>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </main>

    <style>
        h1{
            text-align: center;
            font-size: 1.5rem;
        }
    </style>
    
    <?php require './inc/footer.php'; ?>


