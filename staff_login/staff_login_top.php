<?php

session_start();
session_regenerate_id(true);

$title = '管理画面TOP';
include('../layouts/header.php');
?>

<div class="container">
    <main>
    <?php if (!isset($_SESSION['login'])): ?>
        <div class="error">ログインしていません。</div><br>
        <a href="staff_login.php">ログイン画面へ</a>
        <?php exit(); ?>
    <?php else: ?>
        <?php echo $_SESSION['name'] . 'さんログイン中' . PHP_EOL; ?>
        <br><br>
    <?php endif; ?>

        <h3>管理画面TOP</h3><br>
        <a href="../staff/staff_list.php">スタッフ管理</a>
        <br><br>
        <a href="../product/pro_list.php">商品管理</a>
        <br><br>
        <a href="staff_logout.php">ログアウト</a>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
