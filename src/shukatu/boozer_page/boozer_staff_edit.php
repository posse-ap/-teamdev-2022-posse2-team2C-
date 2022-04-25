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
<title>スタッフ修正画面</title>
<link rel="stylesheet" href="style.css">
</head>
    
<body>
<?php
try{
//staff_branch.php からget送信されたstaff codeを受ける   
$code = $_GET["code"];
    
$dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
$user = "root";
$password = "password";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

$sql = "SELECT code,name FROM staff WHERE code=?";
$stmt = $dbh -> prepare($sql);
//getで送信したstaff codeで識別
$data[] = $code;
$stmt -> execute($data);
    
$dbh = null;
    
$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
    
}
catch(Exception $e) {
    echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
    print "<a href='./boozer_login/boozer_login.html'>ログイン画面へ</a>";
}
?>

スタッフコード<br>
<?php print $rec["code"];?>
の情報を修正します。
<br><br>
<form action="boozer_staff_edit_check.php" method="post">
スタッフ名<br>
<input type="text" name="name" value="<?php print $rec['name'];?>">
<br><br>
パスワード<br>
<input type="password" name="pass">
<br><br>
パスワード再入力<br>
<input type="password" name="pass2">
<br><br>
<input type="hidden" name="code" value="<?php print $rec['code'];?>">
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>
</body>
</html>