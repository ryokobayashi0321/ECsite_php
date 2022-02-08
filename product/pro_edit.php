<?php

session_start();
session_regenerate_id(true);
if (isset($_SESSION['login']) === false) {
    echo 'ログインしていません。' . PHP_EOL;
    echo '<a href="staff_login.html">ログイン画面へ</a>';
    exit();
} else {
    echo $_SESSION['name'] . 'さんログイン中' . PHP_EOL;
    echo '<br><br>';
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品編集画面</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<?php

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

    if (empty($rec['img']) === true) {
        $show_img = '';
    } else {
        $show_img = '<img src="./img/'.$rec['img'].'">';
    }

} catch (\Throwable $th) {
    echo '只今障害が発生しております。' . PHP_EOL;
    echo '<a href ="../staff_login/staff_login.html">ログイン画面へ</a>';
}
?>
    商品コード<br>
    <?php echo $rec['code']; ?>
    の情報を修正します。
    <br><br>
    <form action="pro_edit_check.php" method="post" enctype="multipart/form-data">
        カテゴリー<br>
        <?php require_once('../common/common.php'); ?>
        <?php echo pulldown_cate(); ?>
        <br><br>
        商品名<br>
        <input type="text" name="name" value="<?php echo $rec['name']; ?>">
        <br><br>
        価格<br>
        <input type="text" name="price" value="<?php echo $rec['price']; ?>">
        <br><br>
        画像<br>
        <?php echo $show_img; ?>
        <br>
        <input type="file" name="img">
        <br><br>
        詳細<br>
        <textarea name="comments" style="width: 500px; height: 100px;"><?php echo $rec['explanation']; ?></textarea>
        <br><br>
        <input type="hidden" name="code" value="<?php echo $rec['code']; ?>">
        <input type="hidden" name="old_img" value="<?php echo $rec['img']; ?>">
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
    </form>
</body>
</html>
