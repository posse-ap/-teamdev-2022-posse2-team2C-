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

    <form action="user_inquiry_form_done.php" method="post" class="inquiry-form">
        <div><span class="inquiry-form__span">氏名</span><input type="text" name="name" value="<?php echo $name;?>"></div>
        <div><span class="inquiry-form__span">メールアドレス</span><input type="text" name="mail_address" value="<?php echo $mail_address;?>"></div>
        <div><span class="inquiry-form__span">お問合せ内容</span><input type="text" name="question" value="<?php echo $question;?>"></div>
        <input type="submit" value="お問合せ送信">
    </form>
</body>
</html>