<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録完了</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <?php
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

        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        $user = "root";
        $password = "password";
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO student_info(student_family_name, student_first_name, student_family_name_ruby, student_first_name_ruby, email_address, phone_number, name_of_the_univ, faculty, department, school_year, the_year_of_grad) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $dbh->prepare($sql);
        $data[] = $student_family_name;
        $data[] = $student_first_name;
        $data[] = $student_family_name_ruby;
        $data[] = $student_first_name_ruby;
        $data[] = $email_address;
        $data[] = $phone_number;
        $data[] = $name_of_the_univ;
        $data[] = $faculty;
        $data[] = $department;
        $data[] = $school_year;
        $data[] = $the_year_of_grad;
        $stmt->execute($data);

        $dbh = null;

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



        //member tableに値を登録


        print "登録完了しました。<br><br>";
        print "<a href='../user_page/user_agent_list.php'>トップへ戻る</a>";
    } catch (Exception $e) {
        echo "（ ´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
        print "<a href='member_login.php'>ログインページへ戻る</a>";
        exit();
    }
    ?>
    <br><br>

</body>

</html>