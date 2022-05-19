<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');

// 外部ファイルのインクルード
require("./fileManager.php");

// 書き込み文字列
$write_data = array($_POST["userName"], $_POST["pw"]);

// ユーザ情報管理フォルダの作成
mkdir($USER_MANAGE_DIR, 0777);

// ユーザ管理情報ファイル名
$fileName = $USER_MANAGE_DIR."/userManage.csv";

// 読みだしたユーザ管理情報を格納する配列
$userArray = array();

// ユーザ管理情報オープン(読み取り専用)
if ($file = fopen($fileName, "r")){
  while ($readDataArray = fgetcsv($file)) {
    if ($readDataArray[0] != $_POST["userName"]){
      array_push($userArray, $readDataArray);
    }
  }
  // ファイルクローズ
  fclose($file);
}

// ファイル削除
unlink($fileName);

// ユーザ管理情報オープン(新規作成)
$file = fopen($fileName, "w");
if (count($userArray) == 0){
  fputcsv($file, $write_data);
}
else{
  for ($index = 0; $index < count($userArray);$index++){
    fputcsv($file, $userArray[$index]);
  }
  fputcsv($file, $write_data);
}

// ファイルクローズ
fclose($file);

$output = [
  "userName" => $_POST["userName"],
  "pw" => $_POST["pw"],
  "result" => "NORMAL_END"
];

echo json_encode($output);
?>