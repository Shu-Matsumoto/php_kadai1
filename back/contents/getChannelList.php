<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');

// 外部ファイルのインクルード
require("./fileManager.php");

$list = glob($CHANNELS_DIR."/*.csv");

for($index = 0; $index < count($list); $index++){
   $list[$index] = str_replace($CHANNELS_DIR."/", "", $list[$index]);
   $list[$index] = str_replace(".csv", "", $list[$index]);
}

$output = [
  "channelList" => $list,
  "result" => "NORMAL_END"
];

echo json_encode($output);
?>