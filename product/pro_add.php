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
    <title>商品追加</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <form action="pro_add_check.php" method="post" enctype="multipart/form-data">
        商品追加<br><br>
        カテゴリー<br>
        <?php require_once('../common/common.php'); ?>
        <?php echo pulldown_cate(); ?>
        <br><br>
        商品名<br>
        <input type="text" name="name">
        <br><br>
        価格<br>
        <input type="text" name="price">
        <br><br>
        画像<br>
        <input type="file" name="img">
        <br><br>
        詳細<br>
        <textarea name="comments" style="width: 500px; height: 100px;"></textarea>
        <br><br>
        <input type="button" onclick="history.back()" value="戻る" >
        <input type="submit" value="OK">
    </form>
</body>
</html>
