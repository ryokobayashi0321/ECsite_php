<?php

$title = 'スタッフ一覧';
include('../layouts/header.php');
?>

<div class="container">
    <main>
    <?php

    session_start();
    session_regenerate_id(true);
    if (isset($_SESSION['login']) === false) {
        echo 'ログインしていません。' . PHP_EOL;
        echo '<a href="staff_login.php">ログイン画面へ</a>';
        exit();
    } else {
        echo $_SESSION['name'] . 'さんログイン中';
        echo '<br><br>';
    }

    try {
        require_once('../common/common.php');

        $dbh = dbConnect();
        $sql = 'SELECT code, name FROM mst_staff WHERE 1';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        $dbh = null;

        echo 'スタッフ一覧<br><br>';
        echo '<form action="staff_branch.php" method="post">';

        while (true) {
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($rec === false) {
                break;
            }
            echo '<input type="radio" name="code" value="'.$rec['code'].'">';
            echo $rec['name'];
            echo '<br>';
        }
        echo '<br>';
        echo '<input type="submit" name="show" value="詳細">';
        echo '<input type="submit" name="add" value="追加">';
        echo '<input type="submit" name="edit" value="編集">';
        echo '<input type="submit" name="delete" value="削除">';
    } catch (Exception $e) {
        echo '只今障害が発生しております。' . PHP_EOL;
        echo '<a href="../staff_login/staff_login.php">ログイン画面へ</a>';
    }
    ?>
    <br><br>
    <a href="../staff_login/staff_login_top.php">管理画面TOPへ</a>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
