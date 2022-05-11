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
    
// require_once("../common/common.php");
    
$post = $_POST;
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
$stmt= $dbh -> prepare("INSERT INTO agent_account (agent_id, company_name, company_staff, account_email_address, account_password, google_account, post_period_start, post_period_end) VALUES (:agent_id, :company_name, :company_staff, :account_email_address, :account_password, :google_account, :post_period_start, :post_period_end)");
$stmt->bindParam(':agent_id', $agent_id, PDO::PARAM_STR);
$stmt->bindParam(':company_name', $company_name, PDO::PARAM_STR);
$stmt->bindParam(':company_staff', $company_staff, PDO::PARAM_STR);
$stmt->bindParam(':account_email_address', $account_email_address, PDO::PARAM_STR);
$stmt->bindParam(':account_password', $account_password, PDO::PARAM_STR);
$stmt->bindParam(':google_account', $google_account, PDO::PARAM_STR);
$stmt->bindParam(':post_period_start', $post_period_start, PDO::PARAM_STR);
$stmt->bindParam(':post_period_end', $post_period_end, PDO::PARAM_STR);
$stmt -> execute();
$dbh = null;

$dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
$user = "root";
$password = "password";
$dbh_2 = new PDO($dsn, $user, $password);
$dbh_2 -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//掲載情報
$stmt_2= $dbh_2 -> prepare("INSERT INTO agent (agent_id, company_name, catchphrase, feature, online_meeting, membership, pros, cons) VALUES (:agent_id, :company_name, :catchphrase, :feature, :online_meeting, :membership, :pros, :cons)");
$stmt_2->bindParam(':agent_id', $agent_id, PDO::PARAM_STR);
$stmt_2->bindParam(':company_name', $company_name, PDO::PARAM_STR);
$stmt_2->bindParam(':catchphrase', $catchphrase, PDO::PARAM_STR);
$stmt_2->bindParam(':feature', $feature, PDO::PARAM_STR);
$stmt_2->bindParam(':online_meeting', $online_meeting, PDO::PARAM_STR);
$stmt_2->bindParam(':membership', $membership, PDO::PARAM_STR);
$stmt_2->bindParam(':pros', $pros, PDO::PARAM_STR);
$stmt_2->bindParam(':cons', $cons, PDO::PARAM_STR);
$stmt_2 -> execute();
    
$dbh_2 = null;

$dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
$user = "root";
$password = "password";
$dbh_3 = new PDO($dsn, $user, $password);
$dbh_3 -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$arr1 = array();
    foreach ($_POST['tag'] as $tag) {
        $arr1[] = "tag_" . $tag . "=1";


        $stmt_3= $dbh_3 -> prepare("UPDATE  tag_existence SET (agent_id, company_name, catchphrase, feature, online_meeting, membership, pros, cons) VALUES (:agent_id, :company_name, :catchphrase, :feature, :online_meeting, :membership, :pros, :cons)");

    }

    $a = implode(" AND ", $arr1);
    
    echo $a;

//掲載情報

$stmt_3->bindParam(':agent_id', $agent_id, PDO::PARAM_STR);
$stmt_3->bindParam(':company_name', $company_name, PDO::PARAM_STR);
$stmt_3->bindParam(':catchphrase', $catchphrase, PDO::PARAM_STR);
$stmt_3->bindParam(':feature', $feature, PDO::PARAM_STR);
$stmt_3->bindParam(':online_meeting', $online_meeting, PDO::PARAM_STR);
$stmt_3->bindParam(':membership', $membership, PDO::PARAM_STR);
$stmt_3->bindParam(':pros', $pros, PDO::PARAM_STR);
$stmt_3->bindParam(':cons', $cons, PDO::PARAM_STR);
        
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