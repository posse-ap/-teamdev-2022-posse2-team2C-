<?php

session_start();
//session_regenerate_id(true);
//if(isset($_SESSION["login"]) === false) {
//   print "ログインしていません。<br><br>";
//   print "<a href='boozer_login.php'>ログイン画面へ</a>";
//   exit();
//} else {
//    print $_SESSION["name"]."さんログイン中";
//    print "<br><br>";
//}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>スタッフ追加チェック</title>
    <!-- <link rel="stylesheet" href="../style.css"> -->
</head>

<body>

    <?php

    //入力された情報をpostで取得（クロスサイトスクリプティング防止）
    $name = htmlspecialchars($_POST["name"], ENT_QUOTES, "UTF-8");
    $mail_address = htmlspecialchars($_POST["mail_address"], ENT_QUOTES, "UTF-8");
    $pass = htmlspecialchars($_POST["pass"], ENT_QUOTES, "UTF-8");
    $pass2 = htmlspecialchars($_POST["pass2"], ENT_QUOTES, "UTF-8");

    //emptyがtrue = 中身が空っぽ
    if (empty($name) === true) {
        print "名前が入力されていません。<br><br>";
    } else {
        print $name;
        print "<br><br>";
    }

    if (empty($pass) === true) {
        print "パスワードが入力されていません。<br><br>";
    }

    if ($pass != $pass2) {
        print "パスワードが一致しません。<br><br>";
    }

    //不十分だったら戻るボタン表示
    if (empty($name) or empty($pass) or $pass != $pass2) {
        print "<form>";
        print "<input type='button' onclick='history.back()' value='戻る'>";
        print "</form>";
    } else {
        //大丈夫だったらスタッフ追加

        $pass = md5($pass); //パスワード乱数化
        print "上記スタッフを追加しますか？<br><br>";
        print "<form action='boozer_staff_add_done.php' method='post'>";
        print "<input type='hidden' name='name' value='" . $name . "'>";
        print "<input type='hidden' name='mail_address' value='" . $mail_address . "'>";
        print "<input type='hidden' name='pass' value='" . $pass . "'>";
        print "<input type='button' onclick='history.back()' value='戻る'>";
        print "<input type='submit' value='OK'>";
        print "</form>";
    }

    ?>
</body>

</html>