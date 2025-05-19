<?php
require '../inc/auth.php';
require '../inc/db.php';
checkLogin();

$user = $_SESSION['user'];
$user_id = $user['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $icon = $user['icon'];

     // アイコン画像アップロード処理
    if (!empty($_FILES['icon']['name'])) {
        $iconName = uniqid() . '_' . $_FILES['icon']['name'];
        move_uploaded_file($_FILES['icon']['tmp_name'], '../uploads/user_icons/' . $iconName);
        $icon = $iconName;
    }

   // SQL更新
    if ($password) {
        $stmt = $pdo->prepare("UPDATE mycms_users SET username = ?, password = ?, icon = ? WHERE id = ?");
        $stmt->execute([$username, $password, $icon, $user_id]);
    } else {
        $stmt = $pdo->prepare("UPDATE mycms_users SET username = ?, icon = ? WHERE id = ?");
        $stmt->execute([$username, $icon, $user_id]);
    }

    // セッション情報更新
    $_SESSION['user']['username'] = $username;
    $_SESSION['user']['icon'] = $icon;

    header('Location: profile.php');
    exit;
}
?>

<?php require '../inc/header.php'; ?>

<div class="inner">
    <div class="profile-edit">
        <h2>プロフィール編集</h2>

        <form method="post" enctype="multipart/form-data">
            <div class="input-area">
                <label>ユーザー名</label><br>
                <input name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
            </div>

            <div class="input-area">
                <label>パスワード（変更したい場合のみ入力）</label><br>
                <input name="password" value="<?= htmlspecialchars($user['password']) ?>">
            </div>

            <div class="input-area">
                <label>アイコン画像</label>
                <div class="m">
                    <img src="../uploads/user_icons/<?= htmlspecialchars($user['icon'] ?: 'default.png') ?>">
                </div>
                    
                <input type="file" name="icon">
            </div>

            <button type="submit" class="btn"><span class="btn-text">更新する</span></button>
        </form>
    </div>
    
</div>

<style>
    h2{
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .profile-edit{
        text-align: center;
        margin-bottom: 30px;
    }

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
    label{
        display: inline-block;
        margin-bottom: 10px;
    }

    .m img{
        margin: 10px auto;
        border-radius: 50%;
        width: 200px;
        height: 200px;
    }
</style>

<?php require '../inc/footer.php'; ?>
