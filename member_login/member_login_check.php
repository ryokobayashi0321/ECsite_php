<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインチェック</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php

require_once('../common/common.php');

$post = sanitize($_POST);
$email = $post['email'];
$pass = $post['pass'];
$pass2 = $post['pass2'];
$okFlag = true;

if (empty($email) === true) {
    echo 'emailを入力してください<br>';
    $okFlag = false;
}

if (preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/', $email) === 0) {
    echo '正しいemailを入力してください<br>';
    $okFlag = false;
}

if (empty($pass) === true) {
    echo 'パスワードを入力してください<br>';
    $okFlag = false;
}

if ($pass !== $pass2) {
    echo 'パスワードが異なります<br>';
    $okFlag = false;
}

if ($okFlag === false) {
    echo '<form><br>';
    echo '<input type="button" onclick="history.back()" value="戻る">';
} else {
    echo '下記emailアドレスでログインしますか?<br><br>';
    echo $email . '<br><br>';
    echo '<form action="member_login_done.php" method="post">';
    echo '<input type="hidden" name="email" value="'. $email .'">';
    echo '<input type="hidden" name="pass" value="'. $pass .'">';
    echo '<input type="button" onclick="history.back()" value="戻る">';
    echo '<input type="submit" value="ログイン">';
}
?>
</body>
</html>
