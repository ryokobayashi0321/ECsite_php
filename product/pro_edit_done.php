<?php

session_start();
session_regenerate_id(true);

$title = '商品修正実行';
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
        $name = $post['name'];
        $price = $post['price'];
        $img = $post['img'];
        $old_img = $post['old_img'];
        $comments = $post['explanation'];
        $cate = $post['cate'];

        if (empty($img) && isset($old_img) === true) {
            $img = $old_img;
        }

        if ($old_img !== '') {
            if ($img !== $old_img) {
                unlink('./img/' . $old_img);
            }
        }

        $dbh = dbConnect();
        $sql = 'UPDATE mst_product SET category=?, name=?, price=?, img=?, explanation=? WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $cate;
        $data[] = $name;
        $data[] = $price;
        $data[] = $img;
        $data[] = $comments;
        $data[] = $code;
        $stmt->execute($data);

        $dbh = null;

    } catch (Exception $e) {
        echo '只今障害が発生しております。' . PHP_EOL;
        echo '<a href ="../staff_login/staff_login.php">ログイン画面へ</a>';
    }
    ?>
        <div class="text">商品を修正しました。</div><br>
        <a class="back_btn" href="pro_list.php">商品一覧へ</a>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
