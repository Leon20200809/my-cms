<?php
    require '../inc/auth.php';
    require '../inc/db.php';
    checkLogin();

    // 投稿データの取得とセッションからログインユーザーのIDを取得
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user']['id']; // ログイン中のユーザーID
    $user_name = $_SESSION['user']['username']; // ログイン中のユーザーネーム
    $imagePath = ''; // 画像アップロードの処理は別途対応

    // アップロードされた画像がある場合は保存処理
    if (!empty($_FILES['image']['name'])) {
        $tmp_name = $_FILES['image']['tmp_name'];
        $name = basename($_FILES['image']['name']);
        $imagePath = date('YmdHis') . '_' . $name;
        move_uploaded_file($tmp_name, "../uploads/" . $imagePath);
    }

    // フォームに「id」が含まれていれば、「編集（更新）」モードと判断
    if (!empty($_POST['id'])) {

        // 更新
        // UPDATE 文で、投稿内容を上書き（タイトルと本文）
        // prepare() + execute() で、安全にデータベースに送信
        if($imagePath){
            $stmt = $pdo->prepare("UPDATE mycms_posts SET title = ?, content = ?, image_path = ? WHERE id = ?");
            $stmt->execute([$title, $content, $imagePath, $_POST['id']]);
        } else {
            $stmt = $pdo->prepare("UPDATE mycms_posts SET title = ?, content = ?, WHERE id = ?");
            $stmt->execute([$title, $content, $_POST['id']]);
        }
        
    } else {

        // 新規投稿
        $stmt = $pdo->prepare("INSERT INTO mycms_posts (user_id, username, title, content, image_path) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $user_name, $title, $content, $imagePath]);
    }

    // 完了後にリダイレクト
    header('Location: dashboard.php');
    exit;
?>