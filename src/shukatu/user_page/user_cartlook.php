<?php
//だからログインはせんって

session_start();
// session_regenerate_id(true);
 
// if(isset($_SESSION["member_login"]) === false) {
//     print "ログインしてください。<br><br>";
//     print "<a href='../member_login/member_login.html'>ログイン画面へ</a>";
//     exit();
// } else {
//     print "ようこそ";
//     print $_SESSION["member_name"];
//     print "様　";
//     print "<a href='../member_login/member_logout.php'>ログアウト</a>";
//     print "<br><br>";
// }
 
?>
 
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>お気に入り情報</title>
<link rel="stylesheet" href="../style.css">
</head>
    
<body>
    
<?php

if(empty($_SESSION["cart"]) === true) {

    print "お気に入りにエージェントはありません。<br><br>";
    // var_dump($_SESSION["cart"]);
    print "<a href='shop_list.php'>エージェント一覧へ戻る</a>";
    exit();
}
 
try{
$cart = $_SESSION["cart"];
$quantity = $_SESSION["quantity"];
$max = count($cart);
    
$dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
$user = "root";
$password = "password";
$dbh_2 = new PDO($dsn, $user, $password);
$dbh_2 -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
foreach($cart as $key => $val) {

$sql_2 = "SELECT agent_id, catchphrase, feature, region_code, prefecture_code, online_meeting, membership, pros, cons FROM agent WHERE agent_id=?";
$stmt_2 = $dbh_2 -> prepare($sql_2);
$data[0] = $val;
$stmt_2 -> execute($data);
    
$rec_2 = $stmt_2 -> fetch(PDO::FETCH_ASSOC);
    
$agent_id[] =$rec_2["agent_id"];
// $catchphrase[] = $rec_2["catchphrase"];
// $feature[] = $rec_2["feature"];
// $region_code[] = $rec_2["region_code"];
// $prefecture_code[] = $rec_2["prefecture_code"];
// $online_meeting[] = $rec_2["online_meeting"];
// $membership[] = $rec_2["membership"];
// $pros[] = $rec_2["pros"];
// $cons[] = $rec_2["cons"];

}
$dbh_2 = null;
}
catch(Exception $e) {
    print "只今障害が発生しております。<br><br>";
    print "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
}
?>
    
<form action="agent_quantity.php" method="post">
お気に入り一覧<br><br>
<?php for($i = 1; $i < $max; $i++) {;?>

エージェントcode:<?php print $agent_id[$i];?><br>

削除:<input type="checkbox" name="delete<?php print $i;?>"><br>
<br>
 
<?php };?>
 
<br><br>
<input type="hidden" name="max" value="<?php print $max;?>">
<input type="submit" value="数量変更/削除">
<br><br>
<input type="button" onclick="history.back()" value="戻る">
</form>
<br>
<a href="shop_form_check.php">個人情報入力に進む</a><br>
<br><br>
 
</body>
</html>