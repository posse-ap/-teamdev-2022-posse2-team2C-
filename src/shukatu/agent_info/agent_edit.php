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
//agent_branch.phpでurlに乗せたやつを取ってくる 
$agent_id = $_GET["agent_id"];
    
$dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
$user = "root";
$password = "password";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT agent_id, company_name, company_staff, account_email_address, account_password, google_account, post_period_start, post_period_end FROM agent_account WHERE agent_id=?";
$stmt = $dbh -> prepare($sql);
$data[] = $agent_id;
$stmt -> execute($data);
    
$dbh = null;
    
$rec = $stmt -> fetch(PDO::FETCH_ASSOC);

$dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
$user = "root";
$password = "password";
$dbh_2 = new PDO($dsn, $user, $password);
$dbh_2 -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//urlに乗ってきたcodeを元に識別
$sql_2 = "SELECT agent_id, catchphrase, feature, region_code, prefecture_code, online_meeting, membership, pros, cons FROM agent WHERE agent_id=?";
$stmt_2 = $dbh_2 -> prepare($sql_2);
$data_2[] = $agent_id;
$stmt_2 -> execute($data_2);
    
$dbh_2 = null;
    
$rec_2 = $stmt_2 -> fetch(PDO::FETCH_ASSOC);
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

アカウント情報の登録<br>
エージェントid<br>
<input type="text" name="agent_id" value="<?php print $rec['agent_id'];?>">
<br><br>
エージェント会社名<br>
<input type="text" name="company_name" value="<?php print $rec['company_name'];?>">
<br><br>
エージェント会社スタッフ名<br>
<input type="text" name="company_staff" value="<?php print $rec['company_staff'];?>">
<br><br>
アカウントのメールアドレス<br>
<input type="text" name="account_email_address" value="<?php print $rec['account_email_address'];?>">
<br><br>
アカウントのパスワード<br>
<input type="text" name="account_password" value="<?php print $rec['account_password'];?>">
<br><br>
google_account<br>
<input type="text" name="google_account" value="<?php print $rec['google_account'];?>">
<br><br>
掲載開始日<br>
<input type="datetime" name="post_period_start" value="<?php print $rec['post_period_start'];?>">
<br><br>
掲載終了日<br>
<input type="text" name="post_period_end" value="<?php print $rec['post_period_end'];?>">
<br><br><br><br>
掲載情報の登録<br>
エージェントid（上のagent_idと同じだから入力なし）<br>
<!-- <input type="text" name="agent_id" value=""> -->
<br><br>
キャッチフレーズ<br>
<input type="text" name="catchphrase" value="<?php print $rec_2['catchphrase'];?>">
<br><br>
特徴<br>
<input type="text" name="feature" value="<?php print $rec_2['feature'];?>">
<br><br>
エリア<br>
地域code<br>
<input type="text" name="region_code" value="<?php print $rec_2['region_code'];?>">
<br><br>
県code<br>
<input type="text" name="prefecture_code" value="<?php print $rec_2['prefecture_code'];?>">
<br><br>
オンライン面談可否<br>
<input type="text" name="online_meeting" value="<?php print $rec_2['online_meeting'];?>">
<br><br>
会員数<br>
<input type="text" name="membership" value="<?php print $rec_2['membership'];?>">
<br><br>
メリット<br>
<input type="text" name="pros" value="<?php print $rec_2['pros'];?>">
<br><br>
デメリット<br>
<input type="text" name="cons" value="<?php print $rec_2['cons'];?>">

<br><br>
<input type="hidden" name="agent_id" value="<?php print $rec['agent_id'];?>">
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>
</body>
</html>