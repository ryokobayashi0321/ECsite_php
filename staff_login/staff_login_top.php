<?php

session_start();
session_regenerate_id(true);
if (isset($_SESSION['login']) === false) {
    echo 'ログインしていません。' . PHP_EOL;
    echo '<a href="staff_login.html">ログイン画面へ</a>';
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
    <title>管理画面TOP</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    管理画面TOP<br><br>
    <a href="../staff/staff_list.php">スタッフ管理</a>
    <br><br>
    <a href="../product/product_list.php">商品管理</a>
    <br><br>
    <a href="staff_logout.php">ログアウト</a>
</body>
</html>
