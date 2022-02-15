<?php

session_start();
session_regenerate_id(true);

if (isset($_SESSION['member_login']) === false) {
    echo 'ログインしてください<br><br>';
    echo '<a href="../member_login/member_login.html">ログイン画面へ</a>';
    echo '<br><br>';
    echo '<a href="shop_list.php">TOP画面へ</a>';
    exit();
} else if  (isset($_SESSION['member_login']) === true) {
    echo 'ようこそ' . PHP_EOL;
    echo $_SESSION['member_name'];
    echo '様' . PHP_EOL;
    echo '<a href="../member_login/member_logout.php">ログアウト</a>';
    echo '<br><br>';
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カートに追加</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php

$code = $_GET['code'];

if (isset($_SESSION['cart']) === true) {
    $cart = $_SESSION['cart'];
    $num = $_SESSION['num'];

    if (in_array($code, $cart) === true) {
        echo '既にカートにあります<br><br>';
        echo '<a href="shop_list.php">商品一覧へ戻る</a>';
    }
}

if (empty($_SESSION['cart']) === true or in_array($code, $cart) === false) {
    $cart[] = $code;
    $num[] = 1;
    $_SESSION['cart'] = $cart;
    $_SESSION['num'] = $num;

    var_dump($_SESSION);
    echo 'カートに追加しました<br><br>';
    echo '<a href="shop_list.php">商品一覧へ戻る</a>';
}
?>
</body>
</html>
