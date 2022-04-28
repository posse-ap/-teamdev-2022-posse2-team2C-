<?php
//ログインチェック 別にログインしてなくてもみれる
session_start();
session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECサイトTOP</title>
    <link rel="stylesheet" href="../style/reset.css">
    <link rel="stylesheet" href="../style/craft.css?<?php echo date('Ymd-Hi'); ?>">
</head>

<body>
    <!-- header -->
    <?php include "../common/user_page_header.html";

    try {
        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        $user = "root";
        $password = "password";
        $dbh_2 = new PDO($dsn, $user, $password);
        $dbh_2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql_2 = "SELECT agent.agent_id, catchphrase, feature, region_code, prefecture_code, online_meeting, membership, pros, cons, company_name FROM agent INNER JOIN agent_account ON agent.id=agent_account.agent_id";
        $stmt_2 = $dbh_2->prepare($sql_2);
        $stmt_2->execute();

        $dbh_2 = null;

        print "エージェント一覧";
        print "<br><br>";

        while (true) {
            $rec_2 = $stmt_2->fetch(PDO::FETCH_ASSOC);
            if ($rec_2 === false) {
                break;
            } 
            $agent_id = $rec_2["agent_id"];
            ?>
            
            <div class="user_page__agent_container">
                <div class="user_page__heart_img_wrapper">
                    <a href='user_cartin.php?agent_id=" . $agent_id . "'>♡</a>
                    <div class="user_page__img_wrapper">
                        <img src="./agent_img/agent_img.1" alt="" class="user_page__img">
                    </div>
                </div>
                <div class="user_page__text_wrapper">
                    <span class="user_page__company_name"><?php print $rec_2["company_name"];?></span>
                    <span class="user_page__catchphrase"><?php print $rec_2["catchphrase"];?></span>
                </div>
                <a href='user_detail.php?agent_id=<?php echo $agent_id;?>'>詳しくはこちら！</a>
                
            </div>



            <!-- <div id="question_area"></div> -->

    <?php
           
        }
        print "<br>";
    } catch (Exception $e) {
        print "只今障害が発生しております。<br><br>";
        echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
        print "<a href='../boozer_login/boozer_login.php'>ログイン画面へ</a>";
    }
    ?>
    <footer>
        <img src="./img/boozer_logo.png" alt="" id="boozer_logo">
    </footer>

    <script src="../js/header.js"></script>
    <script src="../js/user_page.js"></script>
</body>

</html>