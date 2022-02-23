<?php

session_start();
session_regenerate_id(true);

$title = 'スタッフ修正登録';
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
        $pass = $post['pass'];

        $dbh = dbConnect();
        $sql = 'UPDATE mst_staff SET name=?, password=? WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $name;
        $data[] = $pass;
        $data[] = $code;
        $stmt->execute($data);

        $dbh = null;
    } catch (Exception $e) {
        echo '只今障害が発生しております。' . PHP_EOL;
        echo '<a href ="../staff_login/staff_login.php">ログイン画面へ</a>';
    }
    ?>

        <div>修正完了しました。</div><br>
        <a href="staff_list.php">スタッフ一覧へ</a>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
