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
    <title>就活エージェント比較サイトTOPページ</title>
    <link rel="stylesheet" href="../style/sass/base/reset.css">
    <link rel="stylesheet" href="../style/css/user-agentList.css">
    <script src="../js/user_page.js" defer></script>
</head>

<body>
    <!-- header -->
    <?php include "../common/user_page_header.html";

    try {
        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        $user = "root";
        $password = "password";
        //agent情報
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM agent INNER JOIN agent_account ON agent.id=agent_account.agent_id";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        $dbh = null;
    ?>
        <div>
            
            <div class="tags_wrapper">
                <h1>タグ検索</h1>
                <form action="user_agent_list_tag.php" method="get">
                    <div><input type="checkbox" name="tag[]" value="1">文系</div>
                    <div><input type="checkbox" name="tag[]" value="2">理系</div>
                    <div><input type="checkbox" name="tag[]" value="3">オンライン面談可</div>
                    <div><input type="checkbox" name="tag[]" value="4">23卒</div>
                    <div><input type="checkbox" name="tag[]" value="5">24卒</div>
                    <div><input type="checkbox" name="tag[]" value="6">25卒</div>
                    <div><input type="checkbox" name="tag[]" value="7">大手</div>
                    <div><input type="checkbox" name="tag[]" value="8">ベンチャー</div>
                    <div><input type="checkbox" name="tag[]" value="9">広告・出版・マスコミ</div>
                    <div><input type="checkbox" name="tag[]" value="10">金融</div>
                    <div><input type="checkbox" name="tag[]" value="11">サービス・インフラ</div>
                    <div><input type="checkbox" name="tag[]" value="12">小売</div>
                    <div><input type="checkbox" name="tag[]" value="13">ソフトウェア</div>
                    <div><input type="checkbox" name="tag[]" value="14">官公庁・校舎・団体</div>
                    <div><input type="checkbox" name="tag[]" value="15">商社</div>
                    <input type="submit" value="検索しちゃうよ">
                </form>
            </div>
        </div>
        <?php


        while (true) {
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($rec === false) {
                break;
            }

            $agent_id = $rec["agent_id"];
        ?>

            

            <div class="user_page__agent_container">
                <div class="user_page__heart_img_wrapper">
                    <a href="user_cartin.php?agent_id=<?php echo $agent_id; ?>">♡</a>
                    <div class="user_page__img_wrapper">
                        <img src="./agent_img/agent_img_<?php echo $agent_id;?>.png" alt="" class="user_page__img">

                    </div>
                </div>
                <div class="user_page__text_wrapper">

                    <span class="user_page__company_name"><?php print $rec["company_name"]; ?></span>
                    <span class="user_page__catchphrase"><?php print $rec["catchphrase"]; ?></span>
                    <a href='user_detail.php?agent_id=<?php echo $agent_id; ?>' class="user_page__detail_btn">詳しくはこちら！</a>
                </div>
                
            </div>
    <?php }

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
</body>

</html>