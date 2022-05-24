<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>エージェント修正実効</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

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

    <form action="user_inquiry_form_done.php" method="post">
        <span>氏名</span><input type="text" name="name" value="<?php echo $name;?>">
        <span>メールアドレス</span><input type="text" name="mail_address" value="<?php echo $mail_address;?>">
        <span>お問合せ内容</span><input type="text" name="question" value="<?php echo $question;?>">
        <input type="submit" value="お問合せ送信">
    </form>
</body>
</html>