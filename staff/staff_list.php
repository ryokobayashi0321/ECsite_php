<?php

session_start();
session_regenerate_id(true);

$title = 'スタッフ一覧';
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

        $dbh = dbConnect();
        $sql = 'SELECT code, name FROM mst_staff WHERE 1';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        $dbh = null;

    } catch (Exception $e) {
        echo '只今障害が発生しております。' . PHP_EOL;
        echo '<a href="../staff_login/staff_login.php">ログイン画面へ</a>';
    }
    ?>
        <h3>スタッフ一覧</h3><br>
        <form action="staff_branch.php" method="post">
            <?php while (true): ?>
                <?php $rec = $stmt->fetch(PDO::FETCH_ASSOC); ?>
                <?php if ($rec === false): ?>
                    <?php break; ?>
                <?php endif; ?>
                    <input type="radio" name="code" value="<?php echo $rec['code']; ?>">
                    <?php echo $rec['name']; ?>
                <br>
            <?php endwhile; ?>
            <br>
            <input class="btn_slc" type="submit" name="show" value="詳細">
            <input class="btn_slc" type="submit" name="add" value="追加">
            <input class="btn_slc" type="submit" name="edit" value="編集">
            <input class="btn_slc" type="submit" name="delete" value="削除">
        </form>
        <br><br>
        <a href="../staff_login/staff_login_top.php">管理画面TOPへ</a>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
