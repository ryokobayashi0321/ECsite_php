<?php

$title = 'スタッフ削除実行';
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
        $code = $post['code'];

        $dbh = dbConnect();
        $sql = 'DELETE FROM mst_staff WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $code;
        $stmt->execute($data);

        $dbh = null;

    } catch (Exception $th) {
        echo '只今障害が発生しております。' . PHP_EOL;
        echo '<a href="../staff_login/staff_login.php">ログイン画面へ</a>';
    }
    ?>
        削除が完了しました。<br><br>
        <a href="staff_list.php">スタッフ一覧へ</a>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
