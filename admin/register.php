<?php
    require '../inc/auth.php';
    require '../inc/db.php';
    checkLogin();

    // ユーザー一覧取得
    $stmt1 = $pdo->query("SELECT id, username, role FROM mycms_users ORDER BY id ASC");
    $users = $stmt1->fetchAll(PDO::FETCH_ASSOC);

    // ユーザー登録
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $username = $_POST['user'];
        $password = $_POST['pass'];
        $role = $_POST['role'];
        $icon = null;

        // アイコン画像アップロード
        if(!empty($_FILES['icon']['name'])){
            $iconName = uniqid() . '_' . $_FILES['icon']['name'];
            move_uploaded_file($_FILES['icon']['tmp_name'], '../uploads/user_icons/' . $iconName);
            $icon = $iconName;
        } else {
            $icon = 'default.png';
        }

        $stmt = $pdo->prepare("INSERT INTO mycms_users (username, password, role, icon) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $password, $role, $icon]);

        header('Location: register.php');
        exit;
    }
?>

<?php require '../inc/header.php'; ?>

<form method="post" enctype="multipart/form-data">
    <input name="user" placeholder="ユーザー名" required>
    <input name="pass" type="password" placeholder="パスワード" required>
    <select name="role" required>
        <option value="user">一般ユーザー</option>
        <option value="admin">管理者</option>
    </select>
    <input type="file" name="icon">
    <button type="submit">登録</button>
</form>

<div>
    <h2>ユーザー一覧</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>アイコン</th>
            <th>ユーザー名</th>
            <th>権限</th>
            <th>操作</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['id']) ?></td>
                <td><img src="../uploads/user_icons/<?= htmlspecialchars($user['icon']) ?>" alt="user_icon" width="50" height="50"></td>
                <td><?= htmlspecialchars($user['username']) ?></td>
                <td><?= htmlspecialchars($user['role']) ?></td>
                <td>
                    <?php if ($user['id'] !== $_SESSION['user']['id']): ?>
                        <a href="delete_user.php?id=<?= $user['id'] ?>" onclick="return confirm('本当に削除しますか？')">削除</a>
                    <?php else: ?>
                        自分
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php require '../inc/footer.php'; ?>