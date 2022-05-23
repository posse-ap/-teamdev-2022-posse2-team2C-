<?php
session_start(); ?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/sass/base/reset.css">
    <link rel="stylesheet" href="../style/css/userPage.css">
</head>

<body>
    <?php include "../common/user_page_header.html"; ?>
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

    for ($i = 0; $i < $max; $i++) {
        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        $user = "root";
        $password = "password";
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $dbh->prepare("INSERT INTO student_info (student_family_name, student_first_name, student_family_name_ruby, student_first_name_ruby, email_address, phone_number, name_of_the_univ, faculty, department, school_year, the_year_of_grad ,form_send_time) VALUES (:student_family_name, :student_first_name, :student_family_name_ruby, :student_first_name_ruby, :email_address, :phone_number, :name_of_the_univ, :faculty, :department, :school_year, :the_year_of_grad, :form_send_time)");
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

        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        $user = "root";
        $password = "password";
        $dbh_2 = new PDO($dsn, $user, $password);
        $dbh_2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt_2 = $dbh_2->prepare("INSERT INTO student_agent_connection_table (agent_id) VALUES (:agent_id)");
        $stmt_2->bindParam(':agent_id', $val, PDO::PARAM_STR);
        $stmt_2->execute();

        $dbh_2 = null;
    }
    print "<div class='done_message'>登録完了しました！</div>
    <div class='done_message_text'>申請が完了しました。<br>
    ご入力いただいた情報に従って各エージェント企業担当者より追ってご連絡差し上げます。
    ご登録いただいたメールアドレスへのメールをご確認ください。</div>
    ";
    print "<a href='../user_page/user_agent_list.php' class='backToTop'>トップへ戻る</a>";
} catch (Exception $e) {
    print "只今障害が発生しております。<br><br>";
    echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
    print "<a href='../boozer_login/boozer_login.php'>ログイン画面へ</a>";
}
