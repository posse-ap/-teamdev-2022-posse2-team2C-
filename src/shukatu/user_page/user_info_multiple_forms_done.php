<?php session_start();

 $cart = $_SESSION["cart"];
 $quantity = $_SESSION["quantity"];
 $max = count($cart);

 $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
    $user = "root";
    $password = "password";
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>個人情報入力ページ</title>
    <link rel="stylesheet" href="../style/sass/base/reset.css">
    <link rel="stylesheet" href="../style/css/userPage.css">
    <!-- ファビコン -->
    <link rel="icon" href="../style/img/favicon.ico" id="favicon">
</head>

<body>

    <h1>個人情報入力</h1>

    <form action="../student_info/multiple_apply_student_info_db_check.php" method="post">

    <?php
       foreach ($cart as $key => $val) {

        $sql = "SELECT * FROM agent WHERE agent_id=?";
        $stmt = $dbh->prepare($sql);
        $data[0] = $val;
        $stmt->execute($data);

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        $agent_id[] = $rec["agent_id"];
        ?>
<!-- 後でtypeはhiddenに -->
        エージェントid
        <input type="text" name="agent_id_<?php echo $rec['agent_id'];?>" value="<?php  echo $rec['agent_id'];?>">
        <?php
    }
    ?>
        
        <div>
            <span>お名前</span>
            <input type="text" name="student_family_name">
            <input type="text" name="student_first_name">
        </div>
        <div>
            <span>ふりがな</span>
            <input type="text" name="student_family_name_ruby">
            <input type="text" name="student_first_name_ruby">
        </div>
        <div>
            <span>メールアドレス</span>
            <input type="text" name="email_address">
        </div>
        <div>
            <span>電話番号</span>
            <input type="text" name="phone_number">
        </div>
        <div>
            <span>大学名</span>
            <input type="text" name="name_of_the_univ">
        </div>
        <div>
            <span>学部</span>
            <input type="text" name="faculty">
        </div>
        <div>
            <span>学科</span>
            <input type="text" name="department">
        </div>
        <div>
            <span>学年</span>
            <input type="text" name="school_year">
        </div>
        <div>
            <span>卒年</span>
            <input type="text" name="the_year_of_grad">
        </div>
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
        <br><br>

    </form>
    <br><br>

</body>

</html>