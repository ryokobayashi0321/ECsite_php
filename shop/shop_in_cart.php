<?php

session_start();
session_regenerate_id(true);

$title = 'カートへ追加';
include('../layouts/header.php');
?>

<div class="container">
    <main>
    <?php

    if (!isset($_SESSION['member_login'])) {
        echo 'ログインしてください<br><br>';
        echo '<a href="../member_login/member_login.php">ログイン画面へ</a>';
        echo '<br><br>';
        echo '<a href="shop_list.php">TOP画面へ</a>';
        exit();
    } else if (isset($_SESSION['member_login'])) {
        echo 'ようこそ、' . $_SESSION['member_name'] . '様' . PHP_EOL;
        echo '<a href="../member_login/member_logout.php">ログアウト</a>';
        echo '<br><br>';
    }

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

        echo 'カートに追加しました<br><br>';
        echo '<a href="shop_list.php">商品一覧へ戻る</a>';
    }
    ?>
    </main>
    <?php include('../layouts/aside.php'); ?>
</div>

<?php include('../layouts/footer.php'); ?>
