<?php

session_start();
session_regenerate_id(true);

$title = 'ECサイトTOP';
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
        require_once('../common/common.php');
        $dbh = dbConnect();
        $sql = 'SELECT * FROM mst_product WHERE 1';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        $dbh = null;

        echo '販売商品一覧' . PHP_EOL;
        echo '<a href="shop_look_cart.php">カートを見る</a>';
        echo '<br><br>';

        while (true) {
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($rec === false) {
                break;
            }
            $code = $rec['code'];
            echo '<a href="shop_product.php?code='.$code.'">';
            if (empty($rec['img']) === true) {
                $img = '';
            } else {
                $img = '<img src="../product/img/'.$rec['img'].'">';
            }
            echo '<div class="box">';
            echo '<div class="list">';
            echo '<div class="img">' . $img . '</div>';
            echo '<br>';
            echo '商品名：' . $rec['name'];
            echo '<br>';
            echo '価格：' . $rec['price'] . '円';
            echo '<br>';
            echo '詳細：' . $rec['explanation'];
            echo '</div></div></a>';
            echo '<br><br>';
        }

    } catch (Exception $e) {
        echo '只今障害が発生しております。' . PHP_EOL;
        echo '<a href ="../member_login/member_login.php">ログイン画面へ</a>';
    }
    ?>
    <p class="top_btn"><a href="shop_list.php">トップへ戻る</a></p>
    </main>
    <?php include('../layouts/aside.php'); ?>
</div>

<?php include('../layouts/footer.php'); ?>
