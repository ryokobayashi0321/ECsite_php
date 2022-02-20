<?php

$title = 'ログイン入力';
include('../layouts/header.php');
?>

<div class="container">
    <main>
  会員情報を入力してください
  <br><br>
  <form action="member_login_check.php" method="post">
    emailアドレス<br>
    <input type="text" name="email">
    <br>
    パスワード<br>
    <input type="password" name="pass">
    <br>
    パスワード再入力<br>
    <input type="password" name="pass2">
    <br><br>
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="Ok">
    <br><br>
    会員情報が未登録の方はこちらから登録お願いします。<br>
    <a href="./member_register.php">会員登録画面へ</a>
  </form>
</main>
</div>

<?php include('../layouts/footer.php'); ?>
