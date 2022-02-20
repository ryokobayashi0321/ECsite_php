<?php

$title = 'スタッフ編集画面';
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
        スタッフコード<br>
        <?php echo $rec['code']; ?>の情報を修正します。
        <br><br>
        <form action="staff_edit_check.php" method="post">
            スタッフ名<br>
            <input type="text" name="name" value="<?php echo $rec['name']; ?>">
            <br><br>
            パスワード<br>
            <input type="password" name="pass">
            <br><br>
            パスワード再入力<br>
            <input type="password" name="pass2">
            <br><br>
            <input type="hidden" name="code" value="<?php echo $rec['code']; ?>">
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value="OK">
        </form>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
