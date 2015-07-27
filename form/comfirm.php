<?php
//セッション開始
session_start();
// トークン生成（クロスサイトリクエストフォージェリ対策）
$_SESSION['token'] = session_id();
//デバッグ
echo "<pre>セッション:";
var_dump($_SESSION);
echo "</pre>";
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>フォーム確認</title>
<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>フォーム確認</h1>
        </div>
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 control-label">名前</label>
                            <div class="col-md-3 col-sm-3">
                                <p class="form-control-static"><?php echo $_SESSION[ 'fullname' ]; ?></p>
                            </div>
                            <label class="col-md-2 col-sm-2 control-label">カナ</label>
                            <div class="col-md-4 col-sm-4">
                                <p class="form-control-static"><?php echo $_SESSION[ 'fullnamekana' ]; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 control-label">メールアドレス</label>
                            <div class="col-md-3 col-sm-3">
                                <p class="form-control-static"><?php echo $_SESSION[ 'email' ]; ?></p>
                            </div>
                            <label class="col-md-2 col-sm-2 control-label">電話番号</label>
                            <div class="col-md-4 col-sm-4">
                                <p class="form-control-static"><?php echo $_SESSION[ 'tel' ]; ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- submit -->
                    <?php if (count($error_list) > 0): ?>
                        <div class="form-group">
                            <div class="col-xs-6 col-xs-offset-3">
                                <a href="./form.php"><button class="btn btn-primary btn-block">戻る</button></a>
                            </div>
                        </div><!-- /back -->
                    <?php else: ?>
                        <form id="profileForm" class="form-horizontal" action="./register.php" method="post">
                            <div class="form-group">
                                <div class="col-xs-6 col-xs-offset-3">
                                    <button type="submit" class="btn btn-primary btn-block">送信</button>
                                	<input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['token'], ENT_QUOTES, "UTF-8") ?>">
                                </div>
                            </div><!-- /submit -->
                        </form><!-- /form -->
                    <?php endif ?>
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