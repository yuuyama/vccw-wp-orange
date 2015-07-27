<?php
// DB接続
$mysqli = new mysqli(
    'localhost',
    'wordpress',
    'wordpress',
    'wordpress'
);
// DB接続エラー時
if ($mysqli->connect_error){
    print("接続失敗：" . $mysqli->connect_error);
    exit();
}
// 文字コードセット
if (!$mysqli->set_charset("utf8")) {
    printf("文字コードセット失敗: %s\n", $mysqli->error);
    exit();
}
?>