<?php

$title = '会員登録完了';
include('../layouts/header.php');
?>

<div class="container">
    <main>
    <?php

    try {
        require_once('../common/common.php');

        $post = sanitize($_POST);
        $name = $post['name'];
        $address = $post['address'];
        $tel = $post['tel'];
        $email = $post['email'];
        $pass = $post['pass'];

        $pass = md5($pass);

        $dbh =dbConnect();
        $sql = 'SELECT email FROM member WHERE 1';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        while (true) {
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if (empty($rec) === true) {
                break;
            }
            $mail[] = $rec['email'];
        }

        if (empty($mail) === true) {
            $mail[] = 'a';
        }

        if (in_array($email, $mail) === true) {
            echo '既に使われているmailアドレスです<br><br>';
            echo '<a href="member_register.php">トップへ戻る</a>';
            $dbh = null;
        } else {
            $sql = 'INSERT INTO member(name, email, address, tel, password) VALUE (?, ?, ?, ?, ?)';
            $stmt = $dbh->prepare($sql);
            $data[] = $name;
            $data[] = $email;
            $data[] = $address;
            $data[] = $tel;
            $data[] = $pass;
            $stmt->execute($data);

            $dbh = null;

            echo '登録完了しました。<br><br>';
            echo '<a href="../shop/shop_list.php">トップへ戻る</a>';
        }
    } catch (Exception $e) {
        echo '只今障害が発生しております。' . PHP_EOL;
        echo '<a href ="member_register.php">ログイン画面へ</a>';
        exit();
    }
    ?>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
