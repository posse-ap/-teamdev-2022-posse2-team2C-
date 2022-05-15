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
    <link rel="icon" href="../style/img/favicon.ico" id="favicon">
    <link rel="stylesheet" href="../style/sass/parts/favorite_heart.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sawarabi+Gothic&family=Zen+Kaku+Gothic+New:wght@300&family=Zen+Maru+Gothic:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <?php include "../common/user_page_header.html" ?>
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
            <div class="detail-page__agent_img-wrapper">
                <img src="./agent_img/agent_img_<?php echo $agent_id; ?>.png" alt="" class="detail-page__agent_img">
                <div class="detail-page__agent_tag"><span class="detail-page__agent_tag_text">#</span></div>
                <div class="detail-page__agent_heart">
                    <a href="user_cartin.php?agent_id=<?php echo $agent_id; ?>" class="heart_link">
                        <div class="Likes">
                            <div class="LikesIcon"></div>
                        </div>

                    </a>
                </div>
            </div>
            <div>
            <span class="user_page__company_name"><?php print $rec["company_name"]; ?></span>
            <span class="user_page__catchphrase"><?php print $rec["catchphrase"]; ?></span>
            </div>
        </div>
        <div></div>
    </div>

    </div>
    <!-- <div class="user_page__text_wrapper">
        <span class="user_page__company_name"><?php print $rec["company_name"]; ?></span>
        <span class="user_page__catchphrase"><?php print $rec["catchphrase"]; ?></span>
        <span class="user_page__catchphrase"><?php print $rec["feature"]; ?></span>
        <span class="user_page__catchphrase"><?php print $rec["online_meeting"]; ?></span>
        <span class="user_page__catchphrase"><?php print $rec["membership"]; ?></span>
        <span class="user_page__catchphrase"><?php print $rec["pros"]; ?></span>
        <span class="user_page__catchphrase"><?php print $rec["cons"]; ?></span>
    </div> -->

    <a href='user_info_form_done.php?agent_id=<?php echo $agent_id; ?>' class='student-info-form__btn'>
        <span class="student-info-form__btn_text">個人情報入力に進む</span>
    </a>

    </div>

    <form>
        <input type="button" onclick="history.back()" value="一覧に戻る">
    </form>

    <!-- <h3>カテゴリー</h3> -->
    <!-- <a href="shop_list_eart.php">食品</a><br>
<a href="shop_list_kaden.php">家電</a><br>
<a href="shop_list_book.php">書籍</a><br>
<a href="shop_list_niti.php">日用品</a><br>
<a href="shop_list_sonota.php">その他</a><br> -->
    <script src="../js/header.js"></script>
    <script src="../js/favorite.js"></script>
    <script src="../js/user_page.js"></script>
</body>

</html>