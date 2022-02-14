<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン実行</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php

try {
    require_once('../common/common.php');

    $post = sanitize($_POST);
    $email = $post['email'];
    $pass = $post['pass'];
    $pass = md5($pass);

    $dbh = dbConnect();
    $sql ='SELECT * FROM member WHERE email=? AND password=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $email;
    $data[] = $pass;
    $stmt->execute($data);

    $dbh = null;

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($rec['name']) === true) {
        echo 'ログイン情報が間違っています。<br>';
        echo '<a href="member_login.html">戻る</a>';
        exit();
    }

    session_start();
    $_SESSION['member_login'] = 1;
    $_SESSION['member_name'] = $rec['name'];
    $_SESSION['member_code'] = $rec['code'];
    echo 'ログイン成功<br><br>';
    echo '<a href="../shop/shop_list.php">トップへ戻る</a>';

} catch (Exception $e) {
    echo '只今障害が発生しております。' . PHP_EOL;
    echo '<a href ="member_login.html">ログイン画面へ</a>';
}
?>
</body>
</html>
