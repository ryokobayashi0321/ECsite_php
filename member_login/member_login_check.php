<?php

$title = 'ログインチェック';
include('../layouts/header.php');
?>

<div class="container">
    <main>
    <?php

    require_once('../common/common.php');

    $post = sanitize($_POST);
    $email = $post['email'];
    $pass = $post['pass'];
    $pass2 = $post['pass2'];
    $okFlag = true;

    ?>

    <h3>ログイン確認</h3><br>

    <?php if (empty($email) === true): ?>
        <div class="error">emailを入力してください</div>
        <?php $okFlag = false; ?>
    <?php endif; ?>


    <?php if (preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/', $email) === 0): ?>
        <div class="error">正しいemailを入力してください</div>
        <?php $okFlag = false; ?>
    <?php endif; ?>

        <?php if (empty($pass) === true): ?>
        <div class="error">パスワードを入力してください</div>
        <?php $okFlag = false; ?>
    <?php endif; ?>

    <?php if ($pass !== $pass2): ?>
        <div class="error">パスワードが異なります</div>
        <?php $okFlag = false; ?>
    <?php endif; ?>

    <?php if ($okFlag === false): ?>
        <form>
            <br><br>
            <input class="back_btn" type="button" onclick="history.back()" value="戻る">
        </form>
    <?php else: ?>
        <div>下記emailアドレスでログインしますか?</div><br>
        <div>【email】<?php echo $email; ?></div>
        <form action="member_login_done.php" method="post">
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <input type="hidden" name="pass" value="<?php echo $pass; ?>">
            <br><br>
            <input class="back_btn" type="button" onclick="history.back()" value="戻る">
            <input class="btn" type="submit" value="ログイン">
        <?php endif; ?>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
