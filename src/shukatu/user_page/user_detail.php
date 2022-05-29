<?php
//あるようでないログインチェック 
session_start();
session_regenerate_id(true);

if (isset($_SESSION["member_login"]) === true) {
    print "ようこそ";
    print $_SESSION["member_name"];
    print "様 ";
    print "<a href='../member_login/member_logout.php'>ログアウト</a>";
    print "<br><br>";
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>就活エージェント詳細ページ</title>
    <link rel="stylesheet" href="../style/sass/base/reset.css">
    <link rel="stylesheet" href="../style/css/userPage.css">
    <!-- ファビコン -->
    <link rel="icon" href="../style/img/favicon.ico" id="favicon">
    <link rel="stylesheet" href="../style/sass/parts/favorite_heart.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sawarabi+Gothic&family=Zen+Kaku+Gothic+New:wght@300&family=Zen+Maru+Gothic:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <section class="whole-wrapper">
        <div class="whole-wrapper__background"></div>
        <?php include "../common/user_page_header.html" ?>
        <section class="user_agentDetail">
            <?php
            try {
                //選択したエージェントだけ表示
                //shop_list.phpでのっけたurlをgetでとってくる
                $agent_id = $_GET["agent_id"];

                $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
                $user = "root";
                $password = "password";
                $dbh = new PDO($dsn, $user, $password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                $sql = "SELECT * FROM agent INNER JOIN agent_account ON agent.id=agent_account.agent_id WHERE agent.agent_id=?";

                $stmt = $dbh->prepare($sql);
                $data[] = $agent_id;
                $stmt->execute($data);

                $dbh = null;

                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                print "只今障害が発生しております。<br><br>";
                print "<a href='../boozer_login/boozer_login.php'>ログイン画面へ</a>";
            }
            ?>
            <div class="detail-page__agent_wrapper">
                <div class="detail-page__agent">
                    <div class="detail-page__agent_heart">
                        <a href="user_cartin.php?agent_id=<?php echo $agent_id; ?>" class="heart_link">
                            <div class="Likes">
                                <div class="LikesIcon"></div>
                            </div>

                        </a>
                    </div>
                    <div>
                        <span class="detail_page__company_name"><?php print $rec["company_name"]; ?></span>
                        <span class="detail_page__catchphrase"><?php print $rec["catchphrase"]; ?></span>
                    </div>
                    <div class="detail-page__agent_img-wrapper">
                        <img src="./agent_img/agent_img_<?php echo $agent_id; ?>.png" alt="" class="detail-page__agent_img">
                        <!-- <div class="detail-page__agent_tag"><span class="detail-page__agent_tag_text">#</span></div> -->
                    </div>
                </div>

                <div class="detail_page__text_wrapper">
                    <!-- <span class="detail_page__company_name"><?php print $rec["company_name"]; ?></span> -->
                    <!-- <span class="detail_page__catchphrase"><?php print $rec["catchphrase"]; ?></span> -->
                    <span class="detail_page__feature"><?php print $rec["feature"]; ?></span>
                    <span class="detail_page__online_meeting">オンライン面談：<?php print $rec["online_meeting"]; ?></span>
                    <span class="detail_page__membership">会員数：<?php print $rec["membership"]; ?></span>
                    <span class="detail_page__pros">メリット：<?php print $rec["pros"]; ?></span>
                    <span class="detail_page__cons">デメリット：<?php print $rec["cons"]; ?></span>
                </div>
            </div>


            <a href='user_info_form_done.php?agent_id=<?php echo $agent_id; ?>' class='student-info-form__btn'>
                <span class="student-info-form__btn_text">申請に進む</span>
            </a>


            <form class="detail-page__back_btn_wrapper">
                <input type="button" onclick="history.back()" value="一覧に戻る" class="detail-page__back_btn">
            </form>
        </section>


        <footer>
            <img src="./img/boozer_logo.png" alt="" id="boozer_logo">
        </footer>
    </section>
</body>

</html>