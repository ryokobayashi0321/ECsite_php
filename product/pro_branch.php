<?php

session_start();
session_regenerate_id(true);

$title = '商品チェック';
include('../layouts/header.php');
?>

<div class="container">
    <main>
    <?php if (!isset($_SESSION['login'])): ?>
        <div class="error">ログインしていません。</div><br>
        <a href="staff_login.php">ログイン画面へ</a>
        <?php exit(); ?>
    <?php endif; ?>

    <?php

    if (isset($_POST['add']) === true) {
        header('Location:pro_add.php');
        exit();
    }

    if (isset($_POST['show']) === true) {
        if (isset($_POST['code']) === false) {
            header('Location:pro_ng.php');
            exit();
        }
        $code = $_POST['code'];
        header('Location:pro_show.php?code=' . $code);
        exit();
    }

    if (isset($_POST['edit']) === true) {
        if (isset($_POST['code']) === false) {
            header('Location:pro_ng.php');
            exit();
        }
        $code = $_POST['code'];
        header('Location:pro_edit.php?code=' . $code);
        exit();
    }

    if (isset($_POST['delete']) === true) {
        if (isset($_POST['code']) === false) {
            header('Location:pro_ng.php');
            exit();
        }
        $code = $_POST['code'];
        header('Location:pro_delete.php?code=' . $code);
        exit();
    }
    ?>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
