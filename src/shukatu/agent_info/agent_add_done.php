<?php
//ログインチェック
session_start();
session_regenerate_id(true);
if(isset($_SESSION["login"]) === false) {
    print "ログインしていません。<br><br>";
    print "<a href='boozer_login.php'>ログイン画面へ</a>";
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
<title>エージェント追加実効</title>
<link rel="stylesheet" href="../style.css">
</head>
    
<body>
<?php
    try{
    
require_once("../common/common.php");
    
$post = sanitize($_POST);
$agent_id = $post["agent_id"];
$company_name = $post["company_name"];
$company_staff = $post["company_staff"];
$account_email_address = $post["account_email_address"];
$account_password = $post["account_password"];
$google_account = $post["google_account"];
$post_period_start = $post["post_period_start"];
$post_period_end = $post["post_period_end"];

$catchphrase = $post["catchphrase"];
$feature = $post["feature"];
$region_code = $post["region_code"];
$prefecture_code = $post["prefecture_code"];
$online_meeting = $post["online_meeting"];
$membership = $post["membership"];
$pros = $post["pros"];
$cons = $post["cons"];
 
$dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
$user = "root";
$password = "password";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//アカウント情報
$sql = "INSERT INTO agent_account(agent_id, company_name, company_staff, account_email_address, account_password, google_account, post_period_start, post_period_end) VALUES(?,?,?,?,?,?,?,?)";
$stmt = $dbh -> prepare($sql);
$data[] = $agent_id;
$data[] = $company_name;
$data[] = $company_staff;
$data[] = $account_email_address;
$data[] = $account_password;
$data[] = $google_account;
$data[] = $post_period_start;
$data[] = $post_period_end;
$stmt -> execute($data);
    
$dbh = null;

$dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
$user = "root";
$password = "password";
$dbh_2 = new PDO($dsn, $user, $password);
$dbh_2 -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//掲載情報
$sql_2 = "INSERT INTO agent(agent_id, catchphrase, feature, region_code, prefecture_code, online_meeting, membership, pros, cons) VALUES(?,?,?,?,?,?,?,?,?)";
$stmt_2 = $dbh_2 -> prepare($sql_2);
$data_2[] = $agent_id;
$data_2[] = $catchphrase;
$data_2[] = $feature;
$data_2[] = $region_code;
$data_2[] = $prefecture_code;
$data_2[] = $online_meeting;
$data_2[] = $membership;
$data_2[] = $pros;
$data_2[] = $cons;
$stmt_2 -> execute($data_2);
    
$dbh_2 = null;
        
}
catch(Exception $e) {
    echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
    print "<a href='../boozer_login/boozer_login.php'>ログイン画面へ</a>";
    echo "(´･ω･`)人(`･ω･´)ﾄﾞﾝﾏｲ!!: " . $e->getMessage() . "\n";
    exit();
}
?>
    
エージェントを追加しました。<br><br>
<a href="agent_list.php">エージェント一覧へ</a>
 
</body>
</html>