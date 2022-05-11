<?php
//ちゃんとログインできてるか確認
session_start();
//セッションハイジャック防止（ページ毎にsession idをランダムに変更）
session_regenerate_id(true);
if (isset($_SESSION["login"]) === false) {
    print "ログインしていません。<br><br>";
    print "<a href='agent_login.php'>ログイン画面へ</a>";
    exit();
} else {
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[AGENT]管理画面TOP</title>
    <link rel="stylesheet" href="../style/sass/base/reset.css">
    <link rel="stylesheet" href="../style/css/agentPage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
    <link rel="icon" href="../style/img/favicon.ico" id="favicon">
</head>

<body>
    <?php include "../common/agent_page_header.php"; ?>
    <div class="right-page__container">
        <div class="agent-logged-in">
            <ul class="agent-logged-in__container">
                <li class="agent-logged-in__menu"><span class="agent-logged-in__text">ユーザー情報</span></li>
                <li class="agent-logged-in__menu"><span class="agent-logged-in__text">エージェント会社名</span><span><?php print $_SESSION["company_name"]; ?></span></li>
                <li class="agent-logged-in__menu"><span class="agent-logged-in__text">メールアドレス</span><span><?php print $_SESSION["account_email_address"] ?></span></li>
            </ul>
        </div>
        <div class="request-list"></div>
    </div>
    </div>
    <?php
    print $_SESSION["account_email_address"];
    ?><br><br>
    <a href="agent_logout.php">ログアウト</a>
</body>

</html>