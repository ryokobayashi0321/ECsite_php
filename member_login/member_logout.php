<?php

session_start();
$_SESSION = array();
if (isset($_COOKIE[session_name()]) === true) {
    setcookie(session_name(), '', time()-42000, '/');
}
session_destroy();

$title = 'ログアウト';
include('../layouts/header.php');
?>

<div class="container">
    <main>
        <p class="error text">ログアウトしました。</p>
        <br><br>
        <a class="back_btn" href="../shop/shop_list.php">TOPへ</a>
        <br><br>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
