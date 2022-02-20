<?php

$title = '新規登録チェック';
include('../layouts/header.php');
?>

<div class="container">
    <main>
    <?php

    require_once('../common/common.php');

    $post = sanitize($_POST);
    $name = $post['name'];
    $email = $post['email'];
    $address = $post['address'];
    $tel = $post['tel'];
    $pass = $post['pass'];
    $pass2 = $post['pass2'];
    $okFlag = true;

    if (empty($name) === true) {
        echo 'お名前を入力してください<br><br>';
        $okFlag = false;
    }

    if (empty($email) === true) {
        echo 'emailを入力してください<br><br>';
        $okFlag = false;
    }

    if (preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/', $email) === 0) {
        echo '正しいemailを入力してください<br><br>';
        $okFlag = false;
    }

    if (empty($address) === true) {
        echo '住所を入力してください<br><br>';
        $okFlag = false;
    }

    if (empty($tel) === true) {
        echo '電話番号を入力してください<br><br>';
        $okFlag = false;
    }

    if (preg_match('/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/', $tel) === 0) {
        echo '正しい電話番号を入力してください<br><br>';
        $okFlag = false;
    }

    if (empty($pass) === true) {
        echo 'パスワードを入力してください<br><br>';
        $okFlag = false;
    }

    if ($pass !== $pass2) {
        echo 'パスワードが異なります<br><br>';
        $okFlag = false;
    }

    if ($okFlag === false) {
        echo '<form><br>';
        echo '<input type="button" onclick="history.back()" value="戻る">';
    } else {
        echo '下記内容で登録しますか?<br><br>';
        echo $name . '<br><br>';
        echo $email . '<br><br>';
        echo $address . '<br><br>';
        echo $tel . '<br><br>';
        echo '<form action="member_register_done.php" method="post">';
        echo '<input type="hidden" name="name" value="'.$name.'">';
        echo '<input type="hidden" name="email" value="'.$email.'">';
        echo '<input type="hidden" name="address" value="'.$address.'">';
        echo '<input type="hidden" name="tel" value="'.$tel.'">';
        echo '<input type="hidden" name="pass" value="'.$pass.'">';
        echo '<input type="button" onclick="history.back()" value="戻る">';
        echo '<input type="submit" value="登録">';
    }
    ?>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
