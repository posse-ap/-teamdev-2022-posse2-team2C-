<?php
//あるようでないログインチェック 
session_start();
session_regenerate_id(true);
 
if(isset($_SESSION["member_login"]) === true) {
print "ようこそ";
    print $_SESSION["member_name"];
    print "様 ";
    print "<a href='../member_login/member_logout.php'>ログアウト</a>";
    print "<br><br>";
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>エージェント選択画面</title>
<link rel="stylesheet" href="./momo.css">
</head>
<body>
<?php include "../common/common_header.html" ?>
<?php
try{
//選択したエージェントだけ表示
//shop_list.phpでのっけたurlをgetでとってくる
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
VAR_DUMP($rec); 
}
catch(Exception $e) {
    print "只今障害が発生しております。<br><br>";
    print "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
}
?>
<a href="user_cartin.php?code=<?php print $agent_id;?>">お気に入り一覧に入れる</a>




エージェント名:<?php print $rec['agent_id'];?>





<form>
<input type="button" onclick="history.back()" value="一覧に戻る">
</form>
 
<!-- <h3>カテゴリー</h3> -->
<!-- <a href="shop_list_eart.php">食品</a><br>
<a href="shop_list_kaden.php">家電</a><br>
<a href="shop_list_book.php">書籍</a><br>
<a href="shop_list_niti.php">日用品</a><br>
<a href="shop_list_sonota.php">その他</a><br> -->
 
</body>
</html>