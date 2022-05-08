<?php
//ログインチェック
session_start();
session_regenerate_id(true);
if (isset($_SESSION["login"]) === false) {
    print "ログインしていません。<br><br>";
    print "<a href='boozer_login.php'>ログイン画面へ</a>";
    exit();
} else {
    print $_SESSION["name"] . "さんログイン中";
    print "<br><br>";
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>スタッフ修正登録</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php
    try {

        $code = htmlspecialchars($_POST["code"], ENT_QUOTES, "UTF-8");
        $name = htmlspecialchars($_POST["name"], ENT_QUOTES, "UTF-8");
        $pass = htmlspecialchars($_POST["pass"], ENT_QUOTES, "UTF-8");

        //databaseに接続
        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        $user = "root";
        $password = "password";
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //UPDATE文で内容の修正
        $sql = "UPDATE staff SET name=?, password=? WHERE code=?";
        $stmt = $dbh->prepare($sql);
        $data[] = $name;
        $data[] = $pass;
        $data[] = $code;
        $stmt->execute($data);

        $dbh = null;
    } catch (Exception $e) {
        echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
        print "<a href='./boozer_staff_login/boozer_boozer_login.php'>ログイン画面へ</a>";
    }
    ?>

    修正完了しました。<br><br>
    <a href="boozer_staff_list.php">スタッフ一覧へ</a>

</body>

</html>