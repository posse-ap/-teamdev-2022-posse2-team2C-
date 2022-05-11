<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>[AGENT]学生情報一覧</title>

    <link rel="stylesheet" href="../style/reset.css">
    <link rel="stylesheet" href="../style/craft.css?<?php echo date('Ymd-Hi'); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    include "../common/boozer_page_header.php"; ?>

    <div class="right_page_container">

    <?php

    try {
        //スタッフ一覧を表示させたいからdbにconnect
        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        $user = "root";
        $password = "password";
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // $sql = "SELECT student_id FROM student_agent_connection_table WHERE agent_id=?";
        $sql = "SELECT student_info.id, student_family_name, student_first_name, student_family_name_ruby, student_first_name_ruby, email_address, phone_number, name_of_the_univ, faculty, department, school_year, the_year_of_grad, student_agent_connection_table.agent_id FROM student_info INNER JOIN student_agent_connection_table ON student_info.id=student_agent_connection_table.student_id";

        $stmt = $dbh->prepare($sql);
    
        $stmt->execute();

        $dbh = null;

         while (true) {
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($rec === false) {
                break;
            }
        // $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
            <div class="student-info__wrapper">
            <span class="student-info___span"><?php echo $rec['student_family_name'];?></span>
            <span class="student-info___span"><?php echo $rec['student_first_name'];?></span>
            <span class="student-info___span"><?php echo $rec['student_family_name_ruby'];?></span>
            <span class="student-info___span"><?php echo $rec['student_first_name_ruby'];?></span>
            <span class="student-info___span"><?php echo $rec['email_address'];?></span>
            <span class="student-info___span"><?php echo $rec['phone_number'];?></span>
            <span class="student-info___span"><?php echo $rec['name_of_the_univ'];?></span>
            <span class="student-info___span"><?php echo $rec['faculty'];?></span>
            <span class="student-info___span"><?php echo $rec['department'];?></span>
            <span class="student-info___span"><?php echo $rec['school_year'];?>年</span>
            <span class="student-info___span"><?php echo $rec['the_year_of_grad'];?>年卒</span>
            <span class="student-info___span"><?php echo $rec['agent_id'];?></span>
            

            </div>
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