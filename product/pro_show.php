<?php

$title = '商品詳細';
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
        $sql = 'SELECT * FROM mst_product WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $code;
        $stmt->execute($data);

        $dbh = null;

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
        echo '只今障害が発生しております。' . PHP_EOL;
        echo '<a href ="../staff_login/staff_login.php">ログイン画面へ</a>';
    }
    ?>
        商品詳細<br><br>
        商品コード<br>
        <?php echo $rec['code']; ?>
        <br><br>
        カテゴリー<br>
        <?php echo $rec['category']; ?>
        <br><br>
        商品名<br>
        <?php echo $rec['name']; ?>
        <br><br>
        画像<br>
        <?php if (empty($rec['img']) === true) {
            $show_img = '';
        } else {
            $show_img = '<img src="./img/'.$rec['img'].'">';
        }; ?>
        <?php echo $show_img; ?>
        <br><br>
        詳細<br>
        <?php echo $rec['explanation']; ?>
        <br><br>
        <form>
            <input type="button" onclick="history.back()" value="戻る">
        </form>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
