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

            while (true) {
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($rec === false) {
                    break;
                }


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
                <?php
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
                $dbh_2 = new PDO($dsn, $user, $password);
                $dbh_2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql_2 = "SELECT * FROM student_delete_request_table WHERE student_family_name= :student_family_name AND student_first_name= :student_first_name AND student_family_name_ruby= :student_family_name_ruby AND student_first_name_ruby= :student_first_name_ruby AND email_address= :email_address AND phone_number= :phone_number AND name_of_the_univ= :name_of_the_univ AND faculty= :faculty AND department= :department AND school_year= :school_year AND the_year_of_grad= :the_year_of_grad AND agent_id= :agent_id";
                $stmt_2 = $dbh_2->prepare($sql_2);
                $stmt_2->bindValue(":student_family_name", $student_family_name, PDO::PARAM_STR);
                $stmt_2->bindValue(":student_first_name", $student_first_name, PDO::PARAM_STR);
                $stmt_2->bindValue(":student_family_name_ruby", $student_family_name_ruby, PDO::PARAM_STR);
                $stmt_2->bindValue(":student_first_name_ruby", $student_first_name_ruby, PDO::PARAM_STR);
                $stmt_2->bindValue(":email_address", $email_address, PDO::PARAM_STR);
                $stmt_2->bindValue(":phone_number", $phone_number, PDO::PARAM_STR);
                $stmt_2->bindValue(":name_of_the_univ", $name_of_the_univ, PDO::PARAM_STR);
                $stmt_2->bindValue(":faculty", $faculty, PDO::PARAM_STR);
                $stmt_2->bindValue(":department", $department, PDO::PARAM_STR);
                $stmt_2->bindValue(":school_year", $school_year, PDO::PARAM_STR);
                $stmt_2->bindValue(":the_year_of_grad", $the_year_of_grad, PDO::PARAM_STR);
                $stmt_2->bindValue(":agent_id", $agent_id, PDO::PARAM_STR);
                $stmt_2->execute();
                $cnt = $stmt_2->rowCount();
                $dbh_2 = null;


                if ($cnt == 0) { ?>
                    <a href="./agent_page_student_delete.php?student_id=<?php echo $rec["id"] ?>&agent_id=<?php echo $agent_id; ?>" class="delete">削除申請する！！</a>
                <?php
                }
                if ($cnt == 1) { ?>
                    <span class="delete">削除申請中だよんちょいとお待ち</span>
                <?php
                }


                ?>

        <?php
            }
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