<?php
 
session_start();
//session_regenerate_id(true);
//if(isset($_SESSION["login"]) === false) {
//    print "ログインしていません。<br><br>";
//    print "<a href='staff_login.html'>ログイン画面へ</a>";
//    exit();
//} else {
//    print $_SESSION["name"]."さんログイン中";
//    print "<br><br>";
//}
?>
 
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>スタッフ追加実効</title>
<!-- <link rel="stylesheet" href="../style.css"> -->
</head>
    
<body>
    
<?php
    try{
    
//入力された情報をpostで取得（クロスサイトスクリプティング防止）
$name = htmlspecialchars($_POST["name"], ENT_QUOTES, "UTF-8");
$pass = htmlspecialchars($_POST["pass"], ENT_QUOTES, "UTF-8");
 
$dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
$user = "root";
$password = "password";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
//スタッフをレーコードに追加（nameとpassword, codeは自動でincrement）
$sql = "INSERT INTO staff(name, password) VALUES(?,?)";
$stmt = $dbh -> prepare($sql);
$data[] = $name;
$data[] = $pass;
$stmt -> execute($data);
    
$dbh = null;
        
}catch(Exception $e) {
    echo "(´･ω･`)人(`･ω･´)ﾄﾞﾝﾏｲ!!: " . $e->getMessage() . "\n";
    print "<a href='../boozer_login/boozer_login.html'>ログイン画面へ</a>";
}
?>
    
boozerスタッフを追加しました。<br><br>
<a href="boozer_staff_list.php">boozerスタッフ一覧へ</a>
 
</body>
</html>