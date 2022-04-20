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
<title>エージェント修正画面</title>
<link rel="stylesheet" href="../style.css">
</head>
    
<body>

<?php
try{
//pro_branch.phpでurlに乗せたやつを取ってくる 
$agent_id = $_GET["agent_id"];
    
$dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
$user = "root";
$password = "password";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//urlに乗ってきたcodeを元に識別
$sql = "SELECT agent_id, catchphrase, feature, region_code, prefecture_code, online_meeting, membership, pros, cons FROM agent WHERE agent_id=?";
$stmt = $dbh -> prepare($sql);
$data[] = $agent_id;
$stmt -> execute($data);
    
$dbh = null;
    
$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
    
// if(empty($rec["image"]) === true) {
//     $disp_image = "";
// } else {
//     $disp_image = "<img src='./image/".$rec['image']."'>";
// }
    
}
catch(Exception $e) {
    echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
    print "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
}
?>

エージェントコード<br>
<?php print $rec["agent_id"];?>
 の情報を修正します。
<br><br>
<form action="agent_edit_check.php" method="post" enctype="multipart/form-data">
カテゴリー<br>


<br><br>
エージェント名<br>
<input type="text" name="name" value="<?php print $rec['catchphrase'];?>">
<br><br>
価格<br>
<input type="text" name="price" value="<?php print $rec['feature'];?>">
<br><br>
画像<br>

<br>
<input type="file" name="image">
<br><br>
詳細<br>
<textarea name="comments" style="width: 500px; height: 100px;"><?php print $rec['pros'];?></textarea>
<br><br>
<input type="hidden" name="agent_id" value="<?php print $rec['agent_id'];?>">
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>
</body>
</html>