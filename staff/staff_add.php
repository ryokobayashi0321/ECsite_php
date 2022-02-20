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

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>スタッフの追加</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
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
</body>
</html>
