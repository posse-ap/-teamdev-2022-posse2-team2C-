<?php
//ログインチェック
session_start();
session_regenerate_id(true);
if (isset($_SESSION["login"]) === false) {
    print "ログインしていません。<br><br>";
    print "<a href='boozer_login.php'>ログイン画面へ</a>";
    exit();
} else {
    print $_SESSION["name"] . "さんログイン中";
    print "<br><br>";
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>エージェント修正実効</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
    try {

        require_once("../common/common.php");
        //いつものやつ    
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
        // $cate = $post["cate"];

        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        $user = "root";
        $password = "password";
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE agent_account SET company_name=?, company_staff=?, account_email_address=?, account_password=?, google_account=?, post_period_start=?, post_period_end=? WHERE agent_id=?";
        $stmt = $dbh->prepare($sql);
        // $data[] = $cate;
        
        $data[] = $company_name;
        $data[] = $company_staff;
        $data[] = $account_email_address;
        $data[] = $account_password;
        $data[] = $google_account;
        $data[] = $post_period_start;
        $data[] = $post_period_end;
        $data[] = $agent_id;
        $stmt->execute($data);

        $dbh = null;

        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        $user = "root";
        $password = "password";
        $dbh_2 = new PDO($dsn, $user, $password);
        $dbh_2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $sql_2 = "UPDATE agent SET catchphrase=?, feature=?, online_meeting=?, membership=?, pros=?, cons=? WHERE agent_id=?";
        $stmt_2 = $dbh_2->prepare($sql_2);
        // $data_2[] = $cate;
        
        $data[] = $company_name;
        $data_2[] = $catchphrase;
        $data_2[] = $feature;
        $data_2[] = $online_meeting;
        $data_2[] = $membership;
        $data_2[] = $pros;
        $data_2[] = $cons;

        $data_2[] = $agent_id;

        $stmt_2->execute($data_2);

        $dbh_2 = null;
    } catch (Exception $e) {
        echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
        print "<a href='../boozer_login/boozer_login.php'>ログイン画面へ</a>";
    }
    ?>

    エージェントを修正しました。<br><br>
    <a href="agent_list.php">エージェント一覧へ</a>

</body>

</html>