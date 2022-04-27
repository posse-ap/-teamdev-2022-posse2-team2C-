<?php
//ちゃんとログインできてるか確認
session_start();
//セッションハイジャック防止（ページ毎にsession idをランダムに変更）
session_regenerate_id(true);
if(isset($_SESSION["login"]) === false) {
    print "ログインしていません。<br><br>";
    print "<a href='agent_login.html'>ログイン画面へ</a>";
    exit();
} else {
    print "<h1>エージェント用管理画面TOP</h1><br>" . $_SESSION["account_email_address"]."様ログイン中";
    print "<br>";
}
?>
 
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>管理画面TOP</title>
<link rel="stylesheet" href="../style.css">
</head>
    
<body>

<br><br>
<?php print $_SESSION["account_email_address"];
  ?><br><br>
    <a href="agent_logout.php">ログアウト</a>
</body>
</html>