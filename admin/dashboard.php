<?php
    require '../inc/auth.php';
    require '../inc/db.php';
    checkLogin();
    

    // どのユーザーか
    if (empty($_SESSION['user'])) {
        header('Location: login.php');
        exit;
    }

    // ユーザーIDのチェック
    $user_id = $_SESSION['user']['id'];

    $sql = "SELECT mycms_posts.*, mycms_users.username, mycms_users.icon
            FROM mycms_posts
            JOIN mycms_users ON mycms_posts.user_id = mycms_users.id
            ORDER BY mycms_posts.created_at DESC
    ";

    $sql1 = "SELECT mycms_posts.*, mycms_users.username, mycms_users.icon
            FROM mycms_posts
            JOIN mycms_users ON mycms_posts.user_id = mycms_users.id
            WHERE user_id = ?
            ORDER BY mycms_posts.created_at DESC
    ";

    // 管理者のみ全投稿表示
    if($_SESSION['user']['role'] === 'admin'){
        $stmt = $pdo->query($sql);
    } else {
        $stmt = $pdo->prepare($sql1);
        $stmt->execute([$user_id]);
    }
?>

<?php require '../inc/header.php'; ?>

<main>
    <div class="inner">
        
            <?php if (!empty($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin'): ?>
                <div class="admin-menu">
                    <h2>⚙ 管理者専用メニュー</h2>
                    <ul>
                        <li><a href="./register.php">ユーザー一覧・登録</a></li>
                        <li><a href="settings.php">サイト設定</a></li>
                    </ul>
                </div>
            <?php endif; ?>
        

        <div class="new-post">
            <a class="btn" href="edit.php">
                <span class="btn-text">新規投稿</span>
            </a>
        </div>

        <ul class="contents">
            <?php foreach ($stmt as $row): ?>
                <li class="item">
                    <div class="flex">
                        <div class="left">
                            <img class="user-icon" src="/KR_portfolio/my-cms/uploads/user_icons/<?= htmlspecialchars($row['icon'] ?: 'default.png'); ?>" alt="">
                        </div>

                        <div class="right">
                            <p class="username"><?= $row['username']; ?></p>
                            <p class="created_at"><?= $row['created_at'] ?><a href="edit.php?id=<?= $row['id'] ?>">[編集] </a><a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('本当に削除しますか？')">[削除]</a></p>
                            <p><?= htmlspecialchars($row['title']) ?></p>
                            
                        </div>
                    </div>
                    
                    <div class="bottom">
                        <?php if (!empty($row['image_path'])): ?>
                            <div class="post-img">
                                <img src="../uploads/<?= htmlspecialchars($row['image_path']) ?>" alt="投稿画像">
                            </div>
                        <?php endif; ?>

                        <p class="content"><?= $row['content'] ?></p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

        
    </div>
</main>

<?php require '../inc/footer.php'; ?>

