<?php

$title = 'スタッフ編集チェック';
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
    $code = $_POST['code'];
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    $pass2 = $_POST['pass2'];

    echo 'スタッフコード<br>';
    echo $code . 'の情報を修正します';
    echo '<br><br>';

    if (empty($name) === true) {
        echo '名前が入力されていません' . PHP_EOL;
    } else {
        echo 'スタッフ名：' . $name;
        echo '<br><br>';
    }

    if (empty($pass) === true) {
        echo 'パスワードが入力されていません。' . PHP_EOL;
    }

    if ($pass !== $pass2) {
        echo 'パスワードが異なります。' . PHP_EOL;
    }

    if (empty($name) or empty($pass) or $pass !== $pass2) {
        echo '<form>';
        echo '<input type="button" onclick="history.back()" value="戻る">';
        echo '</form>';
    } else {
        $pass = md5($pass);
        echo '上記の通りに修正しますか？' . PHP_EOL;
        echo '<form action="staff_edit_done.php" method="post">';
        echo '<input type="hidden" name="name" value="'.$name.'">';
        echo '<input type="hidden" name="pass" value="'.$pass.'">';
        echo '<input type="hidden" name="code" value="'.$code.'">';
        echo '<input type="button" onclick="history.back()" value="戻る">';
        echo '<input type="submit" value="OK">';
        echo '</form>';
    }
    ?>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
