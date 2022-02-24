<?php

$title = '会員情報入力画面';
include('../layouts/header.php');
?>

<div class="container">
    <main>
        <h3>新規会員登録画面</h3><br>
        <form action="member_register_check.php" method="post">
            <div>お名前</div>
            <input type="text" name="name">
            <br><br>
            <div>email</div>
            <input type="text" name="email">
            <br><br>
            <div>住所</div>
            <input type="text" name="address">
            <br><br>
            <div>TEL</div>
            <input type="text" name="tel">
            <br><br>
            <div>パスワード</div>
            <input type="password" name="pass">
            <br><br>
            <div>パスワード再入力</div>
            <input type="password" name="pass2">
            <br><br>
            <input class="btn" type="submit" value="OK">
            <br><br>
        </form>
        <a href="member_login.php">ログイン画面へ</a>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
