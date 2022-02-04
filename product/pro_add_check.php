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
    <title>商品追加チェック</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<?php

require_once('../common/common.php');

$post = sanitize($_POST);
$name = $post['name'];
$price = $post['price'];
$img = $_FILES['img'];
$comments = $post['comments'];
$cate = $post['cate'];

echo $cate . PHP_EOL;

if (empty($name) === true) {
    echo '商品名が入力されていません。' . PHP_EOL;
} else {
    echo $name;
    echo '<br><br>';
}

// 正規表現されていれば１となり、ＮＧなら0、preg_match(正規表現、正規表現したい値）
if (preg_match("/\A[0-9]+\z/", $price) === 0) {
    echo '正しい値を入力してください' . PHP_EOL;
} else {
    echo $price . '円';
    echo '<br><br>';
}

if ($img['size'] > 0) {
    if ($img['size'] > 1000000) {
        echo 'ファイルのサイズが大きすぎます' . PHP_EOL;
    } else {
        move_uploaded_file($img['tmp_name'], './img/' . $img['name']);
        echo '<img src="./img/'.$img['name'].'">';
        echo '<br><br>';
    }
}

if (empty($comments) === true) {
    echo '詳細が入力されていません' . PHP_EOL;
    echo '<br><br>';
}

if (mb_strlen($comments) > 100) {
    echo '文字数は100文字が上限です' . PHP_EOL;
    echo '<br><br>';
} else {
    echo $comments;
    echo '<br><br>';
}

if (empty($name) or preg_match("/\A[0-9]+\z/", $price) === 0 or $img['size'] > 1000000 or empty($comments) or mb_strlen($comments) > 100) {
    echo '<form>';
    echo '<input type="button" onclick="history.back()" value="戻る">';
    echo '</form>';
} else {
    echo '上記商品を追加しますか？' . PHP_EOL;
    echo '<form action="pro_add_done.php" method="post">';
    echo '<input type="hidden" name="cate" value="'.$cate.'">';
    echo '<input type="hidden" name="name" value="'.$name.'">';
    echo '<input type="hidden" name="price" value="'.$price.'">';
    echo '<input type="hidden" name="img" value="'.$img['name'].'">';
    echo '<input type="hidden" name="comments" value="'.$comments.'">';
    echo '<input type="button" onclick="history.back()" value="戻る">';
    echo '<input type="submit" value="OK">';
    echo '</form>';
}
?>
</body>
</html>
