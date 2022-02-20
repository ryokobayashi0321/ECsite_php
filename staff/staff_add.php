<?php

$title = 'スタッフの追加';
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
        スタッフ追加<br><br>
        <form action="staff_add_check.php" method="post">
            スタッフ名<br>
            <input type="text" name="name">
            <br><br>
            パスワード<br>
            <input type="password" name="pass">
            <br><br>
            パスワード再入力<br>
            <input type="password" name="pass2">
            <br><br>
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value="OK">
        </form>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
