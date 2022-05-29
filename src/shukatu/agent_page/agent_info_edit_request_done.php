<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>[AGENT]学生削除申請画面</title>

    <link rel="stylesheet" href="../style/sass/base/reset.css">
    <link rel="stylesheet" href="../style/css/agentPage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
</head>

<body>

    <?php include "../common/agent_page_header.php"; ?>

    <div class="agent-page__right-page-container">

        <?php
        $student_id = "1";
        $agent_id = $_POST["agent_id"];


        try {
            //エージェント情報取得
            $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
            $user = "root";
            $password = "password";
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM agent_account WHERE agent_id=?";
            $stmt = $dbh->prepare($sql);
            $data[] = $agent_id;
            $stmt->execute($data);
            $dbh = null;
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $agent_name = $rec["company_name"];
            $account_email_address = $rec["account_email_address"];

            //boozer staff情報取得
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
            $boozer_email = $rec_2["mail_address"];

            $agent = $agent_name;
            $from = $boozer_email;
            $to = $account_email_address;
            $subject =  '掲載情報編集の要請';
            $body = <<<EOD
                {$agent}様から掲載情報変更の申請が来ています。
                至急対応してください。
                EOD;
            $headers = "From:" . $boozer_email;
            // 最終的なメール
            // メールを送信する
            mb_send_mail($to, $subject, $body, $headers);
        ?>
            <h1>申請が完了しました。 boozerからの連絡をお待ちください。</h1>

        <?php
        } catch (Exception $e) {
            echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
            print "<a href='./boozer_staff_login/boozer_boozer_login.php'>ログイン画面へ</a>";
        }
        ?>
    </div>
    </div>



</body>

</html>