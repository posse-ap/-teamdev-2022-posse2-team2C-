<?php
//ログインチェック
session_start();
session_regenerate_id(true);
if(isset($_SESSION["login"]) === false) {
    print "ログインしていません。<br><br>";
    print "<a href='staff_login.html'>ログイン画面へ</a>";
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
<title>エージェント詳細</title>
<link rel="stylesheet" href="style.css">
</head>
    
<body>
    
<?php
    try{
//どこで乗せてきたurlだろ、branch.phpかな 
$agent_id = $_GET["agent_id"];
 
$dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
$user = "root";
$password = "password";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
$sql = "SELECT agent_id, catchphrase, feature, region_code, prefecture_code, online_meeting, membership, pros, cons FROM agent WHERE agent_id=?";
$stmt = $dbh -> prepare($sql);
$data[] = $agent_id;
$stmt -> execute($data);
    
$dbh = null;
        
$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
        
}
catch(Exception $e) {
    echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
    print "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
}
?>
    
エージェント詳細<br><br>
エージェントコード<br>
<?php print $rec["agent_id"];?>
<br><br>
カテゴリー<br>
<?php print $rec["catchphrase"];?>
<br><br>
エージェント名<br>
<?php print $rec["feature"];?>
<br><br>
<br><br>
詳細<br>
<?php print $rec["online_meeting"];?>
<br><br>    
<form>
<input type="button" onclick="history.back()" value="戻る">
</form>
 
</body>
</html>