<?php

session_start();
session_regenerate_id(true);

$title = 'スタッフ選択NG';
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

        <div class="error">スタッフが選択されていません。</div><br>
        <a href="staff_list.php">スタッフ一覧へ戻る</a>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
