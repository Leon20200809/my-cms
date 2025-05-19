<?php
    require '../inc/auth.php';
    require '../inc/db.php';
    checkLogin();

    // 投稿データを取得（画像ファイル名を取得するため）
    if(!empty($_GET['id'])){
        $stmt = $pdo->prepare("SELECT * FROM mycms_posts WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $post = $stmt->fetch();

        if($post){
            // 画像が存在すれば画像をアップロードフォルダから削除
            if(!empty($post['image_path'])){
                $imagePath = '../uploads/' . $post['image_path'];
                if(file_exists($imagePath)){
                    unlink($imagePath);
                }
            }
        }

        // 投稿を削除
        $stmt = $pdo->prepare("DELETE FROM mycms_posts WHERE id = ?");
        $stmt->execute([$_GET['id']]);
    }

    header('Location: dashboard.php');
    exit;
?>