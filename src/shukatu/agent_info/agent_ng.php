<?php
 
session_start();
session_regenerate_id(true);
if(isset($_SESSION["login"]) === false) {
    print "ログインしていません。<br><br>";
    print "<a href='staff_login.html'>ログイン画面へ</a>";
    exit();
} else {
    print $_SESSION["name"]."さんログイン中";
    print "<br><br>";
}
?>
 
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>エージェント選択NG</title>
<link rel="stylesheet" href="../style.css">
</head>
    
<body>

<!-- ラジオボタン選択されてない時はこのページに飛ぶ -->
エージェントを選択して下さい<br><br>
<a href="agent_list.php">エージェント一覧へ</a>
 
</body>
</html>