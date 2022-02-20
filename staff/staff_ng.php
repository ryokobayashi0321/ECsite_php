<?php

$title = 'スタッフ選択NG';
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
    } else {
        echo $_SESSION['name'] . 'さんログイン中' . PHP_EOL;
        echo '<br><br>';
    }
    ?>
        スタッフが選択されていません。<br><br>
        <a href="staff_list.php">スタッフ一覧へ戻る</a>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
