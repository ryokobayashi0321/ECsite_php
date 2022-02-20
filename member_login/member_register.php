<?php

$title = '会員情報入力画面';
include('../layouts/header.php');
?>

<div class="container">
    <main>
        新規会員登録画面<br><br>
        <form action="member_register_check.php" method="post">
            お名前<br>
            <input type="text" name="name">
            <br>
            email<br>
            <input type="text" name="email">
            <br>
            住所<br>
            <input type="text" name="address">
            <br>
            TEL<br>
            <input type="text" name="tel">
            <br>
            パスワード<br>
            <input type="password" name="pass">
            <br>
            パスワード再入力<br>
            <input type="password" name="pass2">
            <br><br>
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value="OK">
            <br><br>
        </form>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
