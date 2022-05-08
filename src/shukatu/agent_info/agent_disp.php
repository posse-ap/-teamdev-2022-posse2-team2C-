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

        $sql = "SELECT * FROM agent JOIN agent_account ON agent.id=agent_account.agent_id JOIN tag_existence ON agent.id=tag_existence.agent_id WHERE agent.agent_id=?";
        $stmt = $dbh->prepare($sql);
        $data[] = $agent_id;
        $stmt->execute($data);
        $dbh = null;
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        $dbh_2 = new PDO($dsn, $user, $password);
        $dbh_2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql_2 = "SELECT * FROM tag";
        $stmt_2 = $dbh_2->prepare($sql_2);
        $stmt_2->execute();
        $dbh_2 = null;

    } catch (Exception $e) {
        echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
        print "<a href='../boozer_login/boozer_login.php'>ログイン画面へ</a>";
    }
    ?>
    <div class="right_page_container">
        <div class="agent-detail__wrapper">
            <h1 class="agent-detail__tittle">エージェント詳細・掲載状態</h1>
            <ul class="agent-detail__info-wrapper">
                <li class="agent-detail__info">エージェントコード： <?php print $rec["agent_id"]; ?></li>
                <li class="agent-detail__info">エージェント名：<?php print $rec["feature"]; ?></li>
                <li class="agent-detail__info">キャッチフレーズ：<?php print $rec["catchphrase"]; ?></li>
                <li class="agent-detail__info">特徴：<?php print $rec["feature"]; ?></li>
                <li class="agent-detail__info">オンライン面談可否：<?php print $rec["online_meeting"]; ?></li>
                <li class="agent-detail__info">会員数：<?php print $rec["membership"]; ?></li>
                <li class="agent-detail__info">メリット：<?php print $rec["pros"]; ?></li>
                <li class="agent-detail__info">デメリット：<?php print $rec["cons"]; ?></li>
            </ul>
            <ul class="agent-detail__tag-wrapper">
                <?php
                 while (true) {
                    $rec_2 = $stmt_2->fetch(PDO::FETCH_ASSOC);
                    if ($rec_2 === false) {
                        break;
                    }?>
                    <li class="agent-detail__tag"><?php echo $rec_2["tag_name"];
                 }
                 for($i=1; $i<16; $i++){
                    if($rec["tag_".$i] === 0) {?>
                    <li class="agent-detail__tag-existence">なし</li>
                    <?php
                    } else {
                    ?>
                    <li class="agent-detail__tag-existence">あり</li>
                    <?php
                    }
                    
                    
                    ?>
                    </li>
                    <?php
                }
                ?>
                

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