<?php

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
    <title>エージェント選択NG</title>
    <link rel="stylesheet" href="../style/sass/base/reset.css">
    <link rel="stylesheet" href="../style/css/boozerPage.css">
</head>

<body>

    <?php include "../common/boozer_page_header.php"; ?>
    
    <!-- ラジオボタン選択されてない時はこのページに飛ぶ -->
    <div class="operate_agent__ng_message">
        エージェントを選択して下さい
    </div>
    <a href="agent_list.php" class="operate_agent__ng_back">エージェント一覧へ</a>

</body>

</html>