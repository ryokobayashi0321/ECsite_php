<?php

session_start();
session_regenerate_id(true);

$title = '食品';
include('../layouts/header.php');
?>

<div class="container">
    <main>
    <?php if (isset($_SESSION['member_login'])): ?>
        <?php echo 'ようこそ、' . $_SESSION['member_name'] . '様' . PHP_EOL; ?>
        <a href="../member_login/member_logout.php">ログアウト</a>
        <br><br>
    <?php endif; ?>

    <?php

    try {
        require_once('../common/common.php');
        $dbh = dbConnect();
        $sql = 'SELECT * FROM mst_product WHERE category=?';
        $stmt = $dbh->prepare($sql);
        $data[] = '食品';
        $stmt->execute($data);

        $dbh = null;

    } catch (\Throwable $th) {
        echo "只今障害が発生しております。<br><br>";
        echo "<a href='../staff_login/staff_login.php'>ログイン画面へ</a>";
    }
    ?>

        <h3>販売商品一覧</h3><br>
        <a class="btn_slc" href="shop_look_cart.php">カートを見る</a>
        <br><br>

        <?php while (true): ?>
            <?php $rec = $stmt->fetch(PDO::FETCH_ASSOC); ?>
            <?php if ($rec === false): ?>
                <?php break; ?>
                <div class="pro_ng">これ以下には商品が登録されておりません。</div><br>
            <?php else: ?>
                <?php $code = $rec['code']; ?>
                <a href="shop_show_pro.php?code=<?php echo $code; ?>">
            <?php endif; ?>

                    <?php if (empty($rec['img']) === true): ?>
                        <?php $img = ''; ?>
                    <?php else: ?>
                        <?php $img = '<img src="../product/img/'.$rec['img'].'">'; ?>
                    <?php endif; ?>

                    <div class="box">
                        <div class="list">
                            <div class="img"><?php echo $img; ?></div>
                            <br>
                            <div class="npe">
                                <div>商品名：<?php echo $rec['name']; ?></div>
                                <div>価格：<?php echo $rec['price']; ?>円</div>
                                <div>詳細：<?php echo $rec['explanation']; ?></div>
                            </div>
                        </div>
                    </div>
                </a>
            <br><br>
        <?php endwhile; ?>
        <p class="top_btn"><a class="back_btn" href="shop_list.php">トップへ戻る</a></p>
    </main>
    <?php include('../layouts/aside.php'); ?>
</div>

<?php include('../layouts/footer.php'); ?>
