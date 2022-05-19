<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');

// 外部ファイルのインクルード
require("./fileManager.php");

// 認証パス
$pass = false;

// ユーザ管理情報ファイル名
$fileName = $USER_MANAGE_DIR."/userManage.csv";

// ユーザ管理情報有無チェック
if (file_exists($fileName)){

  // ユーザ管理情報オープン
  $file = fopen($fileName, "r");

  // ユーザ管理情報から一致するユーザの情報を獲得
  while (($readDataArray = fgetcsv($file, 0, ",")) !== FALSE) {
    if (($readDataArray[0] === $_POST["userName"]) &&
    ($readDataArray[1] === $_POST["pw"])){
      $pass = true;
    }
  }

  // ファイルクローズ
  fclose($file);
}

$output = [
  "userName" => $_POST["userName"],
  "pw" => $_POST["pw"],
  "pass" => $pass,
  "result" => "NORMAL_END"
];

echo json_encode($output);
?>