<?php session_start();

$agent_id = $_GET["agent_id"];

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>個人情報入力ページ</title>

    <link rel="stylesheet" href="../style/sass/base/reset.css">
    <link rel="stylesheet" href="../style/css/userPage.css">
</head>

<body>
    <?php include "../common/user_page_header.html" ?>

    <div class="form-step">
        <ol class="c-stepper">
            <li class="c-stepper__item c-stepper__item_here">
                <h3 class="c-stepper__title">情報の入力</h3>
                <p class="c-stepper__desc">Some desc text</p>
            </li>
            <li class="c-stepper__item">
                <h3 class="c-stepper__title">内容確認</h3>
                <p class="c-stepper__desc">Some desc text</p>
            </li>
            <li class="c-stepper__item">
                <h3 class="c-stepper__title">申請完了</h3>
                <p class="c-stepper__desc">Some desc text</p>
            </li>
        </ol>
    </div>

    <form action="../student_info/student_info_db_check.php" method="post" class = "student_info__form">
        <input type="text" name="agent_id" value="<?php echo $agent_id; ?>" class = "student_info__agent_id">
        <div>
            <span class="student_info__form_tittle">お名前</span>
            <span class="student_info__form_input_area">
                <input type="text" name="student_family_name">
                <input type="text" name="student_first_name">
            </span>
        </div>
        <div>
            <span class="student_info__form_tittle">ふりがな</span>
            <span class="student_info__form_input_area">
                <input type="text" name="student_family_name_ruby">
                <input type="text" name="student_first_name_ruby">
            </span>
        </div>
        <div>
            <span class="student_info__form_tittle">メール</span>
            <span class="student_info__form_input_area">
                <input type="text" name="email_address">
            </span>
        </div>
        <div>
            <span class="student_info__form_tittle">電話番号</span>
            <span class="student_info__form_input_area">
                <input type="text" name="phone_number">
            </span>
        </div>
        <div>
            <span class="student_info__form_tittle">大学名</span>
            <span class="student_info__form_input_area">
                <input type="text" name="name_of_the_univ">
            </span>
        </div>
        <div>
            <span class="student_info__form_tittle">学部</span>
            <span class="student_info__form_input_area">
                <input type="text" name="faculty">
            </span>
        </div>
        <div>
            <span class="student_info__form_tittle">学科</span>
            <span class="student_info__form_input_area">
                <input type="text" name="department">
            </span>
        </div>
        <div>
            <span class="student_info__form_tittle">学年</span>
            <span class="student_info__form_input_area">
                <input type="text" name="school_year">
            </span>
        </div>
        <div>
            <span class="student_info__form_tittle">卒年</span>
            <span class="student_info__form_input_area">
                <input type="text" name="the_year_of_grad">
            </span>
        </div>
        <input type="button" onclick="history.back()" value="戻る" class="student_info__form_back_btn">
        <input type="submit" value="OK" class="student_info__form_ok_btn">
        <br><br>

    </form>
    <br><br>

</body>

</html>