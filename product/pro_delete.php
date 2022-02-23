<?php

session_start();
session_regenerate_id(true);

$title = '商品削除';
include('../layouts/header.php');
?>

<div class="container">
    <main>
    <?php if (!isset($_SESSION['login'])): ?>
        <div class="error">ログインしていません。</div><br>
        <a href="staff_login.php">ログイン画面へ</a>
        <?php exit(); ?>
    <?php else: ?>
        <?php echo $_SESSION['name'] . 'さんログイン中' . PHP_EOL; ?>
        <br><br>
    <?php endif; ?>

    <?php

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
        $img = $rec['img'];

        if (empty($img) === true) {
            $show_img = '';
        } else {
            $show_img = '<img src="./img/'.$img.'">';
        }

    } catch (Exception $e) {
        echo '只今障害が発生しております。' . PHP_EOL;
        echo '<a href ="../staff_login/staff_login.php">ログイン画面へ</a>';
    }
    ?>

        <h3>商品詳細</h3>
        <br>
        <div>【商品コード】<?php echo $rec['code']; ?></div>
        <br>
        <div>【カテゴリー】<?php echo $rec['category']; ?></div>
        <br>
        <div>【商品名】<?php echo $rec['name']; ?></div>
        <br>
        <div>【価格】<?php echo $rec['price']; ?>円</div>
        <br>
        <div>【画像】</div>
        <?php echo $show_img; ?>
        <br><br>
        <div>【詳細】<?php echo $rec['explanation']; ?></div>
        <br><br>
        <p>上記情報を削除しますか？</p>
        <form action="pro_delete_done.php" method="post">
            <input type="hidden" name="code" value="<?php echo $rec['code']; ?>">
            <input type="hidden" name="img" value="<?php echo $img; ?>">
            <input class="back_btn" type="button" onclick="history.back()" value="戻る">
            <input class="btn" type="submit" value="OK">
        </form>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
