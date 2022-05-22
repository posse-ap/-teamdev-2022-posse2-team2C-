<?php
//ちゃんとログインできてるか確認
session_start();
//セッションハイジャック防止（ページ毎にsession idをランダムに変更）
session_regenerate_id(true);
if (isset($_SESSION["login"]) === false) {
    print "ログインしていません。<br><br>";
    print "<a href='boozer_login.php'>ログイン画面へ</a>";
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

    $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
    $user = "root";
    $password = "password";
    $dbh_2 = new PDO($dsn, $user, $password);
    $dbh_2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //codeとpasswordが一致する人を選択(nameカラムから)
    $sql_2 = "SELECT * FROM student_delete_request_table";
    $stmt_2 = $dbh_2->prepare($sql_2);
    $stmt_2->execute();
    $dbh_2 = null;
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[BOOZER]管理画面TOP</title>
    <link rel="stylesheet" href="../style/sass/base/reset.css">
    <link rel="stylesheet" href="../style/css/boozerPage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
    <link rel="icon" href="../style/img/favicon.ico" id="favicon">
</head>

<body>
    <?php include "../common/boozer_page_header.php"; ?>

    <div class="boozer-page__right-page-container">
        <div class="user_info_container">
            <ul class="user_info_wrapper">
                <li class="user_info"><span class="user_info_text">ユーザー情報</span></li>
                <li class="user_info"><span class="user_info_text">担当者名</span><span><?php print $_SESSION["name"]; ?></span></li>
                <li class="user_info"><span class="user_info_text">メールアドレス</span><span><?php print $rec["mail_address"] ?></span></li>
            </ul>
        </div>

        <div class="request_list">
            <h1>学生削除申請</h1>
            <?php
            while (true) {
                $rec_2 = $stmt_2->fetch(PDO::FETCH_ASSOC);
                if ($rec_2 === false) {
                    break;
                } ?>
                <ul>
                    <li><?php echo $rec_2["student_family_name"]; ?></li>
                    <li><?php echo $rec_2["student_first_name"]; ?></li>
                    <li><?php echo $rec_2["student_family_name_ruby"]; ?></li>
                    <li><?php echo $rec_2["student_first_name_ruby"]; ?></li>
                    <li><?php echo $rec_2["email_address"]; ?></li>
                    <li><?php echo $rec_2["phone_number"]; ?></li>
                    <li><?php echo $rec_2["name_of_the_univ"]; ?></li>
                    <li><?php echo $rec_2["faculty"]; ?></li>
                    <li>理由：<?php echo $rec_2["reason"]; ?></li>
                    <li>agent_id:<?php echo $rec_2["agent_id"]; ?></li>
                    <li>student_id:<?php echo $rec_2["student_id"]; ?></li>
                </ul>

                <form action="../boozer_page/boozer_page_student_delete_check.php" method="post">
                    <input type="hidden" name="student_family_name" value="<?php echo $rec_2["student_family_name"]; ?>">
                    <input type="hidden" name="student_first_name" value="<?php echo $rec_2["student_first_name"]; ?>">
                    <input type="hidden" name="student_family_name_ruby" value="<?php echo $rec_2["student_family_name_ruby"]; ?>">
                    <input type="hidden" name="student_first_name_ruby" value="<?php echo $rec_2["student_first_name_ruby"]; ?>">
                    <input type="hidden" name="email_address" value="<?php echo $rec_2["email_address"]; ?>">
                    <input type="hidden" name="phone_number" value="<?php echo $rec_2["phone_number"]; ?>">
                    <input type="hidden" name="name_of_the_univ" value="<?php echo $rec_2["name_of_the_univ"]; ?>">
                    <input type="hidden" name="faculty" value="<?php echo $rec_2["faculty"]; ?>">
                    <input type="hidden" name="reason" value="<?php echo $rec_2["reason"]; ?>">
                    <input type="hidden" name="agent_id" value="<?php echo $rec_2["agent_id"]; ?>">
                    <input type="hidden" name="student_id" value="<?php echo $rec_2["student_id"]; ?>">

                    <input type="submit" value="削除する">
                </form>
            <?php }
            ?>
        </div>
    </div>
    </div>
</body>

</html>