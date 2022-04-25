<?php
//ログインチェック
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
<title>スタッフ修正チェック</title>
<link rel="stylesheet" href="style.css">
</head>
    
<body>
    <?php
//postで送信された情報を使える様にする
$code = htmlspecialchars($_POST["code"], ENT_QUOTES, "UTF-8");
$name = htmlspecialchars($_POST["name"], ENT_QUOTES, "UTF-8");
$pass = htmlspecialchars($_POST["pass"], ENT_QUOTES, "UTF-8");
$pass2 = htmlspecialchars($_POST["pass2"], ENT_QUOTES, "UTF-8");

//staff codeを表示
print "スタッフコード<br>";
print $code;
print "の情報を修正します。";
print "<br><br>";

//formにちゃんと入力されているか
if(empty($name) === true) {
    print "名前が入力されていません。<br><br>";
} else {
    print "スタッフ名:";
    print $name;
    print "<br><br>";
}
    
if(empty($pass) === true) {
    print "パスワードが入力されていません。<br><br>";
} else {
    print "パスワード編集済み<br><br>";
}
    
if($pass != $pass2) {
    print "パスワードが異なります。<br><br>";
}
if(empty($name) or empty($pass) or $pass != $pass2) {
    print "<form>";
    print "<input type='button' onclick='history.back()' value='戻る'>";
    print "</form>";
} else {
    $pass = md5($pass);
    print "上記の通り修正しますか？<br><br>";
    print "<form action='boozer_staff_edit_done.php' method='post'>";
    print "<input type='hidden' name='name' value='".$name."'>";
    print "<input type='hidden' name='pass' value='".$pass."'>";
    print "<input type='hidden' name='code' value='".$code."'>";
    print "<input type='button' onclick='history.back()' value='戻る'>";
    print "<input type='submit' value='OK'>";
    print "</form>";
}
?>
</body>
</html>