<?php

$title = 'スタッフ削除確認画面';
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
        $code = $_GET['code'];

        require_once('../common/common.php');
        $dbh = dbConnect();
        $sql = 'SELECT code, name FROM mst_staff WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $code;
        $stmt->execute($data);

        $dbh = null;

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
        echo '只今障害が発生しております。' . PHP_EOL;
        echo '<a href="../staff_login/staff_login.php">ログイン画面へ</a>';
    }
    ?>
        スタッフ詳細<br><br>
        スタッフコード<br>
        <?php echo $rec['code']; ?>
        <br><br>
        スタッフネーム<br>
        <?php echo $rec['name']; ?>
        <br><br>
        上記情報を削除しますか？<br><br>
        <form action="staff_delete_done.php" method="post">
            <input type="hidden" name="code" value="<?php echo $rec['code'];?>">
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value="OK">
        </form>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
