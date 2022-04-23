<?php
//ログインチェック
session_start();
session_regenerate_id(true);
if(isset($_SESSION["login"]) === false) {
    print "ログインしていません。<br><br>";
    print "<a href='../boozer_login/boozer_login.html'>ログイン画面へ</a>";
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
<title>スタッフ詳細</title>
<link rel="stylesheet" href="../style.css">
</head>
    
<body>

<?php
    try{
//staff_branch.phpからurlに乗ってやってきたcodeをgetで取得    
$code = $_GET["code"];
 
$dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
$user = "root";
$password = "password";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//codeでスタッフ識別
$sql = "SELECT code, name FROM staff WHERE code=?";
$stmt = $dbh -> prepare($sql);
$data[] = $code;
$stmt -> execute($data);
    
$dbh = null;
        
$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
        
}
catch(Exception $e) {
    echo "(´･ω･`)人(`･ω･´)ﾄﾞﾝﾏｲ!!: " . $e->getMessage() . "\n";
    print "<a href='../boozer_login/boozer_login.html'>ログイン画面へ</a>";
}
?>
スタッフ詳細<br><br>
スタッフコード<br>
<?php
 print $rec["code"];
 ?>
<br><br>
スタッフネーム<br>
<?php 
print $rec["name"];
?>
<br><br>
<form>
<input type="button" onclick="history.back()" value="戻る">
</form>
 
</body>
</html>