<?php

session_start();
session_regenerate_id(true);

$title = 'スタッフ編集画面';
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
        <h3>スタッフコード</h3><br>
        <div><?php echo $rec['code']; ?>の情報を修正します。</div>
        <br>
        <form action="staff_edit_check.php" method="post">
            <div>スタッフ名</div>
            <input type="text" name="name" value="<?php echo $rec['name']; ?>">
            <br><br>
            <div>パスワード</div>
            <input type="password" name="pass">
            <br><br>
            <div>パスワード再入力</div>
            <input type="password" name="pass2">
            <br><br>
            <input type="hidden" name="code" value="<?php echo $rec['code']; ?>">
            <input class="back_btn" type="button" onclick="history.back()" value="戻る">
            <input class="btn" type="submit" value="OK">
        </form>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
