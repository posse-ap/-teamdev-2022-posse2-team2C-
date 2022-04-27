<?php
//ログインチェック
session_start();
session_regenerate_id(true);
if(isset($_SESSION["login"]) === false) {
    print "ログインしていません。<br><br>";
    print "<a href='boozer_login.php'>ログイン画面へ</a>";
    exit();
} else {
    print $_SESSION["name"]."さんログイン中";
    print "<br><br>";
}
?>
 
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>エージェント削除実効</title>
<link rel="stylesheet" href="../style.css">
</head>
    
<body>

<?php
    try{
    
require_once("../common/common.php");
//いつものやつ   
$post = sanitize($_POST);
$agent_id = $post["agent_id"];

$dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
$user = "root";
$password = "password";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//codeで識別したやつをdelete
$sql = "DELETE FROM agent WHERE agent_id=?";
$stmt = $dbh -> prepare($sql);
$data[] = $agent_id;
$stmt -> execute($data);
    
$dbh = null;

$dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
$user = "root";
$password = "password";
$dbh_2 = new PDO($dsn, $user, $password);
$dbh_2 -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//codeで識別したやつをdelete
$sql_2 = "DELETE FROM agent_account WHERE agent_id=?";
$stmt_2 = $dbh_2 -> prepare($sql_2);
$data_2[] = $agent_id;
$stmt_2 -> execute($data_2);
    
$dbh_2 = null;
}
catch(Exception $e) {
    echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
    print "<a href='../boozer_login/boozer_login.php'>ログイン画面へ</a>";
}
?>
<br>
エージェントを削除しました。<br><br>
<a href="agent_list.php">エージェント一覧へ</a>
 
</body>
</html>
