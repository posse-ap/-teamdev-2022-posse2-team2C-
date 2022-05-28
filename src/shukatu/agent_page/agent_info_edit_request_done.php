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
            //スタッフ一覧を表示させたいからdbにconnect
            $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
            $user = "root";
            $password = "password";
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // $sql = "SELECT student_id FROM student_agent_connection_table WHERE agent_id=?";
            $sql = "SELECT student_info.id, student_family_name, student_first_name, student_family_name_ruby, student_first_name_ruby, email_address, phone_number, name_of_the_univ, faculty, department, school_year, the_year_of_grad FROM student_info INNER JOIN student_agent_connection_table ON student_info.id=student_agent_connection_table.student_id WHERE student_id=?";

            $stmt = $dbh->prepare($sql);
            $data[] = $student_id;
            $stmt->execute($data);

            $dbh = null;

            while (true) {
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($rec === false) {
                    break;
                }
                // $rec = $stmt->fetch(PDO::FETCH_ASSOC);


$agent = "irodas";
// これはログインしているエージェントにしたい（汎用性持たせる）
$from = 'onokan@icloud.com';
// この上のメルアドがログインしているエージェントのメルアドにしたい
$to = "onokan@gmail.com";
// この上のメルアドもログインしているスタッフの誰か（全部これだと小野に送られちゃう）にしたい
$subject =  '掲載情報編集の要請';
$body = <<<EOD
    {$agent}から掲載情報変更の申請が来ています。至急対応してください。
    EOD;
$headers = "From: onokan@gmail.com";
// 最終的なメール
// メールを送信する
mb_send_mail($to, $subject, $body, $headers); 
$ret = mb_send_mail($to, $subject, $body, "From: {$from} \r\n");
// print("メールが送信されました。もうしばらくお待ちください。");
?>
                <h1>申請が完了しました。 boozerからの連絡をお待ちください。</h1>

<?php
            }
        } catch (Exception $e) {
            echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
            print "<a href='./boozer_staff_login/boozer_boozer_login.php'>ログイン画面へ</a>";
        }
        ?>
    </div>
    </div>
        


</body>

</html>