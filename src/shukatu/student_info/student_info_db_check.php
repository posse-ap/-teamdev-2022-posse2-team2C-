<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員情報入力チェック</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <?php

    require_once("../common/common.php");

    $post = sanitize($_POST);

    $agent_id = $post["agent_id"];
    $student_family_name = $post["student_family_name"];
    $student_first_name = $post["student_first_name"];
    $student_family_name_ruby = $post["student_family_name_ruby"];
    $student_first_name_ruby = $post["student_first_name_ruby"];
    $email_address = $post["email_address"];
    $phone_number = $post["phone_number"];
    $name_of_the_univ = $post["name_of_the_univ"];
    $faculty = $post["faculty"];
    $department = $post["department"];
    $school_year = $post["school_year"];
    $the_year_of_grad = $post["the_year_of_grad"];

    // $okflag = true;

    // if(empty($name) === true) {
    //     print "お名前を入力してください。<br>";
    //     $okflag = false;
    // }
    // if(empty($email) === true) {
    //     print "emailを入力してください。<br>";
    //     $okflag = false;
    // }
    // //@無いとか
    // if(preg_match("/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/", $email) === 0) {
    //     print "正しいemailを入力してください。<br>";
    //     $okflag = false;
    // }
    // if(empty($address) === true) {
    //     print "住所を入力してください。<br>";
    //     $okflag = false;
    // }
    if (empty($phone_number) === true) {
        print "電話番号を入力してください。<br>";
        $okflag = false;
    }
    // //桁数おかしいとか
    if (preg_match("/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/", $phone_number) === 0) {
        print "正しい電話番号を入力してください。<br>";
        $okflag = false;
    }
    // if(empty($pass) === true) {
    //     print "パスワードを入力してください。<br>";
    //     $okflag = false;
    // }
    // if($pass != $pass2) {
    //     print "パスワードが異なります<br>";
    //     $okflag = false;
    // }
    if ($okflag === false) {
        print "<form><br>";
        print "<input type='button' onclick='history.back()' value='戻る'>";
    } else {
        print "下記内容で登録しますか？<br><br>";
    ?>

        <form action='student_info_db_done.php' method='post'>
            <input type="text" name="agent_id" value="<?php echo $agent_id?>">
            <input type="text" name="student_family_name" value="<?php echo $student_family_name ?>">
            <input type="text" name="student_first_name" value="<?php echo $student_first_name ?>">
            <input type="text" name="student_family_name_ruby" value="<?php echo $student_family_name_ruby ?>">
            <input type="text" name="student_first_name_ruby" value="<?php print $student_first_name_ruby ?>">
            <input type="text" name="email_address" value="<?php print $email_address ?>">
            <input type="text" name="phone_number" value="<?php print $phone_number ?>">
            <input type="text" name="name_of_the_univ" value="<?php print $name_of_the_univ ?>">
            <input type="text" name="faculty" value="<?php print $faculty ?>">
            <input type="text" name="department" value="<?php print $department ?>">
            <input type="text" name="school_year" value="<?php print $school_year ?>">
            <input type="text" name="the_year_of_grad" value="<?php print $the_year_of_grad ?>">

            <input type='button' onclick='history.back()' value='戻る'>
            <input type='submit' value='登録'>

        <?php
    }
        ?>
</body>

</html>