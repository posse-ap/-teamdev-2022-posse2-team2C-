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

        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        $user = "root";
        $password = "password";
        $dbh = new PDO($dsn, $user, $password);
        $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //アカウント情報
        $stmt= $dbh -> prepare("INSERT INTO student_inquiry_form_table (student_name, mail_address, question) VALUES (:student_name, :mail_address, :question)");
        $stmt->bindParam(':student_name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':mail_address', $mail_address, PDO::PARAM_STR);
        $stmt->bindParam(':question', $question, PDO::PARAM_STR);
        $stmt -> execute();
        $dbh = null;


    } catch (Exception $e) {
        echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
        print "<a href='../boozer_login/boozer_login.php'>ログイン画面へ</a>";
    }
    ?>
    <div>
        <h1>送信が完了しました。</h1>
        <a href="./user_Q&A.php">Q&Aページに戻る</a>
    </div>
    
</body>
</html>