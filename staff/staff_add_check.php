<?php

session_start();
session_regenerate_id(true);
if (isset($_SESSION['login']) === false) {
    print 'ログインしていません。' . PHP_EOL;
    print "<a href='staff_login.html'>ログイン画面へ</a>";
    exit();
} else {
    print $_SESSION['name'] . 'さんログイン中' . PHP_EOL;
    print "<br><br>";
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>スタッフ追加チェック</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php

require_once('../common/common.php');

$post = sanitize($_POST);
$name = $post['name'];
$pass = $post['pass'];
$pass2 = $post['pass2'];

if (empty($name) === true) {
    print '名前が入力されていません' . PHP_EOL;
} else {
    print $name . PHP_EOL;
}

if (empty($pass) === true) {
    print 'パスワードが入力されていません' . PHP_EOL;
}

if ($pass !== $pass2) {
    print 'パスワードが異なります' . PHP_EOL;
}

if (empty($name) or empty($pass) or $pass !== $pass2) {
    print "<form>";
    print "<input type='button' onclick='history.back()' value='戻る'>";
    print "</form>";
} else {
    $pass = md5($pass);
    print '上記のスタッフを追加しますか？' . PHP_EOL;
    print "<form action='staff_add_done.php' method='post'>";
    print "<input type='hidden' name='name' value='".$name."'>";
    print "<input type='hidden' name='pass' value='".$pass."'>";
    print "<input type='button' onclick='history.back()' value='戻る'>";
    print "<input type='submit' value='OK'>";
    print "</form>";
}
?>
</body>
</html>
