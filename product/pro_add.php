<?php

session_start();
session_regenerate_id(true);

$title = '商品追加';
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

    <h3>商品追加</h3><br>
    <form action="pro_add_check.php" method="post" enctype="multipart/form-data">
        <div>【カテゴリー】</div>
        <?php require_once('../common/common.php'); ?>
        <?php echo pulldown_cate(); ?>
        <br><br>
        【商品名】<br>
        <input type="text" name="name">
        <br><br>
        【価格】<br>
        <input type="text" name="price">
        <br><br>
        【画像】<br>
        <input type="file" name="img">
        <br><br>
        【詳細】<br>
        <textarea class="textarea" name="comments"></textarea>
        <br><br>
        <input class="back_btn" type="button" onclick="history.back()" value="戻る" >
        <input class="btn" type="submit" value="OK">
    </form>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
