<?php
 
session_start();
//sessionの値を全て消去
$_SESSION = array();
//cookieを消去(cookieはブラウザ側に保存されるsession的な情報らしい)
if(isset($_COOKIE[session_name()]) === true) {
    setcookie(session_name(), "", time()-42000, "/");
}
//sessionを完全に解除
session_destroy();
?>
 
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ログアウト</title>
<link rel="stylesheet" href="../style.css">
</head>
    
<body>
    
ログアウトしました。<br><br>
<a href="boozer_login.php">ログイン画面へ</a>

</body>
</html>