<?php

session_start();
session_regenerate_id(true);

$title = 'スタッフ追加チェック';
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

    <?php

    require_once('../common/common.php');

    $post = sanitize($_POST);
    $name = $post['name'];
    $pass = $post['pass'];
    $pass2 = $post['pass2'];

    ?>

    <?php if (empty($name) === true): ?>
        <div class="error">名前が入力されていません。</div>
    <?php else: ?>
        <?php echo 'スタッフ名：' . $name; ?>
    <?php endif; ?>

    <?php if (empty($pass) === true): ?>
        <div class="error">パスワードが入力されていません。</div>
    <?php endif; ?>

    <?php if ($pass !== $pass2): ?>
        <div class="error">パスワードが異なります。</div>
    <?php endif; ?>
    <br><br>

    <?php if (empty($name) or empty($pass) or $pass !== $pass2): ?>
        <form>
            <input class="back_btn" type="button" onclick="history.back()" value="戻る">
        </form>
    <?php else: ?>
        <?php $pass = md5($pass); ?>
        <div>上記のスタッフを追加しますか？</div><br>
        <form action="staff_add_done.php" method="post">
            <input type="hidden" name="name" value="<?php echo $name; ?>">
            <input type="hidden" name="pass" value="<?php echo $pass; ?>">
            <input class="back_btn" type="button" onclick="history.back()" value="戻る">
            <input class="btn" type="submit" value="OK">
        </form>
    <?php endif; ?>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
