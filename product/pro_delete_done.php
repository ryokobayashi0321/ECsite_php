<?php

session_start();
session_regenerate_id(true);

$title = '商品削除実行';
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
        require_once('../common/common.php');

        $post = sanitize($_POST);
        $code = $post['code'];
        $img = $post['img'];

        if (empty($img) === false) {
            unlink('./img/' . $img);
        }

        $dbh = dbConnect();
        $sql = 'DELETE FROM mst_product WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $code;
        $stmt->execute($data);

        $dbh = null;

    } catch (Exception $e) {
        echo '只今障害が発生しております。' . PHP_EOL;
        echo '<a href ="../staff_login/staff_login.php">ログイン画面へ</a>';
    }
    ?>

        <div class="text">商品を削除しました。</div><br>
        <a class="back_btn" href="pro_list.php">商品一覧へ</a>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
