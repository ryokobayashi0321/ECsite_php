<?php

session_start();
session_regenerate_id(true);

$title = 'スタッフ詳細';
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
        <h3>スタッフ詳細</h3>
        <br>
        <div>スタッフコード：</div>
        <?php echo $rec['code']; ?>
        <br><br>
        <div>スタッフ名：</div>
        <?php echo $rec['name']; ?>
        <br><br>
        <form>
            <input class="back_btn" type="button" onclick="history.back()" value="戻る">
        </form>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
