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
    <title>スタッフ追加実行</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php

try {
    require_once('../common/common.php');

    $post = sanitize($_POST);
    $name = $post['name'];
    $pass = $post['pass'];

    $dbh = dbConnect();
    $sql = 'INSERT INTO mst_staff(name, password) VALUES(?,?)';
    $stmt = $dbh->prepare($sql);
    $data[] = $name;
    $data[] = $pass;
    $stmt->execute($data);

    $dbh = null;

} catch(Exception $e) {
    echo '只今障害が発生しております。' . PHP_EOL;
    echo '<a href ="../staff_login/staff_login.php">ログイン画面へ</a>';
}
?>

スタッフを追加しました。<br><br>
<a href="staff_list.php">スタッフ一覧へ</a>

</body>
</html>
