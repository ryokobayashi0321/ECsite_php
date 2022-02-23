<?php

session_start();
session_regenerate_id(true);

$title = '数量チェック';
include('../layouts/header.php');
?>

<div class="container">
    <main>
    <?php if (!isset($_SESSION['member_login'])): ?>
        <p class="error text">ログインしてください</p><br><br>
        <a class="btn" href="../member_login/member_login.php">ログイン画面へ</a>
        <a class="back_btn" href="shop_list.php">TOP画面へ</a>
        <?php exit(); ?>
    <?php elseif (isset($_SESSION['member_login'])): ?>
        <?php echo 'ようこそ、' . $_SESSION['member_name'] . '様' . PHP_EOL; ?>
        <a href="../member_login/member_logout.php">ログアウト</a>
        <br><br>
    <?php endif; ?>

    <?php

    require_once('../common/common.php');

    $post = sanitize($_POST);
    $max = $post['max'];
    $cart = $_SESSION['cart'];

    ?>

    <?php for ($i = 0; $i < $max; $i++): ?>
        <?php if (preg_match('/\A[0-9]+\z/', $post['num' . $i]) === 0): ?>
            <div class="error text">正確な数を入力してください</div><br>
            <a class="back_btn" href="shop_look_cart.php">戻る</a>
            <?php exit(); ?>
        <?php endif; ?>

        <?php if ($post['num' . $i] <= 0 or $post['num' . $i] > 10): ?>
            <div class="error text">0以上、10以下が上限になります</div><br>
            <a class="back_btn" href="shop_look_cart.php">戻る</a>
            <?php exit(); ?>
        <?php endif; ?>
            <?php $num[] = $post['num' . $i]; ?>
    <?php endfor; ?>

    <?php

    for ($i = $max; $i >= 0; $i--) {
        if (isset($post['delete' . $i]) === true) {
            array_splice($cart, $i, 1);
            array_splice($num, $i, 1);
        }
    }

    $_SESSION['cart'] = $cart;
    $_SESSION['num'] = $num;
    header("Location:shop_look_cart.php");
    exit();
    ?>


        <p class="top_btn"><a class="back_btn" href="shop_look_cart.php">カートへ戻る</a></p>
    </main>
    <?php include('../layouts/aside.php'); ?>
</div>

<?php include('../layouts/footer.php'); ?>
