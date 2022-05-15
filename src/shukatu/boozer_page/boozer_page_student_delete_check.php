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
    ?>
    <div class="boozer-page__right-page-container">
    <span class = "delete_check">本当にこの学生を削除していいんですね？</span>
    <form action="boozer_page_student_delete_done.php" method="post">
        <input type="text" name="student_family_name" value="<?php echo $post["student_family_name"]; ?>">
        <input type="text" name="student_first_name" value="<?php echo $post["student_first_name"]; ?>">
        <input type="text" name="student_family_name_ruby" value="<?php echo $post["student_family_name_ruby"]; ?>">
        <input type="text" name="student_first_name_ruby" value="<?php echo $post["student_first_name_ruby"]; ?>">
        <input type="text" name="email_address" value="<?php echo $post["email_address"]; ?>">
        <input type="text" name="phone_number" value="<?php echo $post["phone_number"]; ?>">
        <input type="text" name="name_of_the_univ" value="<?php echo $post["name_of_the_univ"]; ?>">
        <input type="text" name="faculty" value="<?php echo $post["faculty"]; ?>">
        <input type="text" name="reason" value="<?php echo $post["reason"]; ?>">
        <input type="text" name="agent_id" value="<?php echo $post["agent_id"]; ?>">
        <input type="text" name="student_id" value="<?php echo $post["student_id"]; ?>">
        <input type="submit" value="削除">
    </form>


    </div>
</body>

</html>