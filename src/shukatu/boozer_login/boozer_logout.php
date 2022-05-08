<?php

session_start();
//sessionの値を全て消去
$_SESSION = array();
//cookieを消去(cookieはブラウザ側に保存されるsession的な情報らしい)
if (isset($_COOKIE[session_name()]) === true) {
    setcookie(session_name(), "", time() - 42000, "/");
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
    <link rel="stylesheet" href="../style/reset.css">
    <link rel="stylesheet" href="../style/craft.css?<?php echo date('Ymd-Hi'); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="agent_logout_container">
        <div class="agent_logout_wrapper">
            <span>ログアウトしました。</span>
            <a href="boozer_login.php">ログイン画面へ</a>
        </div>
    </div>
</body>

</html>