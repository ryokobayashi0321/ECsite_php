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
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>スタッフ削除確認画面</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
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
</body>
</html>
