<?php

require __DIR__. '/vendor/autoload.php';

//ダウンロードしたファイル
$keyFile = __DIR__. "/credentials.json";

// アカウント認証情報インスタンスを作成
$client = new Google_Client();
$client->setAuthConfig($keyFile);
//任意名
$client->setApplicationName("Sheet API TEST");
//サービスの権限スコープ
$scopes = [Google_Service_Sheets::SPREADSHEETS];
$client->setScopes($scopes);

//シート情報を操作するインスタンスを生成
$sheet = new Google_Service_Sheets($client);

//保存するデータ
$values = [
    ["Sheet API Append TEST", "登録できていますか？"]
];
//データ操作領域を設定
$body = new Google_Service_Sheets_ValueRange([
    'values' => $values,
]);
//追記
$response = $sheet->spreadsheets_values->append(
    "118306793762327420561", // 作成したスプレッドシートのIDを入力
    'student-info', //シート名
    $body, //データ
    ["valueInputOption" => 'USER_ENTERED']
);

//書き込んだ処理結果を確認
var_export($response->getUpdates());