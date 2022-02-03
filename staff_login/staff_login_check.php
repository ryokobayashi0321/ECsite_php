<?php

try {
    require_once('../common/common.php');

    $post = sanitize($_POST);
    $code = $post['code'];
    $pass = $post['pass'];

    $pass = md5($pass);

    $dbh = dbConnect();
    $sql = 'SELECT name FROM mst_staff WHERE code=? AND password=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $code;
    $data[] = $pass;
    $stmt->execute($data);

    $dbh = null;

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($rec['name']) === true) {
        print '入力が間違っています' . PHP_EOL;
        print "<a href='staff_login.html'>戻る</a>";
        exit();
    } else {
        session_start();
        $_SESSION['login'] = 1;
        $_SESSION['name'] = $rec['name'];
        $_SESSION['code'] = $code;
        header('Location:staff_login_top.php');
        exit();
    }

} catch (Exception $e) {
    print '只今障害が発生しております。' . PHP_EOL;
    print "<a href='staff_login.html'>戻る</a>";
}
