<?php
 
session_start();
// session_regenerate_id(true);
 
// if(isset($_SESSION["member_login"]) === false) {
//     print "ログインしてく下さい。<br><br>";
//     print "<a href='../member_login/member_login.html'>ログイン画面へ<br><br></a>";
//     print "<a href='shop_list.php'>TOP画面へ</a>";
// }
//     if(isset($_SESSION["member_login"]) === true) {
//     print "ようこそ";
//     print $_SESSION["member_name"];
//     print "様　";
//     print "<a href='../member_login/member_logout.php'>ログアウト</a>";
//     print "<br><br>";
//     }
 
?>
 
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>エージェント購入チェック</title>
<link rel="stylesheet" href="../style.css">
</head>
<body>
 
<?php
    try {
$cart = $_SESSION["cart"];
$quantity = $_SESSION["quantity"];
$max = count($cart);

echo $max;

var_dump($max);
var_dump($quantity);
        
$dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
$user = "root";
$password = "password";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
print "<h1>【申請エージェント】<br></h1>";
for($i = 0; $i < $max; $i++) {
  $sql = "SELECT agent_id, catchphrase, feature, region_code, prefecture_code, online_meeting, membership, pros, cons FROM agent WHERE agent_id=?";
  $stmt = $dbh -> prepare($sql);
  $data = array();
  $data[] = $cart[$i];
  $stmt -> execute($data);
    
$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
    
// if(empty($rec["image"]) === true) {
// $disp_image = "";
// } else {
// $disp_image = "<img src='../product/image/".$rec['image']."'>";
// }
// print "<div class='box'>";
// print "<div class='list'>";
// print "<div class='img'>";
// print $disp_image;
// print "</div>";
// print "<div class='npe'>";
print "エージェント名:".$rec['catchphrase']."<br>";
// print "価格:".$rec['price']."円　<br>";
// print "数量:".$quantity[$i]."<br>";
// print "合計価格:".$rec['price'] * $quantity[$i]."円<br><br>";
// $goukei[] = $rec['price'] * $quantity[$i];
// print "</div></div></div><br>";
}
$dbh = null; 
// print "【ご請求金額】---".array_sum($goukei)."円<br>いらないですねこれ<br><br>";

print "<form action='shop_form_done.php' method='post'>";
// print "<input type='hidden' name='name' value='".$name."'>";
// print "<input type='hidden' name='email' value='".$email."'>";
// print "<input type='hidden' name='address' value='".$address."'>";
// print "<input type='hidden' name='tel' value='".$tel."'>";
print "<input type='button' onclick='history.back()' value='戻る'>";
print "<input type='submit' value='個人情報入力にすすめ'>";
print "</form>";
}
 
catch(Exception $e) {
    print "只今障害が発生しております。<br><br>";
    print "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
}
?>
    
</body>
</html>