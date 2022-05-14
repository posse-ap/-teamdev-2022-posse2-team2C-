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
        $student_id = $_GET["student_id"];
        $agent_id = $_GET["agent_id"];

        try {
            //スタッフ一覧を表示させたいからdbにconnect
            $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
            $user = "root";
            $password = "password";
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // $sql = "SELECT student_id FROM student_agent_connection_table WHERE agent_id=?";
            $sql = "SELECT * FROM student_info INNER JOIN student_agent_connection_table ON student_info.id=student_agent_connection_table.student_id WHERE student_id=?";

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
                <h1>この学生を削除申請しますか？</h1>
                <div class="student-info">
                    <span class="student-info__span"><?php echo $rec['student_family_name']; ?></span>
                    <span class="student-info__span"><?php echo $rec['student_first_name']; ?></span>
                    <span class="student-info__span"><?php echo $rec['student_family_name_ruby']; ?></span>
                    <span class="student-info__span"><?php echo $rec['student_first_name_ruby']; ?></span>
                    <span class="student-info__span"><?php echo $rec['email_address']; ?></span>
                    <span class="student-info__span"><?php echo $rec['phone_number']; ?></span>
                    <span class="student-info__span"><?php echo $rec['name_of_the_univ']; ?></span>
                    <span class="student-info__span"><?php echo $rec['faculty']; ?></span>
                    <span class="student-info__span"><?php echo $rec['department']; ?></span>
                    <span class="student-info__span"><?php echo $rec['school_year']; ?>年</span>
                    <span class="student-info__span"><?php echo $rec['the_year_of_grad']; ?>年卒</span>
                </div>

                <form action="agent_page_student_delete_check.php?student_id=<?php echo $rec["id"]; ?>" method="post">
                    <span>削除する理由</span>
                    <input type="text" name="reason" placeholder="削除申請の理由をご記入ください。">
                    <input type="text" name="student_id" value="<?php echo $rec["id"]; ?>">
                    <input type="text" name="agent_id" value="<?php echo $agent_id; ?>">
                    <input type="submit" value="送信">
                </form>
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