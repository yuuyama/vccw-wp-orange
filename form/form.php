<?php
// 入力データを取得
$action = htmlspecialchars( $_POST[ 'action' ], ENT_QUOTES );
$fullname = htmlspecialchars( $_POST[ 'fullname' ], ENT_QUOTES );
$fullnamekana = htmlspecialchars( $_POST[ 'fullnamekana' ], ENT_QUOTES );
$email = htmlspecialchars( $_POST[ 'email' ], ENT_QUOTES );
$tel = htmlspecialchars( $_POST[ 'tel' ], ENT_QUOTES );
// デバッグ
echo "<pre>アクション：" . $action . "</pre>";
echo "<pre>名前：" . $fullname . "</pre>";
echo "<pre>かな：" . $fullnamekana . "</pre>";
echo "<pre>メールアドレス：" . $email . "</pre>";
echo "<pre>電話番号：" . $tel . "</pre>";
if($action == "send"){
    // バリデート
    $error_list = array();
    // 名前バリデート
    $patarn = "/^[a-zA-Zぁ-んァ-ン一-龥々0-9０-９ー　 〒-]+$/";
    if (isset($fullname) && trim($fullname) == "") {
        $error_list[] = "名前を入力してください。";
    } elseif (!preg_match($patarn,$fullname)){
        $error_list[] = "名前は全角ひらがな、全角カタカナ、漢字で入力してください。";
    } elseif (mb_strlen($fullname) < 4 && mb_strlen($fullname) < 20 ) {
        $error_list[] = "名前は4文字以上20文字以内で入力してください。";
    }
    // かなバリデート
    $patarn = "/^[ァ-ヾ]+$/u";
    if (isset($fullnamekana) && trim($fullnamekana) == "") {
        $error_list[] = "カナを入力してください。";
    } elseif (!preg_match($patarn,$fullnamekana)){
        $error_list[] = "カナは全角カタカナで入力してください。";
    } elseif (mb_strlen($fullnamekana) < 4 && mb_strlen($fullnamekana) < 20 ) {
        $error_list[] = "カナは4文字以上20文字以内で入力してください。";
    }
    // メールアドレスチェック
    $patarn = "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/";
    if (isset($email) && trim($email) == "") {
        $error_list[] = "メールアドレスを入力してください。";
    }elseif (strlen($email) != mb_strlen($email)){
        $error_list[] = "メールアドレスは半角英数字で入力してください。";
    }elseif (!preg_match($patarn,$email)){
        $error_list[] = "メールアドレスの正しい書式ではありません。";
    }
    // 電話番号チェック
    $patarn = "/^0\d{1,5}-?\d{0,4}-?\d{4}$/";
    if (isset($tel) && trim($tel) == "") {
        $error_list[] = "電話番号を入力してください。";
    } elseif (strlen($tel) != mb_strlen($tel)){
        $error_list[] = "電話番号は半角英数字で入力してください。";
    } elseif (!preg_match($patarn,$tel)){
        $error_list[] = "電話番号の正しい書式ではありません。";
    }
    echo "<pre>バリデーションエラー：";
    var_dump($error_list);
    echo "</pre>";
}
// バリデーション問題なしの場合
if( count($error_list) == 0 ){
    // セッションの開始
    session_start();
    // 入力データをセッションに保存
    $_SESSION[ 'fullname' ] = $fullname;
    $_SESSION[ 'fullnamekana' ] = $fullnamekana;
    $_SESSION[ 'email' ] = $email;
    $_SESSION[ 'tel' ] = $tel;
    // 確認画面に移動
    header('Location: ./confirm.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>送信フォーム</title>
<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>


<div class="container">
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <h2 class="text-center">送信フォーム</h2>
        </div>
        <?php if(isset($error_list)): ?>
        <div class="col-md-offset-2 col-md-8">
            <div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              <span class="sr-only">入力エラー</span>
              入力エラー
              <ul>
                <?php foreach($error_list as $error) : ?>
                <li><?php echo $error; ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
        </div>
        <?php endif; ?>
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                <!-- form -->
                <form id="profileForm" class="form-horizontal" action="./form.php" method="post">
                    <!-- name -->
                    <div class="form-group">
                        <label class="col-xs-3 control-label">名前</label>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" name="fullname" value="<?php echo $fullname; ?>" placeholder="山田太郎" />
                        </div>
                        <div class="col-xs-5">
                            <input type="text" class="form-control" name="fullnamekana" value="<?php echo $fullnamekana; ?>" placeholder="ヤマダタロウ" />
                        </div>
                    </div><!-- /name -->
                    
                    <!-- tel -->
                    <div class="form-group">
                        <label class="col-xs-3 control-label">電話番号</label>
                        <div class="col-xs-9">
                            <input type="text" class="form-control" name="tel" value="<?php echo $tel; ?>" placeholder="0311112222" />
                        </div>
                    </div><!-- /tel -->
                    
                    <!-- mail -->
                    <div class="form-group">
                        <label class="col-xs-3 control-label">メールアドレス</label>
                        <div class="col-xs-9">
                            <input type="text" class="form-control" name="mail" value="<?php echo $email; ?>" placeholder="taro@hoge.com" />
                        </div>
                    </div><!-- /mail -->
                    
                    <!-- submit -->
                    <div class="form-group">
                        <div class="col-xs-6 col-xs-offset-3">
                            <button type="submit" class="btn btn-primary btn-block">送信</button>
                            <input type="hidden" name="action" value="send">
                        </div>
                    </div><!-- /submit -->
                </form><!-- /form -->
                </div>
            </div>
        </div>
    </div>
</div><!-- / container -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>	
</div>

</body>
</html>