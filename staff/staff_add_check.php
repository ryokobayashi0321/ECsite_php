<?php

$title = 'スタッフ追加チェック';
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

    require_once('../common/common.php');

    $post = sanitize($_POST);
    $name = $post['name'];
    $pass = $post['pass'];
    $pass2 = $post['pass2'];

    if (empty($name) === true) {
        echo '名前が入力されていません' . PHP_EOL;
    } else {
        echo $name . PHP_EOL;
    }

    if (empty($pass) === true) {
        echo 'パスワードが入力されていません' . PHP_EOL;
    }

    if ($pass !== $pass2) {
        echo 'パスワードが異なります' . PHP_EOL;
    }

    if (empty($name) or empty($pass) or $pass !== $pass2) {
        echo '<form>';
        echo '<input type="button" onclick="history.back()" value="戻る">';
        echo '</form>';
    } else {
        $pass = md5($pass);
        echo '上記のスタッフを追加しますか？' . PHP_EOL;
        echo '<form action="staff_add_done.php" method="post">';
        echo '<input type="hidden" name="name" value="'.$name.'">';
        echo '<input type="hidden" name="pass" value="'.$pass.'">';
        echo '<input type="button" onclick="history.back()" value="戻る">';
        echo '<input type="submit" value="OK">';
        echo '</form>';
    }
    ?>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
