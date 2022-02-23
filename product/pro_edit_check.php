<?php

session_start();
session_regenerate_id(true);

$title = '商品内容変更チェック';
include('../layouts/header.php');
?>

<div class="container">
    <main>
    <?php if (!isset($_SESSION['login'])): ?>
        <div class="error">ログインしていません。</div><br>
        <a href="staff_login.php">ログイン画面へ</a>
        <?php exit(); ?>
    <?php else: ?>
        <?php echo $_SESSION['name'] . 'さんログイン中' . PHP_EOL; ?>
        <br><br>
    <?php endif; ?>

    <?php

    require_once('../common/common.php');

    $post = sanitize($_POST);
    $code = $post['code'];
    $name = $post['name'];
    $price = $post['price'];
    $img = $_FILES['img'];
    $old_img = $post['old_img'];
    $comments = $post['comments'];
    $cate = $post['cate'];

    ?>

    <h3>商品コード</h3><br>
    <div>【<?php echo $code; ?>】の情報を修正します。</div>
    <br>
    <div>【カテゴリー】<?php echo $cate; ?></div>
    <br>

    <?php if (empty($name) === true): ?>
        <div class="error">【商品名】商品名が入力されていません。</div>
    <?php else: ?>
            <div>【商品名】<?php echo $name; ?></div>
    <?php endif; ?>
    <br>

    <?php if (preg_match('/\A[0-9]+\z/', $price) === 0): ?>
        <div class="error">【価格】正しい値を入力してください</div>
    <?php else: ?>
        <div>【価格】<?php echo $price; ?>円</div>
    <?php endif; ?>
    <br>

    <div>【画像】</div>
    <?php if ($img['size'] > 0): ?>
        <?php if ($img['size'] > 1000000): ?>
            <div class="error">【画像】ファイルのサイズが大きすぎます。</div>
        <?php else: ?>
            <?php move_uploaded_file($img['tmp_name'], './img/' .$img['name']); ?>
            <div><img src="./img/<?php echo $img['name']; ?>"></div>
        <?php endif ?>
    <?php endif ?>

    <?php if ($img['name'] === ''): ?>
        <div><img src="./img/<?php echo $old_img; ?>"></div>
    <?php endif; ?>
    <br>

    <div>【詳細】</div>
    <?php if (empty($comments) === true): ?>
        <div class="error">詳細が入力されていません</div>
    <?php endif; ?>

    <?php if (mb_strlen($comments) > 100): ?>
        <div class="error">文字数は100文字が上限です</div>
    <?php else: ?>
        <div><?php echo $comments; ?></div>
    <?php endif; ?>
    <br><br>

    <?php if (empty($name) or preg_match('/\A[0-9]+\z/', $price) === 0 or $img['size'] > 1000000 or empty($comments) === true or mb_strlen($comments) > 100): ?>
        <form>
            <input class="back_btn" type="button" onclick="history.back()" value="戻る">
        </form>
    <?php else: ?>
        <div>上記商品を修正しますか？</div><br>
            <form action="pro_edit_done.php" method="post">
            <input type="hidden" name="cate" value="'<?php echo $cate; ?>">
            <input type="hidden" name="code" value="<?php echo $code; ?>">
            <input type="hidden" name="name" value="<?php echo $name; ?>">
            <input type="hidden" name="price" value="<?php echo $price; ?>">
            <input type="hidden" name="img" value="<?php echo $img['name']; ?>">
            <input type="hidden" name="old_img" value="<?php echo $old_img; ?>">
            <input type="hidden" name="explanation" value="<?php echo $comments; ?>">
            <input class="back_btn" type="button" onclick="history.back()" value="戻る">
            <input class="btn" type="submit" value="OK">
        </form>
    <?php endif; ?>
    </main>
</div>

<?php include('../layouts/footer.php'); ?>
