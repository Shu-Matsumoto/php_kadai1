<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');

// 外部ファイルのインクルード
require("./fileManager.php");

$fileName = $_POST["channelName"] . ".csv";
$write_data = array($_POST["time"], $_POST["user"], $_POST["contents"]);
//$write_data = $_POST["time"].",".$_POST["user"].",".$_POST["contents"];

// ファイルオープン
$file = fopen($CHANNELS_DIR."/".$fileName, "a");

// ファイルロック・・・ファイル排他制御
flock($file, LOCK_EX);

// ファイルへデータ書込
fputcsv($file, $write_data);
//$writeResult = fwrite($file, $write_data);

// ファイルロック解除
flock($file, LOCK_UN);

// ファイルクローズ
fclose($file);

$output = [
  "channelName" => $_POST["channelName"],
  "time" => $_POST["time"],
  "user" => $_POST["user"],
  "contents" => $_POST["contents"],
  "result" => $writeResult
];

echo json_encode($output);
?>