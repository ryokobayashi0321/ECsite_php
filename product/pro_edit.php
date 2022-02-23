<?php

session_start();
session_regenerate_id(true);

$title = '商品編集画面';
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

        if (empty($rec['img']) === true) {
            $show_img = '';
        } else {
            $show_img = '<img src="./img/'.$rec['img'].'">';
        }

    } catch (Exception $e) {
        echo '只今障害が発生しております。' . PHP_EOL;
        echo '<a href ="../staff_login/staff_login.php">ログイン画面へ</a>';
    }
    ?>
        <h3>商品コード</h3><br>
        <div>【<?php echo $rec['code']; ?>】の情報を修正します。</div>
        <br>
        <form action="pro_edit_check.php" method="post" enctype="multipart/form-data">
            <div>【カテゴリー】</div>
            <?php require_once('../common/common.php'); ?>
            <?php echo pulldown_cate(); ?>
            <br><br>
            <div>【商品名】</div>
            <input type="text" name="name" value="<?php echo $rec['name']; ?>">
            <br><br>
            <div>【価格】</div>
            <input type="text" name="price" value="<?php echo $rec['price']; ?>">
            <br><br>
            <div>【画像】</div>
            <?php echo $show_img; ?>
            <br>
            <input type="file" name="img">
            <br><br>
            <div>【詳細】</div>
            <textarea name="comments" class="textarea"><?php echo $rec['explanation']; ?></textarea>
            <br><br>
            <input type="hidden" name="code" value="<?php echo $rec['code']; ?>">
            <input type="hidden" name="old_img" value="<?php echo $rec['img']; ?>">
            <input class="back_btn" type="button" onclick="history.back()" value="戻る">
            <input class="btn" type="submit" value="OK">
        </form>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
