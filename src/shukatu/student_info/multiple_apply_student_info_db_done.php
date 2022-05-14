<?php 
session_start();?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>申請が完了しましたよ！！！</h1>
    <a href="../user_page/user_agent_list.php">エージェント一覧に戻る</a>
</body>
</html>

<?php 
 $cart = $_SESSION["cart"];
 $quantity = $_SESSION["quantity"];
 $max = count($cart);
//  echo $max;

try {
    require_once("../common/common.php");

    $post = sanitize($_POST);

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
 


    $cart = $_SESSION["cart"];
    $quantity = $_SESSION["quantity"];
    $max = count($cart);

    for($i = 0; $i < $max; $i++) {
        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        $user = "root";
        $password = "password";
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
        $stmt= $dbh -> prepare("INSERT INTO student_info (student_family_name, student_first_name, student_family_name_ruby, student_first_name_ruby, email_address, phone_number, name_of_the_univ, faculty, department, school_year, the_year_of_grad ,form_send_time) VALUES (:student_family_name, :student_first_name, :student_family_name_ruby, :student_first_name_ruby, :email_address, :phone_number, :name_of_the_univ, :faculty, :department, :school_year, :the_year_of_grad, :form_send_time)");
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

    }



    foreach ($cart as $key => $val) {


        echo $val;

        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        $user = "root";
        $password = "password";
        $dbh_2 = new PDO($dsn, $user, $password);
        $dbh_2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt_2 = $dbh_2 -> prepare("INSERT INTO student_agent_connection_table (agent_id) VALUES (:agent_id)");
        $stmt_2->bindParam(':agent_id', $val, PDO::PARAM_STR);
        $stmt_2->execute();

        $dbh_2 = null;

        }


} catch (Exception $e) {
    print "只今障害が発生しております。<br><br>";
    echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
    print "<a href='../boozer_login/boozer_login.php'>ログイン画面へ</a>";
}



//  $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
//  $user = "root";
//  $password = "password";
//  $dbh = new PDO($dsn, $user, $password);
//  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//  foreach ($cart as $key => $val) {

// echo $val;
// $sql = "SELECT * FROM agent WHERE agent_id=?";
// $stmt = $dbh->prepare($sql);
// $data[0] = $val;
// $stmt->execute($data);

// $rec = $stmt->fetch(PDO::FETCH_ASSOC);

// $agent_id = $rec['agent_id'];
// $company_name = $rec['company_name'];
// echo $agent_id;

// }

