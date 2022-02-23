<?php

$title = 'ログイン入力';
include('../layouts/header.php');
?>

<div class="container">
  <main>
    <h3>スタッフのログイン</h3><br>
    <form action="staff_login_check.php" method="post">
      <div>スタッフコード</div>
      <input type="text" name="code">
      <br><br>
      <div>パスワード</div>
      <input type="password" name="pass">
      <br><br>
      <input class="btn" type="submit" value="OK">
    </form>
  </main>
</div>

<?php include('../layouts/footer.php'); ?>
