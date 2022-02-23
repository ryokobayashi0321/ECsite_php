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

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        $dbh = null;

    } catch (Exception $e) {
        echo '只今障害が発生しております。' . PHP_EOL;
        echo '<a href="staff_login.php">戻る</a>';
    }
    ?>

        <?php if (empty($rec['name']) === true): ?>
            <div class="error">入力が間違っています</div><br>
            <a href="staff_login.php">戻る</a>
            <?php exit(); ?>
        <?php else: ?>
            <?php

            session_start();
            $_SESSION['login'] = 1;
            $_SESSION['name'] = $rec['name'];
            $_SESSION['code'] = $code;
            header('Location:staff_login_top.php');
            exit();
            ?>
        <?php endif;?>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
