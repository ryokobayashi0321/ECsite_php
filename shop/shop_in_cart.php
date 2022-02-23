<?php

session_start();
session_regenerate_id(true);

$title = 'カートへ追加';
include('../layouts/header.php');
?>

<div class="container">
    <main>

    <?php if (!isset($_SESSION['member_login'])): ?>
        <div class="error text">ログインしてください</div><br><br>
        <a class="btn" href="../member_login/member_login.php">ログイン画面へ</a>
        <a class="back_btn" href="shop_list.php">TOP画面へ</a>
        <?php exit(); ?>
    <?php elseif (isset($_SESSION['member_login'])): ?>
        <?php echo 'ようこそ、' . $_SESSION['member_name'] . '様' . PHP_EOL; ?>
        <a href="../member_login/member_logout.php">ログアウト</a>
        <br><br>
    <?php endif; ?>

    <?php $code = $_GET['code']; ?>

    <?php if (isset($_SESSION['cart']) === true): ?>
        <?php
            $cart = $_SESSION['cart'];
            $num = $_SESSION['num'];
        ?>
        <?php if (in_array($code, $cart) === true): ?>
            <p class="error text">既にカートに登録されています</p><br><br>
            <a class="back_btn" href="shop_list.php">商品一覧へ戻る</a>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (empty($_SESSION['cart']) === true or in_array($code, $cart) === false): ?>
        <?php
            $cart[] = $code;
            $num[] = 1;
            $_SESSION['cart'] = $cart;
            $_SESSION['num'] = $num;
        ?>
        <p class="text">カートに追加しました</p><br><br>
        <p class="top_btn"><a class="back_btn" href="shop_list.php">トップへ戻る</a></p>
    <?php endif; ?>
    </main>
    <?php include('../layouts/aside.php'); ?>
</div>

<?php include('../layouts/footer.php'); ?>
