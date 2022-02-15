<?php

session_start();
session_regenerate_id(true);

require_once('../common/common.php');

$post = sanitize($_POST);
$max = $post['max'];
$cart = $_SESSION['cart'];

for ($i = 0; $i < $max; $i++) {
    if (preg_match('/\A[0-9]+\z/', $post['num' . $i]) === 0) {
        echo '正確な数を入力してください<br><br>';
        echo '<a href="shop_look_cart.php">戻る</a>';
        exit();
    }

    if ($post['num' . $i] <= 0 or $post['num' . $i] > 10) {
        echo '0以上、10以下が上限になります<br><br>';
        echo '<a href="shop_look_cart.php">戻る</a>';
        exit();
    }
    $num[] = $post['num' . $i];
}

for ($i = $max; $i >= 0; $i--) {
    if (isset($post['delete' . $i]) === true) {
        array_splice($cart, $i, 1);
        array_splice($num, $i, 1);
    }
}

$_SESSION['cart'] = $cart;
$_SESSION['num'] = $num;
header('Location:shop_look_cart.php');
exit();
