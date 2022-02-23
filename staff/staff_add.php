<?php

session_start();
session_regenerate_id(true);

$title = 'スタッフの追加';
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

        <h3>スタッフ追加</h3><br>
        <form action="staff_add_check.php" method="post">
            <div>スタッフ名</div>
            <input type="text" name="name">
            <br><br>
            <div>パスワード</div>
            <input type="password" name="pass">
            <br><br>
            <div>パスワード再入力</div>
            <input type="password" name="pass2">
            <br><br>
            <input class="back_btn" type="button" onclick="history.back()" value="戻る">
            <input class="btn" type="submit" value="OK">
        </form>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
