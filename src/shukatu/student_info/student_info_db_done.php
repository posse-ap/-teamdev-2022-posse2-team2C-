<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>個人情報登録完了</title>

    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <?php
    //日本時間を取得
    date_default_timezone_set('Asia/Tokyo');
    echo date('Y-m-d H:i:s');
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

        // $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        // $user = "root";
        // $password = "password";
        // $dbh_3 = new PDO($dsn, $user, $password);
        // $dbh_3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        // $sql_3 = $dbh_3->prepare('SELECT id FROM student_info 
        // WHERE student_family_name = :student_family_name, 
        // student_first_name = :student_family_name_ruby, 
        // student_family_name_ruby = :student_first_name,
        // student_first_name_ruby = :student_first_name_ruby,
        // email_address = :email_address,
        // phone_number = :phone_number,
        // name_of_the_univ = :name_of_the_univ,
        // faculty = :faculty,
        // department = :department,
        // school_year = :school_year,
        // the_year_of_grad = :the_year_of_grad,
        // ');
        // $sql_3->bindValue(":student_family_name",$student_family_name,PDO::PARAM_STR);
        // $sql_3->bindValue(":student_first_name",$student_first_name,PDO::PARAM_STR);
        // $sql_3->bindValue(":student_family_name_ruby",$student_family_name_ruby,PDO::PARAM_STR);
        // $sql_3->bindValue(":student_first_name_ruby",$student_first_name_ruby,PDO::PARAM_STR);
        // $sql_3->bindValue(":email_address",$email_address,PDO::PARAM_STR);
        // $sql_3->bindValue(":phone_number",$phone_number,PDO::PARAM_STR);
        // $sql_3->bindValue(":name_of_the_univ",$name_of_the_univ,PDO::PARAM_STR);
        // $sql_3->bindValue(":faculty",$faculty,PDO::PARAM_STR);
        // $sql_3->bindValue(":school_year",$school_year,PDO::PARAM_STR);
        // $sql_3->bindValue(":the_year_of_grad",$the_year_of_grad,PDO::PARAM_STR);
        // $sql_3->execute();

        // $dbh_3 = null;

        // $rec_3 = $sql_3->fetch(PDO::FETCH_ASSOC);


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