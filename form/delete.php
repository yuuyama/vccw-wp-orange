<?php
// 設定ファイルをインクルード
require_once("./setting.php");
// パラメータ取得
$id = htmlspecialchars($_GET["id"]);
// SQLエスケープ
$id = mysqli_real_escape_string($mysqli,$id);
$sql = "DELETE FROM entry WHERE id = $id;";
if (!$mysqli->query($sql)) {
    // SQL失敗時
    $output_data = array(
        "status" => "error",
        "id" => $id,
        "message" => $mysqli->error,
    );
} else {
    // SQL成功時
    $output_data = array(
        "status" => "ok",
        "id" => $id
    );
}
// JSON出力
echo json_encode($output_data);
?>