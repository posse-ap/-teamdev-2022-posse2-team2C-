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
    <title>管理画面TOP</title>
    <link rel="stylesheet" href="../style/reset.css">
    <link  rel="stylesheet" href="../style/craft.css?<?php echo date('Ymd-Hi');?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
</head>

<body>
<?php include "../common/agent_page_header.php"; ?>
    <?php 
    print $_SESSION["account_email_address"];
    ?><br><br>
    <a href="agent_logout.php">ログアウト</a>
</body>

</html>