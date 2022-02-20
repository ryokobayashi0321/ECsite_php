<?php

$title = 'ログインチェック';
include('../layouts/header.php');
?>

<div class="container">
    <main>
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
            echo '入力が間違っています' . PHP_EOL;
            echo '<a href="staff_login.php">戻る</a>';
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
        echo '只今障害が発生しております。' . PHP_EOL;
        echo '<a href="staff_login.php">戻る</a>';
    }
    ?>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
