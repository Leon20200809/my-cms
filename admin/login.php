<?php
    // セッションとは、「ログインしたユーザーの情報を一時的に保存するしくみ」
    session_start();
    require '../inc/db.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $stmt = $pdo->prepare("SELECT * FROM mycms_users WHERE username = ?");
        $stmt->execute([$_POST['user']]);
        $user = $stmt->fetch();

        if ($user && $_POST['pass'] === $user['password']) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
                'icon' => $user['icon']
            ];
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'ログイン情報が間違っています';
        }
    }
?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- グーグルフォント -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Maru+Gothic&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@1.0.15/destyle.css">
    <link rel="stylesheet" href="/KR_portfolio/my-cms/style.css">

    <title>PHPで作ったTwitter風の自作CMS</title>
</head>
<body>
    <div class="inner">
        <div class="login">
            <h1 class="page-title">PHPで作ったTwitter風の自作CMS</h1>

            <form method="post">
                <div class="input-area">
                    <input name="user" placeholder="ユーザー名">
                </div>
                
                <div class="input-area">
                    <input name="pass" type="password" placeholder="パスワード">
                </div>
                
                <div class="input-area">
                    <button type="submit" class="btn"><span class="btn-text">ログイン</span></button>
                </div>
                
                <?php if (!empty($error)) echo "<p>$error</p>"; ?>
            </form>
        </div>
        
    </div>
</body>

<style>
    .login{
        text-align: center;
        margin-top: 200px;
    }

    .page-title{
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 50px;
    }

    .input-area{
        margin-bottom: 30px;
    }

    input{
        width: 300px;
        line-height: 3;
        border-radius: 10px;
        background-color: aliceblue;
    }
</style>
</html>