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
<title>スタッフ削除実効</title>
<link rel="stylesheet" href="../style.css">
</head>
<body>

<?php
    try{
    
    $code = htmlspecialchars($_POST["code"], ENT_QUOTES, "UTF-8");
    // $name = htmlspecialchars($_POST["name"], ENT_QUOTES, "UTF-8");
    // $pass = htmlspecialchars($_POST["pass"], ENT_QUOTES, "UTF-8");
    // $pass2 = htmlspecialchars($_POST["pass2"], ENT_QUOTES, "UTF-8");
 
$dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
$user = "root";
$password = "password";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//スタッフコードを$data に渡してそのスタッフを削除
$sql = "DELETE FROM staff WHERE code=?";
$stmt = $dbh -> prepare($sql);
$data[] = $code;
$stmt -> execute($data);
    
$dbh = null;
        
}
catch(Exception $e) {
    echo "（ ´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
    print "<a href='./staff_login/staff_login.html'>ログイン画面へ</a>";
}
?>
    
削除完了しました。<br><br>
<a href="boozer_staff_list.php">スタッフ一覧へ</a>
 
</body>
</html>
