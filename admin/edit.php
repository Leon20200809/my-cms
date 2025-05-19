<?php
    require '../inc/auth.php';
    require '../inc/db.php';
    checkLogin();

    // 初期値として、空の投稿データを用意
    $post = ['title' => '', 'content' => ''];

    // URLに ?id=3 などがある場合、「編集モード」のときに実行
    // SQL文に変動値がない場合：query
    // SQL文に変動値がある場合：prepare⇒bindValue⇒execute
    if (!empty($_GET['id'])) {
        $stmt = $pdo->prepare("SELECT * FROM mycms_posts WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $post = $stmt->fetch();
    }
?>

<?php require '../inc/header.php'; ?>

<div class="inner">
    <div class="new-post">
        <form method="post" action="save.php" enctype="multipart/form-data">
            <!-- $_GET['id'] ?? '' は、「idがあるなら使う。なければ空文字」 -->
            <div class="input-area">
                <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id'] ?? '') ?>">
            </div>

            <div class="input-area">
                <input name="title" value="<?= htmlspecialchars($post['title']) ?>" placeholder="タイトル">
            </div>

            <div class="input-area">
                <textarea name="content" rows="10" placeholder="本文を入力"><?= htmlspecialchars($post['content']) ?></textarea>
            </div>

            <div class="input-area">
                <input type="file" name="image" accept="image/*">
            </div>

            <div class="input-area">
                <button type="submit" class="btn"><span class="btn-text">保存</span></button>
            </div>
        </form>
    </div>
</div>

<style>
    .input-area{
        margin-bottom: 30px;
    }

    input, textarea{
        width: 80%;
        background-color: #fff;
        border-radius: 10px;
        text-align: left;
        padding: 2%;
        line-height: 1.5;
    }
</style>


<?php require '../inc/footer.php'; ?>