<?php

session_start();
session_regenerate_id(true);

if (!isset($_SESSION['login'])) {
    echo 'ログインしていません。' . PHP_EOL;
    echo '<a href="staff_login.php">ログイン画面へ</a>';
    exit();
} else {
    echo $_SESSION['name'] . 'さんログイン中' . PHP_EOL;
    echo '<br><br>';
}

$title = '管理画面TOP';
include('../layouts/header.php');
?>

<div class="container">
    <main>
        管理画面TOP<br><br>
        <a href="../staff/staff_list.php">スタッフ管理</a>
        <br><br>
        <a href="../product/product_list.php">商品管理</a>
        <br><br>
        <a href="staff_logout.php">ログアウト</a>
    </main>
    <?php include('../layouts/aside.php'); ?>
</div>

<?php include('../layouts/footer.php'); ?>
