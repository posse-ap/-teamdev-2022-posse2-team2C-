<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>個人情報登録完了</title>

    <link rel="stylesheet" href="../style/sass/base/reset.css">
    <link rel="stylesheet" href="../style/css/userPage.css">
</head>
<body>
    <?php include "../common/user_page_header.html" ?>
    <div class="form-step">
        <ol class="c-stepper">
            <li class="c-stepper__item">
                <h3 class="c-stepper__title">情報の入力</h3>
                <p class="c-stepper__desc">Some desc text</p>
            </li>
            <li class="c-stepper__item">
                <h3 class="c-stepper__title">内容確認</h3>
                <p class="c-stepper__desc">Some desc text</p>
            </li>
            <li class="c-stepper__item c-stepper__item_here">
                <h3 class="c-stepper__title">申請完了</h3>
                <p class="c-stepper__desc">Some desc text</p>
            </li>
        </ol>
    </div>
    <?php
    //日本時間を取得
    date_default_timezone_set('Asia/Tokyo');
    // echo date('Y-m-d H:i:s');
    try {

        require_once("../common/common.php");

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
        $form_send_time = date('Y-m-d H:i:s');

        //boozer staff情報取得
        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        $user = "root";
        $password = "password";
        $dbh_3 = new PDO($dsn, $user, $password);
        $dbh_3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql_3 = "SELECT * FROM staff WHERE code=1";
        $stmt_3 = $dbh_3->prepare($sql_3);
        $stmt_3->execute();
        $dbh_3 = null;
        $rec_3 = $stmt_3->fetch(PDO::FETCH_ASSOC);
        $boozer_email = $rec_3["mail_address"];

        //学生情報登録
        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        $user = "root";
        $password = "password";
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $dbh->prepare("INSERT INTO student_info (student_family_name, student_first_name, student_family_name_ruby, student_first_name_ruby, email_address, phone_number, name_of_the_univ, faculty, department, school_year, the_year_of_grad, form_send_time) VALUES (:student_family_name, :student_first_name, :student_family_name_ruby, :student_first_name_ruby, :email_address, :phone_number, :name_of_the_univ, :faculty, :department, :school_year, :the_year_of_grad, :form_send_time)");
        $stmt->bindParam(':student_family_name', $student_family_name, PDO::PARAM_STR);
        $stmt->bindParam(':student_first_name', $student_first_name, PDO::PARAM_STR);
        $stmt->bindParam(':student_family_name_ruby', $student_family_name_ruby, PDO::PARAM_STR);
        $stmt->bindParam(':student_first_name_ruby', $student_first_name_ruby, PDO::PARAM_STR);
        $stmt->bindParam(':email_address', $email_address, PDO::PARAM_STR);
        $stmt->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
        $stmt->bindParam(':name_of_the_univ', $name_of_the_univ, PDO::PARAM_STR);
        $stmt->bindParam(':faculty', $faculty, PDO::PARAM_STR);
        $stmt->bindParam(':department', $department, PDO::PARAM_STR);
        $stmt->bindParam(':school_year', $school_year, PDO::PARAM_STR);
        $stmt->bindParam(':the_year_of_grad', $the_year_of_grad, PDO::PARAM_STR);
        $stmt->bindParam(':form_send_time', $form_send_time, PDO::PARAM_STR);
        $stmt->execute();
        $dbh = null;

        //エージェントと学生を紐付けるtableに登録
        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        $user = "root";
        $password = "password";
        $dbh_2 = new PDO($dsn, $user, $password);
        $dbh_2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql_2 = "INSERT INTO student_agent_connection_table(agent_id) VALUES(?)";
        $stmt_2 = $dbh_2->prepare($sql_2);
        $data_2[] = $agent_id;
        $stmt_2->execute($data_2);
        $dbh_2 = null;

        //メールに記述するagent情報を取得
        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        $user = "root";
        $password = "password";
        $dbh_4 = new PDO($dsn, $user, $password);
        $dbh_4->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql_4 = "SELECT * FROM agent_account WHERE id =?";
        $stmt_4 = $dbh_4->prepare($sql_4);
        $data_4[] = $agent_id;
        $stmt_4->execute($data_4);
        $dbh_4 = null;
        $rec_4 = $stmt_4->fetch(PDO::FETCH_ASSOC);
        $agent_name = $rec_4["company_name"];
        $agent_email = $rec_4["account_email_address"];

        // 学生へのサンクスメール
        $student_name = $student_family_name . $student_first_name;
        $from = $boozer_email;
        $to = $email_address;
        $subject =  '申請に関して';
        $body = <<<EOD
            -----------------
            {$student_name}様
            -----------------

            申請ありがとうございます。
            該当のエージェントに申請完了しました。

            ご入力いただいた情報に従って各エージェント企業担当者より追ってご連絡差し上げます。
            ご登録いただいたメールアドレスへのメールをご確認ください。
            EOD;
        $headers = "From:" . $boozer_email;
        // 最終的なメール
        // メールを送信する
        mb_send_mail($to, $subject, $body, $headers);


        // エージェントへの通知メール
        $url = "http://localhost:80/shukatu/agent_login/agent_login.php";
        $agent_name = $agent_name;
        $from = $boozer_email;
        $to = $agent_email;
        // 申請されたエージェントのメルアドにしたい
        $subject =  '学生からの申請通知';
        $body = <<<EOD
            -----------------
            {$agent_name}様
            -----------------
            学生の{$student_name}さんより申請がありました。
            至急管理者画面からご確認ください。
            <管理者ログインページ>
            {$url}
            EOD;
        $headers = "From:" . $boozer_email;
        // 最終的なメール
        // メールを送信する
        mb_send_mail($to, $subject, $body, $headers);

        print "<div class='done_message'>登録完了しました！</div>
        <div class='done_message_text'>申請が完了しました。<br>
        ご入力いただいた情報に従って各エージェント企業担当者より追ってご連絡差し上げます。
        ご登録いただいたメールアドレスへのメールをご確認ください。</div>
        ";
        print "<a href='../user_page/user_agent_list.php' class='backToTop'>トップへ戻る</a>";
    } catch (Exception $e) {
        echo "（ ´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
        print "<a href='member_login.php'>ログインページへ戻る</a>";
        exit();
    }
    ?>
</body>

</html>