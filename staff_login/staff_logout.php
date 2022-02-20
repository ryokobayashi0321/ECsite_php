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
        ログアウトしました。<br><br>
        <a href="staff_login.php">ログイン画面へ</a>
    </main>
    <?php include('../layouts/aside.php'); ?>
</div>

<?php include('../layouts/footer.php'); ?>
