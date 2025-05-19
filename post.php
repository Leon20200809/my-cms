<?php
    require 'inc/db.php';
    $stmt = $pdo->prepare("SELECT * FROM mycms_posts WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $post = $stmt->fetch();
?>

<h1><?= htmlspecialchars($post['title']) ?></h1>
<p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
<p><?= htmlspecialchars($post['username']) ?>　<?= htmlspecialchars($post['created_at']) ?></p>
<p><a href="index.php">一覧にもどる</a></p>

<?php require './inc/footer.php'; ?>