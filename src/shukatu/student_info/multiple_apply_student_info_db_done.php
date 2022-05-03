<?php session_start();
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


    $cart = $_SESSION["cart"];
    $quantity = $_SESSION["quantity"];
    $max = count($cart);

    $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
    $user = "root";
    $password = "password";
    $dbh_3 = new PDO($dsn, $user, $password);
    $dbh_3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    foreach ($cart as $key => $val) {
        echo $val; 
            
        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        $user = "root";
        $password = "password";
        $dbh_2 = new PDO($dsn, $user, $password);
        $dbh_2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql_2 = "INSERT INTO student_agent_connection_table(agent_id) VALUES(?)";
        $stmt_2 = $dbh_2->prepare($sql_2);
        $data_2[] = $val;
        $stmt_2->execute($data_2);

        $dbh_2 = null;
        
        // echo $agent_id;
         }
        // }
        
    

   


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

