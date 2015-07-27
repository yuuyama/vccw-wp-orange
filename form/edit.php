<?php
// 設定ファイルをインクルード
require_once("./setting.php");
// actionパラメータ取得
$action = htmlspecialchars($_POST["action"]);
if($action == "edit"){
    // POSTデータ取得
    $id = htmlspecialchars($_POST["id"]);
    $fullname = htmlspecialchars($_POST["fullname"]);
    $fullnamekana = htmlspecialchars($_POST["fullnamekana"]);
    $email = htmlspecialchars($_POST["email"]);
    $tel = htmlspecialchars($_POST["tel"]);
    // SQLエスケープ
    $id = mysqli_real_escape_string($mysqli,$id);
    $fullname = mysqli_real_escape_string($mysqli,$fullname);
    $fullnamekana = mysqli_real_escape_string($mysqli,$fullnamekana);
    $email = mysqli_real_escape_string($mysqli,$email);
    $tel = mysqli_real_escape_string($mysqli,$tel);
    // SQL文
    $sql = "UPDATE 
                entry 
            SET 
                fullname = '$fullname',
                fullnamekana = '$fullnamekana',
                email = '$email',
                tel = '$tel'
            WHERE
                id = $id";
    echo "<pre>実行結果：";
    var_dump($sql);
    echo "</pre>";
    // DBからデータ取得
    if (!$mysqli->query($sql)) {
        echo "<pre>";
        printf("SQL実行エラー: %s\n", $mysqli->error);
        echo "</pre>";
        exit;
    }
    // 一覧画面遷移
    header('Location: ./list.php');
    exit;
}
// パラメータ取得
$id = htmlspecialchars($_GET["id"]);
// デバッグ
// echo "ID:" . $id;

// SQLエスケープ
$id = mysqli_real_escape_string($mysqli,$id);
// DBからデータ取得
if ($result = $mysqli->query("SELECT * FROM entry WHERE `id` = $id")) {
    $data = mysqli_fetch_assoc($result);
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    // 結果の解放
    $result->close();
} else {
    echo "<pre>";
    printf("SQL実行エラー: %s\n", $mysqli->error);
    echo "</pre>";
}


?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>フォーム編集</title>
<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <h2 class="text-center">フォーム編集</h2>
        <div class="col-md-offset-2 col-md-8">
            <form id="profileForm" class="form-horizontal" action="./edit.php" method="post">
                <!-- name -->
                <div class="form-group">
                    <label class="col-xs-3 control-label">名前</label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" name="fullname" value="<?php echo $data['fullname'] ?>" />
                    </div>                 
                </div><!-- /name -->
                
                <div class="form-group">
                    <label class="col-xs-3 control-label">カナ</label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" name="fullnamekana" value="<?php echo $data['fullnamekana'] ?>" />
                    </div>
                </div>

                <!-- tel -->
                <div class="form-group">
                    <label class="col-xs-3 control-label">電話番号</label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" name="tel" value="<?php echo $data['tel'] ?>" />
                    </div>
                </div><!-- /tel -->
                
                <!-- mail -->
                <div class="form-group">
                    <label class="col-xs-3 control-label">メールアドレス</label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" name="email" value="<?php echo $data['email'] ?>" />
                    </div>
                </div><!-- /mail -->
                
                <!-- submit -->
                <div class="form-group">
                    <div class="col-xs-6 col-xs-offset-3">
                        <button type="submit" class="btn btn-primary btn-block">変更</button>
                    </div>
                </div><!-- /submit -->
                <input type="hidden" name="action" value="edit">
    			<input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            </form><!-- /form -->
        </div>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
