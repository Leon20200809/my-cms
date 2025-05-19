<?php
require '../inc/db.php';
require '../inc/auth.php';
checkLogin();

// 管理者のみ許可
if ($_SESSION['user']['role'] !== 'admin') {
    exit('このページは管理者専用です。');
}

// 削除対象のIDを取得
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    exit('無効なIDです。');
}

$user_id = (int)$_GET['id'];

// 自分自身を削除しないようにする
if ($user_id === $_SESSION['user']['id']) {
    exit('自分自身は削除できません。');
}

// ユーザー削除
$stmt = $pdo->prepare("DELETE FROM mycms_users WHERE id = ?");
$stmt->execute([$user_id]);

// 完了後リダイレクト
header('Location: register.php');
exit;
