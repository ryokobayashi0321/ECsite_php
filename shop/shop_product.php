<?php

session_start();
session_regenerate_id(true);

if (isset($_SESSION['member_login']) === true) {
    echo 'ようこそ';
    echo $_SESSION['member_name'];
    echo '様';
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
    <title>商品選択画面</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php

try {
    $code = $_GET['code'];

    require_once('../common/common.php');
    $dbh = dbConnect();
    $sql = 'SELECT * FROM mst_product WHERE code=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $code;
    $stmt->execute($data);

    $dbh = null;

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($rec['img']) === true) {
        $show_img = '';
    } else {
        $show_img = '<img src="../product/img/'.$rec['img'].'">';
    }
} catch (Exception $e) {
    echo '只今障害が発生しております。' . PHP_EOL;
    echo '<a href ="../member_login/member_register.php">ログイン画面へ</a>';
}
?>

    <a href="shop_in_cart.php?code=<?php echo $code; ?>">カートに入れる</a>
    <br><br>
    <?php echo $show_img; ?>
    <br>
    商品名:<?php echo $rec['name']; ?>
    <br>
    価格:<?php echo $rec['price']; ?>円
    <br>
    詳細:<?php echo $rec['explanation']; ?>
    <br><br>
    <form>
        <input type="button" onclick="history.back()" value="戻る">
    </form>

    <h3>カテゴリー</h3>
    <a href="shop_list_eat.php">食品</a>
    <a href="shop_list_kaden.php">家電</a>
    <a href="shop_list_book.php">書籍</a>
    <a href="shop_list_niti.php">日用品</a>
    <a href="shop_list_sonota.php">その他</a>
</body>
</html>
