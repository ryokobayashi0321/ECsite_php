<?php

session_start();
session_regenerate_id(true);

$title = 'カート情報';
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

    <?php if (!isset($_SESSION['cart'])): ?>
        <div class="error">カートに商品はありません</div><br><br>
        <a class="back_btn" href="shop_list.php">商品一覧へ戻る</a>
        <?php exit(); ?>
    <?php endif; ?>

    <?php

    try {
        $cart = $_SESSION['cart'];
        $num = $_SESSION['num'];
        $max = count($cart);

        require_once('../common/common.php');
        $dbh = dbConnect();

        foreach ($cart as $key => $value) {
            $sql = 'SELECT * FROM mst_product WHERE code=?';
            $stmt = $dbh->prepare($sql);
            $data[0] = $value;
            $stmt->execute($data);

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);

            $name[] = $rec['name'];
            $price[] = $rec['price'];
            $img[] = $rec['img'];
        }

        $dbh = null;

    } catch (Exception $e) {
        echo '只今障害が発生しております。' . PHP_EOL;
        echo '<a href ="../staff_login/staff_login.php">ログイン画面へ</a>';
    }
    ?>

        <h3>カート一覧</h3><br>
        <form action="shop_num.php" method="post">
            <?php for ($i = 0; $i < $max; $i++): ?>
                <?php if (empty($img[$i]) === true): ?>
                    <?php $show_img = ''; ?>
                <?php else: ?>
                    <?php $show_img = '<img src="../product/img/'.$img[$i].'">'; ?>
                <?php endif; ?>
                <div class="box">
                    <div class="list">
                        <div class="img"><?php echo $show_img; ?></div>
                        <br>
                        <div class="npe">
                            <div>商品名：<?php echo $rec['name']; ?></div>
                            <div>価格：<?php echo $rec['price']; ?>円</div>
                            <div>詳細：<?php echo $rec['explanation']; ?></div>
                            <div>数量：<input type="text" name="num<?php echo $i; ?>" value="<?php echo $num[$i]; ?>"></div>
                            <div>合計価格：<?php echo $price[$i] * $num[$i]; ?>円</div>
                            <div>削除：<input type="checkbox" name="<?php echo 'delete'. $i; ?>'"></div>
                        </div>
                    </div>
                </div>
                <br>
            <?php endfor; ?>
            <input type="hidden" name="max" value="<?php echo $max; ?>">
            <input class="btn_slc" type="submit" value="数量変更/削除">
            <br><br>
        </form>
        <a class="back_btn" href="shop_list.php">トップへ戻る</a>
        <a class="btn" href="shop_form_check.php">ご購入手続きへ進む</a>
        <br><br>
    </main>
    <?php include('../layouts/aside.php'); ?>
</div>

<?php include('../layouts/footer.php'); ?>
