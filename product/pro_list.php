<?php

session_start();
session_regenerate_id(true);

$title = '商品一覧リスト';
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
        $sql = 'SELECT code, name, price FROM mst_product WHERE 1';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        $dbh = null;

    } catch (Exception $e) {
        echo '只今障害が発生しております。' . PHP_EOL;
        echo '<a href ="../staff_login/staff_login.php">ログイン画面へ</a>';
    }
    ?>

        <h3>商品一覧</h3><br>
        <form action="pro_branch.php" method="post">

        <?php while (true): ?>
            <?php $rec = $stmt->fetch(PDO::FETCH_ASSOC); ?>
            <?php if ($rec === false): ?>
                <?php break; ?>
            <?php endif; ?>
            <table>
                <tr>
                    <td><input type="radio" name="code" value="<?php echo $rec['code']; ?>"></td>
                    <td><?php echo $rec['name']; ?></td>
                    <td><?php echo $rec['price']; ?>円</td>
                </tr>
            </table>
        <?php endwhile; ?>
        <br>
        <input class="btn_slc" type="submit" name="show" value="詳細">
        <input class="btn_slc" type="submit" name="add" value="追加">
        <input class="btn_slc" type="submit" name="edit" value="修正">
        <input class="btn_slc" type="submit" name="delete" value="削除">
        <br><br>
        <a class="back_btn" href="../staff_login/staff_login_top.php">管理者画面TOPへ</a>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
