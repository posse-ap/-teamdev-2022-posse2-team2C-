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
    <link rel="stylesheet" href="../style/sass/base/reset.css">
    <link rel="stylesheet" href="../style/css/boozerPage.css">
    <link rel="icon" href="../style/img/favicon.ico" id="favicon">
</head>

<body>

    <?php include "../common/boozer_page_header.php"; ?>
    <div class="boozer-page__right-page-container">
    <?php

    require_once("../common/common.php");

    $post = sanitize($_POST);
    $student_family_name = $post["student_family_name"];
    $student_first_name = $post["student_first_name"];
    $student_family_name_ruby = $post["student_family_name_ruby"];
    $student_first_name_ruby = $post["student_first_name_ruby"];
    $email_address = $post["email_address"];
    $phone_number = $post["phone_number"];
    $name_of_the_univ = $post["name_of_the_univ"];
    $faculty = $post["faculty"];
    $reason = $post["reason"];
    $agent_id = $post["agent_id"];
    $student_id = $post["student_id"];


    $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
    $user = "root";
    $password = "password";
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //アカウント情報
    $stmt = $dbh->prepare("DELETE FROM student_agent_connection_table WHERE agent_id= :agent_id AND student_id= :student_id");
    $stmt->bindParam(':agent_id', $agent_id, PDO::PARAM_STR);
    $stmt->bindParam(':student_id', $student_id, PDO::PARAM_STR);
    $stmt->execute();
    $dbh = null;

    $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
    $user = "root";
    $password = "password";
    $dbh_2 = new PDO($dsn, $user, $password);
    $dbh_2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //アカウント情報
    $stmt_2 = $dbh_2->prepare("DELETE FROM student_delete_request_table WHERE agent_id= :agent_id AND student_id= :student_id");
    $stmt_2->bindParam(':agent_id', $agent_id, PDO::PARAM_STR);
    $stmt_2->bindParam(':student_id', $student_id, PDO::PARAM_STR);
    $stmt_2->execute();
    $dbh = null;
    ?>
        <span>学生を削除しました。</span>
    </div>



</body>

</html>