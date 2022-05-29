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
    <!-- ファビコン -->
    <link rel="icon" href="../style/img/favicon.ico" id="favicon">
</head>

<body>
    <?php include "../common/user_page_header.html" ?>

    <section class="user_multiple-form">
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

        <form action="../student_info/student_info_db_check.php" method="post" class="student_info__form">
            <span class="required">※は必須です。</span>
            <input type="text" name="agent_id" value="<?php echo $agent_id; ?>" class="student_info__agent_id">
            <div>
                <span class="student_info__form_tittle">
                    <span class="required">※</span>
                    お名前</span>
                <span class="student_info__form_input_area">
                    <input type="text" name="student_family_name">
                    <input type="text" name="student_first_name">
                </span>
            </div>
            <div>
                <span class="student_info__form_tittle">
                    <span class="required">※</span>
                    ふりがな</span>
                <span class="student_info__form_input_area">
                    <input type="text" name="student_family_name_ruby">
                    <input type="text" name="student_first_name_ruby">
                </span>
            </div>
            <div>
                <span class="student_info__form_tittle">
                    <span class="required">※</span>
                    メール</span>
                <span class="student_info__form_input_area">
                    <input type="text" name="email_address">
                </span>
            </div>
            <div>
                <span class="student_info__form_tittle">
                    <span class="required">※</span>
                    電話番号</span>
                <span class="student_info__form_input_area">
                    <input type="text" name="phone_number">
                </span>
            </div>
            <div>
                <span class="student_info__form_tittle">
                    <span class="required">※</span>
                    大学名</span>
                <span class="student_info__form_input_area">
                    <input type="text" name="name_of_the_univ">
                </span>
            </div>
            <div>
                <span class="student_info__form_tittle">
                    <span class="required">※</span>
                    学部</span>
                <span class="student_info__form_input_area">
                    <input type="text" name="faculty">
                </span>
            </div>
            <div>
                <span class="student_info__form_tittle">
                    <span class="required">※</span>
                    学科</span>
                <span class="student_info__form_input_area">
                    <input type="text" name="department">
                </span>
            </div>
            <div>
                <span class="student_info__form_tittle">
                    <span class="required">※</span>
                    学年</span>
                <span class="student_info__form_input_area">
                    <input type="text" name="school_year">
                </span>
            </div>
            <div>
                <span class="student_info__form_tittle">
                    <span class="required">※</span>
                    卒年</span>
                <span class="student_info__form_input_area">
                    <input type="text" name="the_year_of_grad">
                </span>
            </div>
            <span class="student_info__form_btn">
                <input type="button" onclick="history.back()" value="戻る" class="student_info__form_btn_back">
                <input type="submit" value="OK" class="student_info__form_btn_ok">
            </span>

        </form>
    </section>
    <footer>
        <img src="./img/boozer_logo.png" alt="" id="boozer_logo">
    </footer>
</body>

</html>