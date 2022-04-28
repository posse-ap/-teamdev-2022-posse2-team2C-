<?php
//ログインチェック
session_start();
session_regenerate_id(true);
if (isset($_SESSION["login"]) === false) {
    print "ログインしていません。<br><br>";
    print "<a href='boozer_login.php'>ログイン画面へ</a>";
    exit();
} else {
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>エージェント詳細</title>
    <link rel="stylesheet" href="../style/reset.css">
    <link rel="stylesheet" href="../style/craft.css?<?php echo date('Ymd-Hi'); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
</head>

<body>
    <?php include "../common/boozer_page_header.php"; ?>
    <?php
    try {
        //どこで乗せてきたurlだろ、branch.phpかな 
        $agent_id = $_GET["agent_id"];

        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        $user = "root";
        $password = "password";
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT agent.agent_id, catchphrase, feature, region_code, prefecture_code, online_meeting, membership, pros, cons, company_name, company_name, company_staff, account_email_address, account_password, google_account, post_period_start, post_period_end FROM agent INNER JOIN agent_account ON agent.id=agent_account.agent_id WHERE agent.agent_id=?";
        $stmt = $dbh->prepare($sql);
        $data[] = $agent_id;
        $stmt->execute($data);

        $dbh = null;

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
        print "<a href='../boozer_login/boozer_login.php'>ログイン画面へ</a>";
    }
    ?>
    <div class="right_page_container">
        <div>
            <h1>エージェント詳細・掲載状態</h1>
            <ul class="agent_account_info">
                <li></li>
            </ul>
        </div>



        エージェント詳細<br><br>
        エージェントコード<br>
        <?php print $rec["agent_id"]; ?>
        <br><br>
        カテゴリー<br>
        <?php print $rec["catchphrase"]; ?>
        <br><br>
        エージェント名<br>
        <?php print $rec["feature"]; ?>
        <br><br>
        <br><br>
        詳細<br>
        <?php print $rec["online_meeting"]; ?>
        <br><br>
    </div>
    </div>

    <form>
        <input type="button" onclick="history.back()" value="戻る">
    </form>

</body>

</html>