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
    $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
    $user = "root";
    $password = "password";
    $dbh_2 = new PDO($dsn, $user, $password);
    $dbh_2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //urlに乗ってきたcodeを元に識別
    $sql_2 = "SELECT * FROM tag";
    $stmt_2 = $dbh_2->prepare($sql_2);
    
    $stmt_2->execute();
    $dbh_2 = null;
}
?>
 
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>エージェント追加チェック</title>
<link rel="stylesheet" href="../style.css">
</head>
    
<body>

<?php

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
    
// print $cate."<br><br>";
    
if(empty($company_name) === true) {
    print "エージェント会社名が入力されていません。<br><br>";
} else {
    print $company_name;
    print "<br><br>";
}
if(empty($company_staff) === true) {
    print "エージェント会社担当者名が入力されていません。<br><br>";
} else {
    print $company_staff;
    print "<br><br>";
}
if(empty($account_email_address) === true) {
    print "emailを入力してください。<br>";
    // $okflag = false;
}
//@無いとか
if(preg_match("/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/", $account_email_address) === 0) {
    print "正しいemailを入力してください。<br>";
    // $okflag = false;
} else {
    print $account_email_address;
    print "<br><br>";
}


if(isset($_POST["tag"]) === false) {
    
}





//どれか一つでもだめだったら戻る    
if(empty($company_name) or empty($company_staff) or empty($account_email_address) or preg_match("/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/", $account_email_address === 0)) {
    print "<form>";
    print "<input type='button' onclick='history.back()' value='戻る'>";
    print "</form>";
} else {
    print "上記エージェントを追加しますか？<br><br>";
    print "<form action='agent_add_done.php' method='post'>";
    // print "<input type='hidden' name='cate' value='".$cate."'>";
    print "<input type='hidden' name='agent_id' value='".$agent_id."'>";
    print "<input type='hidden' name='company_name' value='".$company_name."'>";
    print "<input type='hidden' name='company_staff' value='".$company_staff."'>";
    print "<input type='hidden' name='account_email_address' value='".$account_email_address."'>";
    print "<input type='hidden' name='account_password' value='".$account_password."'>";
    print "<input type='hidden' name='google_account' value='".$google_account."'>";
    print "<input type='hidden' name='post_period_start' value='".$post_period_start."'>"."<br><br>";
    print "<input type='hidden' name='post_period_end' value='".$post_period_end."'>"."<br><br>";

    print "<input type='hidden' name='catchphrase' value='".$catchphrase."'>";
    print "<input type='hidden' name='feature' value='".$feature."'>";
    print "<input type='hidden' name='region_code' value='".$region_code."'>";
    print "<input type='hidden' name='prefecture_code' value='".$prefecture_code."'>";
    print "<input type='hidden' name='online_meeting' value='".$online_meeting."'>";
    print "<input type='hidden' name='membership' value='".$membership."'>";
    print "<input type='hidden' name='pros' value='".$pros."'>";
    print "<input type='hidden' name='cons' value='".$cons."'>";

    $arr1 = array();
    foreach ($_POST['tag'] as $tag) {
        $arr1[] = "tag_" . $tag . "=1";
        print "<input type='text' name='tag[]' value='".$tag."'>";
    }


    print "<input type='button' onclick='history.back()' value='戻る'>";
    print "<input type='submit' value='OK'>";
    print "</form>";
}
?>
</body>
</html>