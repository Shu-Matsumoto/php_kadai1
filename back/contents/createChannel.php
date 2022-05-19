<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');

// 外部ファイルのインクルード
require("./fileManager.php");

// チャンネルフォルダの作成
mkdir($CHANNELS_DIR, 0777);

// ファイルオープン
$file = fopen($CHANNELS_DIR."/".$_POST["channelName"].".csv", "a");
// ファイルクローズ
fclose($file);

$output = [
  "channelName" => $_POST["channelName"],
  "result" => "NORMAL_END"
];

echo json_encode($output);
?>