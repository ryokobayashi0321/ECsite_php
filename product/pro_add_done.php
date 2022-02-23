<?php

session_start();
session_regenerate_id(true);

$title = '商品追加実行';
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
        $name = $post['name'];
        $price = $post['price'];
        $img = $post['img'];
        $comments = $post['comments'];
        $cate = $post['cate'];

        $dbh = dbConnect();
        $sql = 'INSERT INTO mst_product(category, name, price, img, explanation) VALUE(?,?,?,?,?)';
        $stmt = $dbh->prepare($sql);
        $data[] = $cate;
        $data[] = $name;
        $data[] = $price;
        $data[] = $img;
        $data[] = $comments;
        $stmt->execute($data);

        $dbh = null;

    } catch (Exception $e) {
        echo '只今障害が発生しております。' . PHP_EOL;
        echo '<a href ="../staff_login/staff_login.php">ログイン画面へ</a>';
        exit();
    }
    ?>
        <div class="text">商品を追加しました。</div><br>
        <a class="back_btn" href="pro_list.php">商品一覧へ</a>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
