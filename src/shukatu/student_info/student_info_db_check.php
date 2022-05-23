<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>個人情報入力チェック</title>

    <link rel="stylesheet" href="../style/sass/base/reset.css">
    <link rel="stylesheet" href="../style/css/userPage.css">
</head>

<body>

    <?php

    require_once("../common/common.php");

    include "../common/user_page_header.html"; ?>

    <div class="form-step">
        <ol class="c-stepper">
            <li class="c-stepper__item">
                <h3 class="c-stepper__title">情報の入力</h3>
                <p class="c-stepper__desc">Some desc text</p>
            </li>
            <li class="c-stepper__item c-stepper__item_here">
                <h3 class="c-stepper__title">内容確認</h3>
                <p class="c-stepper__desc">Some desc text</p>
            </li>
            <li class="c-stepper__item">
                <h3 class="c-stepper__title">申請完了</h3>
                <p class="c-stepper__desc">Some desc text</p>
            </li>
        </ol>

    </div>

    <?php

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

    $okflag = true;

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
        print "<div class='check_area'><h1>下記内容で登録しますか？</h1>";
    ?>

        <form action='student_info_db_done.php' method='post' class="student_info__form">
            <input type="text" name="agent_id" value="<?php echo $agent_id ?>" class="student_info__agent_id">
            <div>
                <span class="student_info__form_tittle">お名前</span>
                <span class="student_info__form_input_area">
                    <input type="text" name="student_family_name" value="<?php echo $student_family_name ?>">
                    <input type="text" name="student_first_name" value="<?php echo $student_first_name ?>">
                </span>
            </div>
            <div>
                <span class="student_info__form_tittle">ふりがな</span>
                <span class="student_info__form_input_area">
                    <input type="text" name="student_family_name_ruby" value="<?php echo $student_family_name_ruby ?>">
                    <input type="text" name="student_first_name_ruby" value="<?php print $student_first_name_ruby ?>">
                </span>
            </div>
            <div>
                <span class="student_info__form_tittle">メール</span>
                <span class="student_info__form_input_area">
                    <input type="text" name="email_address" value="<?php print $email_address ?>">
                </span>
            </div>
            <div>
                <span class="student_info__form_tittle">電話番号</span>
                <span class="student_info__form_input_area">
                    <input type="text" name="phone_number" value="<?php print $phone_number ?>">
                </span>
            </div>
            <div>
                <span class="student_info__form_tittle">大学名</span>
                <span class="student_info__form_input_area">
                    <input type="text" name="name_of_the_univ" value="<?php print $name_of_the_univ ?>">
                </span>
            </div>
            <div>
                <span class="student_info__form_tittle">学部</span>
                <span class="student_info__form_input_area">
                    <input type="text" name="faculty" value="<?php print $faculty ?>">
                </span>
            </div>
            <div>
                <span class="student_info__form_tittle">学科</span>
                <span class="student_info__form_input_area">
                    <input type="text" name="department" value="<?php print $department ?>">
                </span>
            </div>
            <div>
                <span class="student_info__form_tittle">学年</span>
                <span class="student_info__form_input_area">
                    <input type="text" name="school_year" value="<?php print $school_year ?>">
                </span>
            </div>
            <div>
                <span class="student_info__form_tittle">卒年</span>
                <span class="student_info__form_input_area">
                    <input type="text" name="the_year_of_grad" value="<?php print $the_year_of_grad ?>">
                </span>
            </div>
            <div class="student_info_check__btn_area">
                <input type='button' onclick='history.back()' value='戻る' class="back_btn">
                <input type='submit' value='登録' class="submit_btn">
            </div>

        <?php
    }
        ?>
        </div>
</body>

</html>