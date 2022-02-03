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
    <title>スタッフ編集画面</title>
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
    echo '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
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
</body>
</html>