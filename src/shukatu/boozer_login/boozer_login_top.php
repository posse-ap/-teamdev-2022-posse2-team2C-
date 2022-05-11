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
    $code = $_SESSION["code"];
    $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
    $user = "root";
    $password = "password";
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //codeとpasswordが一致する人を選択(nameカラムから)
    $sql = "SELECT mail_address FROM staff WHERE code=?";
    $stmt = $dbh->prepare($sql);
    $data[] = $code;
    $stmt->execute($data);

    $dbh = null;

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[BOOZER]管理画面TOP</title>
    <link rel="stylesheet" href="../style/reset.css">
    <link rel="stylesheet" href="../style/craft.css?<?php echo date('Ymd-Hi'); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
    <link rel="icon" href="../style/img/favicon.ico" id="favicon">
</head>

<body>
    <?php include "../common/boozer_page_header.php"; ?>

    <div class="right_page_container">
        <div class="user_info_container">
            <ul class="user_info_wrapper">
                <li class="user_info"><span class="user_info_text">ユーザー情報</span></li>
                <li class="user_info"><span class="user_info_text">担当者名</span><span><?php print $_SESSION["name"]; ?></span></li>
                <li class="user_info"><span class="user_info_text">メールアドレス</span><span><?php print $rec["mail_address"] ?></span></li>
            </ul>
        </div>
        <div class="request_list"></div>
    </div>
    </div>
</body>

</html>