<?php
// 設定ファイルをインクルード
require_once("./setting.php");
// DBから取得するデータを格納する配列初期化
$entries = array();
if ($result = $mysqli->query("SELECT * FROM entry")) {
    // デバッグ
    // echo "<pre>";
    // var_dump($result);
    // echo "</pre>";

    // 結果の解放
    $result->close();
} else {
    echo "<pre>";
    printf("SQL実行エラー: %s\n", $mysqli->error);
    echo "</pre>";
}

if ($result = $mysqli->query("SELECT * FROM entry")) {
    // echo "<pre>";
    // var_dump($result);
    // echo "</pre>";
    // ▼▼ 追加 ▼▼
    // 取得したデータを配列に格納
    while( $row = $result->fetch_assoc()){
        $entries[] = $row;
    }
    // ▲▲ 追加 ▲▲
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
<title>フォーム送信情報一覧</title>
<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <h2 class="text-center">フォーム送信情報一覧</h2>
        <div class="col-md-offset-2 col-md-8">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>名前</th>
                    <th>カナ</th>
                    <th>メールアドレス</th>
                    <th>電話番号</th>
                    <th>編集</th>
        			<th>削除</th>
                </tr>
                <?php if(count($entries) > 0): ?>
                    <?php foreach ($entries as $data): ?>
                    <tr id="entry-<?php echo $data['id']; ?>">
                        <td><?php echo $data['id']; ?></td>
                        <td><?php echo $data['fullname']; ?></td>
                        <td><?php echo $data['fullnamekana']; ?></td>
                        <td><?php echo $data['email']; ?></td>
                        <td><?php echo $data['tel']; ?></td>
                        <td><a class="btn btn-primary" href="./edit.php?id=<?php echo $data['id']; ?>">編集</a></td>
                        <td><a class="btn btn-warning" onclick="deleteEntry(<?php echo $data['id']; ?>)">削除</a></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">データはありません。</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div><!-- / col-md-8 -->
    </div><!-- / row -->
</div><!-- / container -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
// AJAXで削除処理
function deleteEntry(id){
    if(window.confirm("削除します。いいですか？")){
        $.ajax({
            type: 'GET',
            url: './delete.php',
            data: { "id" : id },
            dataType: 'json',
            timeout : 3000,
            success: function(data){
                console.log(data);
                $("#entry-" + id).fadeOut();
            },
            error: function(error){
                alert("削除に失敗しました。");
                console.log(error);
            }
        });
    }
}
</script>
</body>
</html>
