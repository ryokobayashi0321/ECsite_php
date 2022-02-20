<?php

$title = '商品追加実行';
include('../layouts/header.php');
?>

<div class="container">
    <main>
    <?php

    session_start();
    session_regenerate_id(true);
    if (isset($_SESSION['login']) === false) {
        echo 'ログインしていません。' . PHP_EOL;
        echo '<a href="staff_login.php">ログイン画面へ</a>';
        exit();
    } else {
        echo $_SESSION['name'] . 'さんログイン中' . PHP_EOL;
        echo '<br><br>';
    }

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
        商品を追加しました。<br><br>
        <a href="product_list.php">商品一覧へ</a>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
