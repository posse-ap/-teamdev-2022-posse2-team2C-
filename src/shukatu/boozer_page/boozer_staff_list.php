<?php
//ログインしてるかチェック
session_start();
//session idはページ毎にランダム
session_regenerate_id(true);
if(isset($_SESSION["login"]) === false) {
    print "ログインしていません。<br><br>";
    print "<a href='../boozer_login/boozer_login.php'>ログイン画面へ</a>";
    exit();
} else {
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>スタッフ一覧</title>
<link rel="stylesheet" href="../style/reset.css">
    <link  rel="stylesheet" href="../style/craft.css?<?php echo date('Ymd-Hi');?>">
    <link  rel="stylesheet" href="../style/craft.css?<?php echo date('Ymd-Hi');?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
</head>
    
<body>


<?php
try{
//スタッフ一覧を表示させたいからdbにconnect
$dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
$user = "root";
$password = "password";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
// WHEARE1=true つまり全レコードを選択
$sql = "SELECT code,name FROM staff WHERE1";
$stmt = $dbh -> prepare($sql);
$stmt -> execute();
    
$dbh = null;
?>
    
<h1 class="text-center">スタッフ一覧</h1>
<form action='boozer_staff_branch.php' method='post'>
<?php
//trueの間は実行=永久ぐるぐる、レコードの情報を$recに格納
while(true) {
    $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
    //全レコード入れ終わったらループ抜ける
    if($rec === false) {
        break;
    }
    //staff codeをpost送信
    print "<input type='radio' name='code' value='".$rec['code']."'>";
    print $rec["name"];
    print "<br>";
}
print "<br>";
print "<input type='submit' name='disp' value='詳細'>";
print "<input type='submit' name='add' value='追加'>";
print "<input type='submit' name='edit' value='修正'>";
print "<input type='submit' name='delete' value='削除'>";
}
catch(Exception $e) {
    echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
    print "<a href='./boozer_login/boozer_login.php'>ログイン画面へ</a>";
}
?>
<br><br>
<a href="../boozer_login/../boozer_login/boozer_login_top.php">管理画面TOPへ</a>
</body>
</html>