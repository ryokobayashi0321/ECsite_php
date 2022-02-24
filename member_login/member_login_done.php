<?php

$title = 'ログイン実行';
include('../layouts/header.php');
?>

<div class="container">
    <main>
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
            echo '<p class="error text">ログイン情報が間違っています。</p><br>';
            echo '<a class="back_btn" href="member_login.php">戻る</a>';
            exit();
        }

        session_start();
        $_SESSION['member_login'] = 1;
        $_SESSION['member_name'] = $rec['name'];
        $_SESSION['member_code'] = $rec['code'];
        echo '<p class="text">ログイン成功</p><br>';
        echo '<a class="back_btn" href="../shop/shop_list.php">トップへ</a>';

    } catch (Exception $e) {
        echo '只今障害が発生しております。' . PHP_EOL;
        echo '<a class="back_btn" href ="member_login.php">ログイン画面へ</a>';
    }
    ?>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
