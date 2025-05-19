
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- グーグルフォント -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Maru+Gothic&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@1.0.15/destyle.css">
    <link rel="stylesheet" href="/KR_portfolio/my-cms/style.css">

    <meta name="description" content="PHPで作った、Twitter風の自作CMS">
    <title>PHPで作った、Twitter風の自作CMS</title>
</head>
<body>
    <header id="header">

        <div id="mask">
            <nav class="navi-menu">
                <ul>
                    <li><a class="" href="https://xs981006.xsrv.jp/KR_portfolio/my-cms/index.php"><span class="btn-text">トップ</span></a></li>
                    <li><a class="" href="/KR_portfolio/my-cms/admin/dashboard.php"><span class="btn-text">ダッシュボード</span></a></li>
                    <li><a class="" href="/KR_portfolio/my-cms/admin/profile.php"><span class="btn-text">プロフィール編集</span></a></li>
                    <li><a class="" href="/KR_portfolio/my-cms/admin/logout.php"><span class="btn-text">ログアウト</span></a></li>
                </ul>
            </nav>
        </div>
        
        <div class="login-user">
            <p><img class="user-icon" src="/KR_portfolio/my-cms/uploads/user_icons/<?= htmlspecialchars($_SESSION['user']['icon'] ?: 'default.png'); ?>" alt=""></p>
            <h1>ようこそ <?= htmlspecialchars($_SESSION['user']['username']) ?> さん！（<?= $_SESSION['user']['role'] === 'admin' ? '管理者' : '一般ユーザー' ?>）</h1>
        </div>
    
        <div class="pc">
            <nav class="navi-menu">
                <ul>
                    <li><a class="btn" href="https://xs981006.xsrv.jp/KR_portfolio/my-cms/index.php"><span class="btn-text">トップ</span></a></li>
                    <li><a class="btn" href="/KR_portfolio/my-cms/admin/dashboard.php"><span class="btn-text">ダッシュボード</span></a></li>
                    <li><a class="btn" href="/KR_portfolio/my-cms/admin/profile.php"><span class="btn-text">プロフィール編集</span></a></li>
                    <li><a class="btn" href="/KR_portfolio/my-cms/admin/logout.php"><span class="btn-text">ログアウト</span></a></li>
                </ul>
            </nav>
        </div>
        
        <div class="sp">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            
        </div>
        
    </header>
