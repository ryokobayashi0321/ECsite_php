<?php

session_start();
session_regenerate_id(true);

$title = '商品購入決定画面';
include('../layouts/header.php');
?>

<div class="container">
    <main>
    <?php if (!isset($_SESSION['member_login'])): ?>
        <div class="error text">ログインしてください</div><br><br>
        <a class="btn" href="../member_login/member_login.php">ログイン画面へ</a>
        <a class="back_btn" href="shop_list.php">TOP画面へ</a>
        <?php exit(); ?>
    <?php elseif (isset($_SESSION['member_login'])): ?>
        <?php echo 'ようこそ、' . $_SESSION['member_name'] . '様' . PHP_EOL; ?>
        <a href="../member_login/member_logout.php">ログアウト</a>
        <br><br>
    <?php endif; ?>

    <?php

    try {
        require_once('../common/common.php');

        $post = sanitize($_POST);
        $memberName = $post['name'];
        $email = $post['email'];
        $address = $post['address'];
        $tel = $post['tel'];
        $cart = $_SESSION['cart'];
        $num = $_SESSION['num'];
        $max = count($cart);

        echo $memberName . '様<br>';
        echo 'ご注文ありがとうございました。<br>';
        echo $email . 'にメールを送りましたのでご確認ください 。<br>';
        echo '商品は入金を確認次第、下記の住所に発送させていただきます。<br>';
        echo $address . '<br>';
        echo $tel . '<br>';

        $content = '';
        $content .= <<< EOT
        {$memberName} 様\n\nこの度はご注文ありがとうございました。\n
        \n
        ご注文の商品\n
        ---------------\n
    EOT;

        $dbh =dbConnect();

        for ($i = 0; $i < $max; $i++) {
            $sql = 'SELECT * FROM mst_product WHERE code=?';
            $stmt = $dbh->prepare($sql);
            $data[0] = $cart[$i];
            $stmt->execute($data);

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);

            $proName = $rec['name'];
            $price = $rec['price'];
            $total[] = $price;
            $proNum = $num[$i];
            $subtotal = $price * $proNum;

            $content .= <<<EOT
            {$proName}: {$price}円 × {$proNum}個 = {$subtotal}円\n
    EOT;
        }

        $sql = 'LOCK TABLES data_sales_product WRITE';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        for ($i = 0; $i < $max; $i++) {
            $sql = 'INSERT INTO data_sales_product(sales_member_code, code_product, price, quantity, time) VALUES(?,?,?,?,now())';
            $stmt = $dbh->prepare($sql);
            $data = array();
            $data[] = $_SESSION['member_code'];
            $data[] = $cart[$i];
            $data[] = $total[$i];
            $data[] = $num[$i];
            $stmt->execute($data);
        }

        $sql = 'UNLOCK TABLES';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        $dbh = null;

        $content .=<<<EOT
        \n送料は無料です。\n
        --------------\n
        \n
        代金は以下の口座にお振り込みください。\n
        A銀行 B支店  普通口座: 1234567\n
        入金が確認取れ次第、商品を発送させていただきます。\n
        \n
        ◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆\n
        ～KRショップ～\n
        \n
        東京都六本木ヒルズ最上階\n
        電話: 090-0000-0000\n
        メール: test@test.com\n
        ◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆\n
    EOT;
        echo '<br>';
        echo nl2br($content);

        $title = 'ご注文ありがとうございました。';
        $header = 'From:test@test.com';
        $content = html_entity_decode($content, ENT_QUOTES, 'UTF-8');
        mb_language('Japanese');
        mb_internal_encoding('UTF-8');
        mb_send_mail($email, $title, $content, $header);

        $title = 'お客様よりご注文が入りました。';
        $header = 'From' . $email;
        $content = html_entity_decode($content, ENT_QUOTES, 'UTF-8');
        mb_language('Japanese');
        mb_internal_encoding('UTF-8');
        mb_send_mail('test@test.com', $title, $content, $header);

    } catch (Exception $e) {
        echo '只今障害により大変ご迷惑をおかけしております。';
        exit();
    }
    ?>
        <br>
        <?php $_SESSION['cart'] = array(); ?>
        <?php $_SESSION['num'] = array(); ?>
        <p class="top_btn"><a class="back_btn" href="shop_list.php">トップへ戻る</a></p>
    </main>
    <?php include('../layouts/aside.php'); ?>
</div>

<?php include('../layouts/footer.php'); ?>
