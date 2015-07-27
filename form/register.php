<?php
// セッションの開始
session_start();
// デバッグ
//echo "<pre>セッショントークン：" . $_SESSION['token'] . "</pre>";
//echo "<pre>ポストされたトークン：" . $_POST['token'] . "</pre>";
//exit;
// （クロスサイトリクエストフォージェリ対策）
if ($_SESSION['token'] != $_POST['token'] || !isset($_POST['token']) || !isset($_SESSION['token'])) {
    // CSRFなのでエラー画面へ
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: form.php");
} else {
// セッションデータを取得
$fullname = htmlspecialchars( $_SESSION[ 'fullname' ], ENT_QUOTES );
$fullnamekana = htmlspecialchars( $_SESSION[ 'fullnamekana' ], ENT_QUOTES );
$email = htmlspecialchars( $_SESSION[ 'email' ], ENT_QUOTES );
$tel = htmlspecialchars( $_SESSION[ 'tel' ], ENT_QUOTES );
// デバッグ
echo "<pre>名前：" . $fullname . "</pre>";
echo "<pre>かな：" . $fullnamekana . "</pre>";
echo "<pre>メールアドレス：" . $email . "</pre>";
echo "<pre>電話番号：" . $tel . "</pre>";
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
// SQL発行（プリペアドステートメント）
$stmt = $mysqli->prepare(
    "INSERT INTO entry ( 
        `fullname`,
        `fullnamekana`,
        `tel`,
        `email`
    ) VALUES(
        ?,
        ?,
        ?,
        ?
    );"
);
// プリペアドステートメントに値をセット
$stmt->bind_param('ssss', $fullname, $fullnamekana, $tel, $email);
// SQL実行
if ( !$stmt->execute() ) {
    // SQL実行エラー時
    echo "<pre>実行結果：";
    var_dump($stmt);
    echo "</pre>";
    die('execute() failed: ' . htmlspecialchars($stmt->error));
}
$stmt->close();
echo "DB保存完了!";
}
session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>入力フォーム</title>
<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <h2 class="text-center">送信完了</h2>
        </div>
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    送信完了しました。ありがとうございました。
                    <a class="btn btn-primary btn-block" href="./form.php">TOPに戻る</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
