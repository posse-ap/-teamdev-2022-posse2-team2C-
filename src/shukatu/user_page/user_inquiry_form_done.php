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

        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        $user = "root";
        $password = "password";
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //アカウント情報
        $stmt = $dbh->prepare("INSERT INTO student_inquiry_form_table (student_name, mail_address, question) VALUES (:student_name, :mail_address, :question)");
        $stmt->bindParam(':student_name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':mail_address', $mail_address, PDO::PARAM_STR);
        $stmt->bindParam(':question', $question, PDO::PARAM_STR);
        $stmt->execute();
        $dbh = null;

        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        $user = "root";
        $password = "password";
        $dbh_2 = new PDO($dsn, $user, $password);
        $dbh_2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql_2 = "SELECT * FROM staff WHERE code=1";
        $stmt_2 = $dbh_2->prepare($sql_2);
        $stmt_2->execute();
        $dbh_2 = null;
        $rec_2 = $stmt_2->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
        print "<a href='../boozer_login/boozer_login.php'>ログイン画面へ</a>";
    }
    ?>
    <?php
    $name = $_POST["name"];
    $email = $_POST["mail_address"];
    $text = $_POST["question"];
    //boozerのメールアドレスはagent_code 1 が担当
    $boozer_email = $rec_2["mail_address"];


    //boozer宛てメール
    $from = $email;
    $to = $boozer_email;
    $subject =  'お問合せ';
    $body = <<<EOD
    学生の{$name}さんからお問合せが来ています。
    <内容>
    {$text}
    至急対応してください。
    EOD;
    $headers = "From: {$email}";
    // 最終的なメール
    // メールを送信する
    mb_send_mail($to, $subject, $body, $headers);
    print("メールが送信されました。担当の方から該当のメールアドレスの方にお答えさせていただきます。少々お待ちください。");

    //学生宛てメール
    $from = $boozer_email;
    $to = $email;
    $subject =  '先ほどのお問合せに関しましてご案内';
    $body = <<<EOD
    {$name}さんのお問合せを承りました。
    担当のものが回答いたします。もう少々お待ちください。
    EOD;
    $headers = "From: onokan@gmail.com";
    // 最終的なメール
    // メールを送信する
    mb_send_mail($to, $subject, $body, $headers);
    ?>
    <div></div>
    <h1>送信が完了しました。</h1>
    <a href="./user_Q&A.php">Q&Aページに戻る</a>
    </div>

</body>
</html>