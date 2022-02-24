<?php

$title = 'ログイン入力';
include('../layouts/header.php');
?>

<div class="container">
    <main>
  <h3>会員情報を入力してください</h3><br>
  <form action="member_login_check.php" method="post">
    <div>email</div>
    <input type="text" name="email">
    <br><br>
    <div>パスワード</div>
    <input type="password" name="pass">
    <br><br>
    <div>パスワード再入力</div>
    <input type="password" name="pass2">
    <br><br>
    <input class="btn" type="submit" value="OK">
    <br><br>
    会員情報が未登録の方はこちらから登録お願いします。<br>
    <a href="./member_register.php">会員登録画面へ</a>
  </form>
</main>
</div>

<?php include('../layouts/footer.php'); ?>
