<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>[AGENT]学生情報一覧</title>

    <link rel="stylesheet" href="../style/sass/base/reset.css">
    <link rel="stylesheet" href="../style/css/agentPage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
</head>

<body>
<!-- 作業の手順
１、請求ボタンからこのページに飛べるようにする
２、agent_page_student_listの登録されている学生情報を表示させる
３、これで請求していいか確認
４、おっけー→メールに情報を載せてブザーにそうしん
５、確認用にエージェント側にも送信 -->

    <?php include "../common/agent_page_header.php"; ?>
   

    <div class="agent-page__right-page-container">

        <?php
        $agent_id = $_GET["agent_id"];

        try {
            //スタッフ一覧を表示させたいからdbにconnect
            $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
            $user = "root";
            $password = "password";
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // $sql = "SELECT student_id FROM student_agent_connection_table WHERE agent_id=?";
            $sql = "SELECT student_info.id, student_family_name, student_first_name, student_family_name_ruby, student_first_name_ruby, email_address, phone_number, name_of_the_univ, faculty, department, school_year, the_year_of_grad FROM student_info INNER JOIN student_agent_connection_table ON student_info.id=student_agent_connection_table.student_id WHERE student_agent_connection_table.agent_id=?";

            $stmt = $dbh->prepare($sql);
            $data[] = $agent_id;
            $stmt->execute($data);

            $dbh = null;
            
$i = 0;

            while (true) {
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($rec === false) {
                    break;
                }
                $akj = 1;
                $i++;

        ?>
                <div class="agent_page_student_info_wrapper">
                    <span class="agent_page_student_info_wrapper_span"><?php echo $rec['student_family_name']; ?></span>
                    <span class="agent_page_student_info_wrapper_span"><?php echo $rec['student_first_name']; ?></span>
                    <span class="agent_page_student_info_wrapper_span"><?php echo $rec['student_family_name_ruby']; ?></span>
                    <span class="agent_page_student_info_wrapper_span"><?php echo $rec['student_first_name_ruby']; ?></span>
                    <span class="agent_page_student_info_wrapper_span"><?php echo $rec['email_address']; ?></span>
                    <span class="agent_page_student_info_wrapper_span"><?php echo $rec['phone_number']; ?></span>
                    <span class="agent_page_student_info_wrapper_span"><?php echo $rec['name_of_the_univ']; ?></span>
                    <span class="agent_page_student_info_wrapper_span"><?php echo $rec['faculty']; ?></span>
                    <span class="agent_page_student_info_wrapper_span"><?php echo $rec['department']; ?></span>
                    <span class="agent_page_student_info_wrapper_span"><?php echo $rec['school_year']; ?>年</span>
                    <span class="agent_page_student_info_wrapper_span"><?php echo $rec['the_year_of_grad']; ?>年卒</span>
                </div>
                <div class="agent_page_student_info_wrapper">
                    <p><?= $a ?>人の学生から請求が来ています。請求しますか？<br></p>
                    <a href="./agent_info_invoice_check_done.php">請求する</a>
                </div>

        <?php
            }
            echo($i);
        } catch (Exception $e) {
            echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
            print "<a href='./boozer_staff_login/boozer_boozer_login.php'>ログイン画面へ</a>";
        }

        ?>



        <?php

        ?>



    </div>
    </div>
        


</body>

</html>