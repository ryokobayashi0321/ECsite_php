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
    <title>カート情報</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php

if (empty($_SESSION['cart']) === true) {
    echo 'カートに商品はありません<br><br>';
    echo '<a href="shop_list.php">商品一覧へ戻る</a>';
}

try {
    $cart = $_SESSION['cart'];
    $num = $_SESSION['num'];
    $max = count($cart);

    require_once('../common/common.php');
    $dbh = dbConnect();

    foreach ($cart as $key => $value) {
        $sql = 'SELECT * FROM mst_product WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[0] = $value;
        $stmt->execute($data);

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        $name[] = $rec['name'];
        $price[] = $rec['price'];
        $img[] = $rec['img'];
    }
    $dbh = null;

} catch (Exception $e) {
    echo '只今障害が発生しております。' . PHP_EOL;
    echo '<a href ="../staff_login/staff_login.html">ログイン画面へ</a>';
}
?>
    <form action="shop_num.php" method="post">
        カート一覧<br><br>
        <?php

        for ($i = 0; $i < $max; $i++) {
            if (empty($img[$i]) === true) {
                $show_img = '';
            } else {
                $show_img = '<img src="../product/img/'.$img[$i].'">';
            }
            echo $show_img . '<br>';
            echo '商品名:' . $name[$i] . '<br>';
            echo '価格:' . $price[$i] . '円<br>';
            echo '数量: <input type="text" name="num'.$i.'" value="'.$num[$i].'"><br>';
            echo '合計価格:' . $price[$i] * $num[$i] . '円<br>';
            echo '削除: <input type="checkbox" name="delete'.$i.'"><br>';
            echo '<br><br>';
        }
        ?>
        <input type="hidden" name="max" value="<?php echo $max; ?>">
        <input type="submit" value="数量変更/削除">
        <br><br>
        <a href="shop_form_check.php">ご購入手続きへ進む</a><br>
    </form>
</body>
</html>
