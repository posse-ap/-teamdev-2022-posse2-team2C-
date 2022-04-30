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
    <title>エージェント削除</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php include "../common/boozer_page_header.php"; ?>
    <?php
    try {

        $agent_id = $_GET["agent_id"];

        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        $user = "root";
        $password = "password";
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //全レコード対象にcode,name,price取得
        $sql = "SELECT agent_id, company_name, company_staff, account_email_address, account_password, google_account, post_period_start, post_period_end FROM agent_account WHERE agent_id=?";
        $stmt = $dbh->prepare($sql);
        $data[] = $agent_id;
        $stmt->execute($data);

        $dbh = null;
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        $user = "root";
        $password = "password";
        $dbh_2 = new PDO($dsn, $user, $password);
        $dbh_2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //全レコード対象にcode,name,price取得
        $sql_2 = "SELECT agent_id, catchphrase, feature, region_code, prefecture_code, online_meeting, membership, pros, cons FROM agent WHERE agent_id=?";
        $stmt_2 = $dbh_2->prepare($sql_2);
        $data_2[] = $agent_id;
        $stmt_2->execute($data_2);

        $dbh_2 = null;
        $rec_2 = $stmt_2->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
        print "<a href='../boozer_login/boozer_login.php'>ログイン画面へ</a>";
    }
    ?>
    エージェント詳細<br><br>
    エージェントコード<br>
    <?php print $rec["agent_id"]; ?>
    <br><br>
    エージェント名<br>
    <?php print $rec["company_name"]; ?>
    <br><br>
    担当者名<br>
    <?php print $rec["company_staff"]; ?>
    円<br>
    <br><br>
    上記情報を削除しますか？<br><br>
    <form action="agent_delete_done.php" method="post">
        <input type="hidden" name="agent_id" value="<?php print $rec['agent_id']; ?>">

        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
    </form>

</body>

</html>