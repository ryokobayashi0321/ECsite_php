<?php

session_start();
session_regenerate_id(true);
if (isset($_SESSION['login']) === false) {
    print 'ログインしていません。' . PHP_EOL;
    print "<a href='staff_login.html'>ログイン画面へ</a>";
    exit();
} else {
    print $_SESSION['name'] . 'さんログイン中';
    print "<br><br>";
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>スタッフ一覧</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php

try {
    require_once('../common/common.php');

    $dbh = dbConnect();
    $sql = 'SELECT code, name FROM mst_staff WHERE 1';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;

    print 'スタッフ一覧<br><br>';
    print "<form action='staff_branch.php' method='post'>";

    while (true) {
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($rec === false) {
            break;
        }
        print "<input type='radio' name='code' value='".$rec['code']."'>";
        print $rec['name'];
        print "<br>";
    }
    print "<br>";
    print "<input type='submit' name='show' value='詳細'>";
    print "<input type='submit' name='add' value='追加'>";
    print "<input type='submit' name='edit' value='修正'>";
    print "<input type='submit' name='delete' value='削除'>";
} catch (Exception $e) {
    print '只今障害が発生しております。' . PHP_EOL;
    print "<a href='../staff_login.html'>ログイン画面へ</a>";
}
?>
<br><br>
<a href="../staff_login/staff_login_top.php">管理画面TOPへ</a>
</body>
</html>
