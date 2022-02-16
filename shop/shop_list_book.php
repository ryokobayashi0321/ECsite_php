<?php

session_start();
session_regenerate_id(true);

if (isset($_SESSION['member_login']) === true) {
    echo 'ようこそ';
    echo $_SESSION['member_name'] . '様' . PHP_EOL;
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
    <title>book</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php

try {
    require_once('../common/common.php');
    $dbh = dbConnect();
    $sql = 'SELECT * FROM mst_product WHERE category=?';
    $stmt = $dbh->prepare($sql);
    $data[] = '書籍';
    $stmt->execute($data);

    $dbh = null;

    echo '販売商品一覧' . PHP_EOL;
    echo '<a href="shop_look_cart.php">カートを見る</a>';
    echo '<br><br>';

    while (true) {
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($rec === false) {
            break;
        } else {
            $code = $rec['code'];
            echo '<a href="shop_product.php?code='.$code.'">';
        }

        if (empty($rec['img']) === true) {
            $img = '';
        } else {
            $img = '<img src="../product/img/'.$rec['img'].'">';
        }

        echo $img;
        echo '<br>';
        echo '商品名：' . $rec['name'];
        echo '<br>';
        echo '価格：' . $rec['price'] . '円';
        echo '<br>';
        echo '詳細：' . $rec['explanation'];
        echo '</a>';
        echo '<br><br>';
    }
    echo '<br>';

} catch (\Throwable $th) {
    echo "只今障害が発生しております。<br><br>";
    echo "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
}
?>
    <a href="shop_list.php">トップへ戻る</a>
    <br><br><br>

    <h3>カテゴリー</h3>
    <ul>
        <li><a href="shop_list_eat.php">食品</a></li>
        <li><a href="shop_list_kaden.php">家電</a></li>
        <li><a href="shop_list_book.php">書籍</a></li>
        <li><a href="shop_list_niti.php">日用品</a></li>
        <li><a href="shop_list_sonota.php">その他</a></li>
    </ul>
</body>
</html>
