<?php

// 引数$before = $_POST
function sanitize($before)
{
    foreach ($before as $key => $value) {
        $after[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    return $after;
}

function dbConnect()
{
    $dsn = 'mysql:host=localhost;dbname=shop;charset=utf8';
    $user = 'root';
    $password = 'root';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbh;
}

function pulldown_cate()
{
    echo '<select name="cate">';
    echo '<option value="食品">食品</option>';
    echo '<option value="家電">家電</option>';
    echo '<option value="書籍">書籍</option>';
    echo '<option value="日用品">日用品</option>';
    echo '<option value="その他">その他</option>';
    echo '</select>';
}
