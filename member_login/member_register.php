<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員情報入力画面</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    新規会員登録画面<br><br>

    <form action="member_register_check.php" method="post">
        お名前<br>
        <input type="text" name="name">
        <br>
        email<br>
        <input type="text" name="email">
        <br>
        住所<br>
        <input type="text" name="address">
        <br>
        TEL<br>
        <input type="text" name="tel">
        <br>
        パスワード<br>
        <input type="password" name="pass">
        <br>
        パスワード再入力<br>
        <input type="password" name="pass2">
        <br><br>
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
        <br><br>
    </form>
    <br><br>
</body>
</html>
