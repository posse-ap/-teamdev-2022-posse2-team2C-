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
<link rel="stylesheet" href="./momo.css">
</head>
    
<body>
<?php include "../common/common_header.html" ?> 
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
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
foreach($cart as $key => $val) {

$sql = "SELECT agent_id, catchphrase, feature, region_code, prefecture_code, online_meeting, membership, pros, cons FROM agent WHERE agent_id=?";
$stmt = $dbh -> prepare($sql);
$data[0] = $val;
$stmt -> execute($data);
    
$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
    
$agent_id[] = $rec["agent_id"];
}
$dbh = null;
}
catch(Exception $e) {
    print "只今障害が発生しております。<br><br>";
    print "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
}
?>
    
<form action="shop_quantity.php" method="post">
お気に入り一覧<br><br>
<?php for($i = 0; $i < $max; $i++) {;?>
<?php if(empty($image[$i]) === true) {;?>
<?php $disp_image = "";?>
<?php } else {;?>
<?php $disp_image = "<img src='../product/image/".$image[$i]."'>";?>
<?php };?>
<?php print $disp_image;?>
エージェント名:<?php print $name[$i];?><br>
価格:<?php print $price[$i]."円　";?><br>
数量:<input type="text" name="quantity<?php print $i;?>" value="<?php print $quantity[$i];?>"><br>
合計価格:<?php print $price[$i] * $quantity[$i]."円";?><br>
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