<?php
//だからログインはせんって

session_start();
// session_regenerate_id(true);

// if(isset($_SESSION["member_login"]) === false) {
//     print "ログインしてください。<br><br>";
//     print "<a href='../member_login/member_login.html'>ログイン画面へ</a>";
//     exit();
// } else {
//     print "ようこそ";
//     print $_SESSION["member_name"];
//     print "様　";
//     print "<a href='../member_login/member_logout.php'>ログアウト</a>";
//     print "<br><br>";
// }

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>お気に入り一覧ページ</title>

    <link rel="stylesheet" href="../style/sass/base/reset.css">
    <link rel="stylesheet" href="../style/css/userPage.css">
    <script src="../js/header.js" defer></script>
    <script src="../js/user_btn.js" defer></script>
</head>

<body>

    <?php
    if (empty($_SESSION["cart"]) === true) {
        include "../common/user_page_header.html";
    ?>
        <section class="user_empty-cart">

        <?php
        print "<div class='empty_cart'>";
        print "<p class='empty_cart__message'>お気に入りにエージェントはありません。</p>";
        print "<a href='user_agent_list.php' class='empty_cart__btn_back'>一覧に戻る</a>";
        print "</div>"; ?>
        </section>
        <footer class="footer_fixed">
        <img src="./img/boozer_logo.png" alt="" id="boozer_logo">
    </footer>
    <?php
        exit();
    }

    try {
        //header表示
        include "../common/user_page_header.html";
        $cart = $_SESSION["cart"];
        // $quantity = $_SESSION["quantity"];
        $max = count($cart);


        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        $user = "root";
        $password = "password";
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        foreach ($cart as $key => $val) {


            $sql = "SELECT * FROM agent WHERE agent_id=?";

            $stmt = $dbh->prepare($sql);
            $data[0] = $val;
            $stmt->execute($data);

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);

            $agent_id[] = $rec["agent_id"];

            $company_name[] = $rec["company_name"];

            $catchphrase[] = $rec["catchphrase"];
            $feature[] = $rec["feature"];
        }
        $dbh = null;
    } catch (Exception $e) {
        print "只今障害が発生しております。<br><br>";
        print "<a href='../boozer_login/boozer_login.php'>ログイン画面へ</a>";
    }

        ?>

        <section class="cartArea">

            <form action="agent_quantity.php" method="post">
                <h1 class="user_favorite__tittle">お気に入り一覧</h1>

                <div class="user_favorite__agent_position">
                    <?php for ($i = 0; $i < $max; $i++) {; ?>
                        <div class="user_favorite__agent">
                            <div class="user_favorite__agent_wrapper">
                                <div class="user_favorite__agent_img-wrapper">
                                    <a href='user_detail.php?agent_id=<?php echo $agent_id[$i]; ?>' class="user_favorite__agent_detail-btn">
                                        <img src="./agent_img/agent_img_<?php echo $agent_id[$i]; ?>.png" alt="" class="user_favorite__agent_img">
                                    </a>
                                    <div class="user_favorite__agent_tag"><span class="user_favorite__agent_tag_text">#</span></div>
                                    <div class="user_favorite__agent_heart">
                                        <a href="user_cartin.php?agent_id=<?php echo $agent_id; ?>" class="heart_link">
                                            <div class="Likes">
                                                <div class="LikesIcon"></div>
                                            </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                            <div class="user_favorite__agent_text">
                                <span class="user_favorite__agent_text_company-name"><?php print $company_name[$i]; ?></span>
                                <span class="user_favorite__agent_text_catchphrase"><?php print $catchphrase[$i]; ?></span>
                            </div>
                            <div class="user_favorite__delete">
                                <input type="checkbox" name="delete<?php print $i; ?>" id="delete<?php print $i; ?>" class="delete_checkbox">
                                <label for="delete<?php print $i; ?>" class="delete_label">お気に入りから削除する
                                </label>
                            </div>
                        </div>
                    <?php }; ?>
                </div>
                <input type="hidden" name="max" value="<?php print $max; ?>">
                <div class="user_favorite__btn">
                    <input type="submit" value="選んだエージェントを削除" class="user_favorite__btn_delete">
                    <input type="button" onclick="history.back()" value="戻る" class="user_favorite__btn_back">
                    <a href="user_info_multiple_forms_check.php" class="user_favorite__go_form">お気に入りに一括申請</a>
                </div>
            </form>
        </section>
        <footer class="footer_fixed">
            <img src="./img/boozer_logo.png" alt="" id="boozer_logo">
        </footer>

</body>

</html>