<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>エージェント修正実効</title>
    <link rel="stylesheet" href="../style/sass/base/reset.css">
    <link rel="stylesheet" href="../style/css/userPage.css">
    <link rel="icon" href="../style/img/favicon.ico" id="favicon">
    <script src="../js/header.js" defer></script>
    <script src="../js/user_Q&A.js" defer></script>
</head>

<body>
    <section class="whole-wrapper">
        <div class="whole-wrapper__background"></div>
    <?php include "../common/user_page_header.html" ?>
        <?php

        try {

            require_once("../common/common.php");
            //いつものやつ    
            $post = sanitize($_POST);
            $name = $post["name"];
            $mail_address = $post["mail_address"];
            $question = $post["question"];
        } catch (Exception $e) {
            echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
            print "<a href='../boozer_login/boozer_login.php'>ログイン画面へ</a>";
        }
        ?>

        <section class="user-contact">
            <h1 class="user-contact__tittle contact">内容確認</h1>
            <form action="user_inquiry_form_done.php" method="post" class="user-contact__form">
                <!-- <div><span class="inquiry-form__span">氏名</span><input type="text" name="name" value="<?php echo $name; ?>"></div>
                <div><span class="inquiry-form__span">メールアドレス</span><input type="text" name="mail_address" value="<?php echo $mail_address; ?>"></div>
                <div><span class="inquiry-form__span">お問合せ内容</span><input type="text" name="question" value="<?php echo $question; ?>"></div> -->
                <div class="user-contact__form_inputBox">
                    <ul class="user-contact__form_contents">
                        <li class="user-contact__form_contents_li">氏名</li>
                        <li class="user-contact__form_contents_li">メールアドレス</li>
                        <li class="user-contact__form_contents_li">お問い合わせ事項</li>
                    </ul>
                    <div class="user-contact__form_input-area">
                        <div class="user-contact__form_head">氏名</div>
                        <input type="text" name="name" value="<?php echo $name; ?>" class="user-contact__form_input-area_input">
                        <div class="user-contact__form_head">メールアドレス</div>
                        <input type="text" name="mail_address" value="<?php echo $mail_address; ?>" class="user-contact__form_input-area_input">
                        <div class="user-contact__form_head">お問い合わせ事項</div>
                        <textarea name="question" cols="30" rows="10" wrap="hard" class="user-contact__form_input-area_input"><?php echo $question; ?></textarea>
                    </div>
                </div>
                <input type="submit" value="お問合せ送信" class="user-contact__form_submit">

            </form>

        </section>
        <footer>
            <img src="../user_page/img/boozer_logo.png" alt="" id="boozer_logo">
        </footer>
    </section>
</body>

</html>