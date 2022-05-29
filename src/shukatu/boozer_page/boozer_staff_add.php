<?php
// tableとの接続
// require('./setting.php');

// ログインしてるかどうかチェック
// session_start();
// session_regenerate_id(true);
// if(isset($_SESSION["login"]) === false) {
//    print "ログインしていません。<br><br>";
//    print "<a href='boozer_login.php'>ログイン画面へ</a>";
//    exit();
// } else {
//    print $_SESSION["name"]."さんログイン中";
//    print "<br><br>";
// }
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/sass/base/reset.css">
    <link rel="stylesheet" href="../style/css/boozerPage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">

</head>

<body>
    <?php include "../common/boozer_page_header.php"; ?>

    <div class="boozer-page__right-page-container">

        <form action="boozer_staff_add_check.php" method="post">
            boozerのスタッフ追加<br><br>
            boozerスタッフ名<br>
            <input type="text" name="name">
            <br><br>
            メールアドレス<br>
            <input type="text" name="mail_address">
            <br><br>
            パスワード<br>
            <input type="password" name="pass">
            <br><br>
            パスワード再入力<br>
            <input type="password" name="pass2">
            <br><br>
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value="OK">
        </form>
    </div>

</body>

</html>