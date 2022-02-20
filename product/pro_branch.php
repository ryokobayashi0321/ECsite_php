<?php

$title = '商品チェック';
include('../layouts/header.php');
?>

<div class="container">
    <main>
    <?php

    session_start();
    session_regenerate_id(true);
    if (isset($_SESSION['login']) === false) {
        echo 'ログインしていません。' . PHP_EOL;
        echo '<a href="staff_login.php">ログイン画面へ</a>';
        exit();
    }

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
