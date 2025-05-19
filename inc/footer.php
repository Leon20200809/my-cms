<?php
    // 現在のURLを取得して表示
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
    $currentUrl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>

    <footer>
        <p class="copylight">&copy; <?= date('Y') ?> PHPで作った、Twitter風の自作CMS by Leon.C</p>
    </footer>

<script src="/KR_portfolio/my-cms/js/jquery-3.7.1.min.js"></script>
<script src="/KR_portfolio/my-cms/js/jquery.inview.min.js"></script>
<script src="/KR_portfolio/my-cms/js/main.js"></script>
</body>
</html>


