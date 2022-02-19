<?php

session_start();
session_regenerate_id(true);

$title = '商品選択画面';
include('../layouts/header.php');
?>

<div class="container">
    <main>
    <?php

    if (isset($_SESSION['member_login']) === true) {
        echo 'ようこそ、' . $_SESSION['member_name'] . '様' . PHP_EOL;
        echo '<a href="../member_login/member_logout.php">ログアウト</a>';
        echo '<br><br>';
    }

    try {
        $code = $_GET['code'];

        require_once('../common/common.php');
        $dbh = dbConnect();
        $sql = 'SELECT * FROM mst_product WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $code;
        $stmt->execute($data);

        $dbh = null;

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($rec['img']) === true) {
            $show_img = '';
        } else {
            $show_img = '<img src="../product/img/'.$rec['img'].'">';
        }
    } catch (Exception $e) {
        echo '只今障害が発生しております。' . PHP_EOL;
        echo '<a href ="../member_login/member_register.php">ログイン画面へ</a>';
    }
    ?>

        <a href="shop_in_cart.php?code=<?php echo $code; ?>">カートに入れる</a>
        <br><br>
        <div class="box">
            <div class="list">
                <div class="img"><?php echo $show_img; ?></div>
                <br>
                <div class="npe">
                商品名:<?php echo $rec['name']; ?>
                <br>
                価格:<?php echo $rec['price']; ?>円
                <br>
                詳細:<?php echo $rec['explanation']; ?>
                </div>
            </div>
        </div>
        <br><br>
        <form>
            <input type="button" onclick="history.back()" value="戻る">
        </form>
    </main>
    <?php include('../layouts/aside.php'); ?>
</div>

<?php include('../layouts/footer.php'); ?>
