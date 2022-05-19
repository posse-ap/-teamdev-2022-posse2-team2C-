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
    <!-- ファビコン -->
    <link rel="icon" href="../style/img/favicon.ico" id="favicon">
    <script src="../js/header.js" defer></script>
</head>

<body>

    <?php

    if (empty($_SESSION["cart"]) === true) {
        include "../common/user_page_header.html";

        print "お気に入りにエージェントはありません。<br><br>";

        print "<a href='user_agent_list.php'>エージェント一覧へ戻る</a>";
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

    <form action="agent_quantity.php" method="post">
        お気に入り一覧<br><br>
        <?php for ($i = 0; $i < $max; $i++) {; ?>

            <div class="user_page__heart_img_wrapper">
            <div class="user_page__img_wrapper">
            <img src="./agent_img/agent_img_<?php echo $agent_id[$i];?>.png" alt="" class="user_page__img">
            </div>
        </div>
        <div class="user_page__text_wrapper">
            <span class="user_page__company_name"><?php print $company_name[$i]; ?></span>
            <span class="user_page__catchphrase"><?php print $catchphrase[$i]; ?></span>
        </div>

            

            お気に入りから削除する:<input type="checkbox" name="delete<?php print $i; ?>"><br>

            <br>

        <?php }; ?>

        <br><br>
        <input type="hidden" name="max" value="<?php print $max; ?>">

        <input type="submit" value="お気に入りから削除">

        <br><br>
        <input type="button" onclick="history.back()" value="戻る">
    </form>
    <br>

    <a href="user_info_multiple_forms_check.php">個人情報入力に進む</a>

</body>

</html>