<?php

session_start();
session_regenerate_id(true);

$title = '商品購入チェック';
include('../layouts/header.php');
?>

<div class="container">
    <main>
    <?php if (!isset($_SESSION['member_login'])): ?>
        <div class="error">ログインしてください</div><br><br>
        <a class="btn" href="../member_login/member_login.php">ログイン画面へ</a>
        <a class="back_btn" href="shop_list.php">TOP画面へ</a>
        <?php exit(); ?>
    <?php elseif (isset($_SESSION['member_login'])): ?>
        <?php echo 'ようこそ、' . $_SESSION['member_name'] . '様' . PHP_EOL; ?>
        <a href="../member_login/member_logout.php">ログアウト</a>
        <br><br>
    <?php endif; ?>

    <h3>【ご注文内容】</h3><br>
    <?php

    try {
        $member_code = $_SESSION['member_code'];
        $cart = $_SESSION['cart'];
        $num = $_SESSION['num'];
        $max = count($num);

        require_once('../common/common.php');
        $dbh = dbConnect();
        $sql = 'SELECT * FROM member WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $member_code;
        $stmt->execute($data);

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        $name = $rec['name'];
        $email = $rec['email'];
        $address = $rec['address'];
        $tel = $rec['tel'];

        for ($i = 0; $i < $max; $i++) {
            $sql = 'SELECT * FROM mst_product WHERE code=?';
            $stmt = $dbh->prepare($sql);
            $data = array();
            $data[] = $cart[$i];
            $stmt->execute($data);

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);

            if (empty($rec['img']) === true) {
                $show_img = '';
            } else {
                $show_img = '<img src="../product/img/'.$rec['img'].'">';
            }

            echo '<div class="box">';
            echo '<div class="list">';
            echo '<div class="img">' . $show_img . '</div>';
            echo '<div class="npe">';
            echo '商品名: ' . $rec['name'] . '<br>';
            echo '価格: ' . $rec['price'] . '円<br>';
            echo '数量: ' . $num[$i] . '<br>';
            echo '合計価格: ' . $rec['price'] * $num[$i] . '円<br><br>';
            $total[] = $rec['price'] * $num[$i];
            echo '</div></div></div><br>';
        }
        $dbh = null;

    } catch (Exception $e) {
        echo "只今障害が発生しております。<br><br>";
        echo "<a href='../staff_login/staff_login.php'>ログイン画面へ</a>";
    }
    ?>
        <h3>【ご請求額】 </h3>
        <p> --- ¥ <?php echo array_sum($total); ?> 円</p><br><br>
        <form action="shop_form_done.php" method="post">
            <input type="hidden" name="name" value="">
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <input type="hidden" name="address" value="<?php echo $address; ?>">
            <input type="hidden" name="tel" value="<?php echo $tel; ?>">
            <input class="back_btn" type="button" onclick="history.back()" value="戻る">
            <input class="btn" type="submit" value="OK">
        </form>
    </main>
    <?php include('../layouts/aside.php'); ?>
</div>

<?php include('../layouts/footer.php'); ?>
