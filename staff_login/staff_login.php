<?php

$title = 'ログイン入力';
include('../layouts/header.php');
?>

<div class="container">
  <main>
    スタッフのログイン<br><br>
    <form action="staff_login_check.php" method="post">
      スタッフコード<br>
      <input type="text" name="code">
      <br><br>
      パスワード<br>
      <input type="password" name="pass">
      <br><br>
      <input type="submit" value="OK">
    </form>
  </main>
    <?php include('../layouts/aside.php'); ?>
</div>

<?php include('../layouts/footer.php'); ?>
