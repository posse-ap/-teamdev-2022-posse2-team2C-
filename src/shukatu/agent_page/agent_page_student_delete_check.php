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
        $student_id = $_POST["student_id"];
        $agent_id = $_POST["agent_id"];
        echo $student_id;


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
        ?>
                <h1>申請が完了しました boozerからの連絡をお待ちになって</h1>
        <?php
                require_once("../common/common.php");

                $post = sanitize($_POST);
                $reason = $post["reason"];


                $student_family_name = $rec['student_family_name'];
                $student_first_name = $rec['student_first_name'];
                $student_family_name_ruby = $rec['student_family_name_ruby'];
                $student_first_name_ruby = $rec["student_first_name_ruby"];
                $email_address = $rec["email_address"];
                $phone_number = $rec["phone_number"];
                $name_of_the_univ = $rec["name_of_the_univ"];
                $faculty = $rec["faculty"];
                $department = $rec["department"];
                $school_year = $rec["school_year"];
                $the_year_of_grad = $rec["the_year_of_grad"];

                $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
                $user = "root";
                $password = "password";
                $dbh = new PDO($dsn, $user, $password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $dbh->prepare("INSERT INTO student_delete_request_table (student_id, student_family_name, student_first_name, student_family_name_ruby, student_first_name_ruby, email_address, phone_number, name_of_the_univ, faculty, department, school_year, the_year_of_grad, agent_id, reason) VALUES (:student_id, :student_family_name, :student_first_name, :student_family_name_ruby, :student_first_name_ruby, :email_address, :phone_number, :name_of_the_univ, :faculty, :department, :school_year, :the_year_of_grad, :agent_id, :reason)");
                $stmt->bindParam(':student_id', $student_id, PDO::PARAM_STR);
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
                $stmt->bindParam(':agent_id', $agent_id, PDO::PARAM_STR);
                $stmt->bindParam(':reason', $reason, PDO::PARAM_STR);
                $stmt->execute();

                $dbh = null;
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