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
    <title>商品修正実行</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<?php

try {
    require_once('../common/common.php');

    $post = sanitize($_POST);
    $code = $post['code'];
    $name = $post['name'];
    $price = $post['price'];
    $img = $post['img'];
    $old_img = $post['old_img'];
    $comments = $post['explanation'];
    $cate = $post['cate'];

    if (empty($img) && isset($old_img) === true) {
        $img = $old_img;
    }

    if ($old_img !== '') {
        if ($img !== $old_img) {
            unlink('./img/' . $old_img);
        }
    }

    $dbh = dbConnect();
    $sql = 'UPDATE mst_product SET category=?, name=?, price=?, img=?, explanation=? WHERE code=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $cate;
    $data[] = $name;
    $data[] = $price;
    $data[] = $img;
    $data[] = $comments;
    $data[] = $code;
    $stmt->execute($data);

    $dbh = null;

} catch (Exception $e) {
    echo '只今障害が発生しております。' . PHP_EOL;
    echo '<a href ="../staff_login/staff_login.php">ログイン画面へ</a>';
}
?>
    商品を修正しました。<br><br>
    <a href="pro_list.php">商品一覧へ</a>
</body>
</html>
