<?php

session_start();
session_regenerate_id(true);

if (isset($_SESSION['member_login']) === false) {
    echo 'ログインしてください<br><br>';
    echo '<a href="../member_login/member_login.html">ログイン画面へ</a>';
    echo '<br><br>';
    echo '<a href="shop_list.php">TOP画面へ</a>';
    exit();
} else if  (isset($_SESSION['member_login']) === true) {
    echo 'ようこそ' . PHP_EOL;
    echo $_SESSION['member_name'];
    echo '様' . PHP_EOL;
    echo '<a href="../member_login/member_logout.php">ログアウト</a>';
    echo '<br><br>';
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品購入チェック</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php

try {
    $member_code = $_SESSION['member_code'];
    $cart = $_SESSION['cart'];
    $num = $_SESSION['num'];
    $max = count($num);

    require_once('../common/common.php');
    $dbh = dbConnect();
    $sql = 'SELECT * FROM member WHERE code=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $member_code;
    $stmt->execute($data);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    echo '下記の内容でよろしいでしょうか？<br><br>';
    echo '【宛先】<br>';
    echo 'お名前: ' . $rec['name'] . '様<br>';
    echo 'email: ' . $rec['email'] . '<br>';
    echo 'ご住所: ' . $rec['address'] . '<br>';
    echo 'ご連絡先: ' . $rec['tel'] . '<br><br>';
    $name = $rec['name'];
    $email = $rec['email'];
    $address = $rec['address'];
    $tel = $rec['tel'];

    echo '【ご注文内容】<br>';
    for ($i = 0; $i < $max; $i++) {
        $sql = 'SELECT * FROM mst_product WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data = array();
        $data[] = $cart[$i];
        $stmt->execute($data);

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($rec['img']) === true) {
            $show_img = '';
        } else {
            $show_img = '<img src="../product/img/'.$rec['img'].'">';
        }

        echo '<div class="box">';
        echo '<div class="list">';
        echo '<div class="img">' . $show_img . '</div>';
        echo '<div class="npe">';
        echo '商品名: ' . $rec['name'] . '<br>';
        echo '価格: ' . $rec['price'] . '円<br>';
        echo '数量: ' . $num[$i] . '<br>';
        echo '合計価格: ' . $rec['price'] * $num[$i] . '円<br><br>';
        $total[] = $rec['price'] * $num[$i];
        echo '</div></div></div><br>';
    }
    $dbh = null;

    echo '【ご請求額】--- ' . array_sum($total) . '円<br><br>';
    echo '<form action="shop_form_done.php" method="post">';
    echo '<input type="hidden" name="name" value="'.$name.'">';
    echo '<input type="hidden" name="email" value="'.$email.'">';
    echo '<input type="hidden" name="address" value="'.$address.'">';
    echo '<input type="hidden" name="tel" value="'.$tel.'">';
    echo '<input type="button" onclick="history.back()" value="戻る">';
    echo '<input type="submit" value="OK">';
    echo '</form>';

} catch (Exception $e) {
    print "只今障害が発生しております。<br><br>";
    print "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
}
?>
</body>
</html>
