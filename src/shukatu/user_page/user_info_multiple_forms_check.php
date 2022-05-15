<?php

session_start();
// session_regenerate_id(true);

// if(isset($_SESSION["member_login"]) === false) {
//     print "ログインしてく下さい。<br><br>";
//     print "<a href='../member_login/member_login.html'>ログイン画面へ<br><br></a>";
//     print "<a href='shop_list.php'>TOP画面へ</a>";
// }
//     if(isset($_SESSION["member_login"]) === true) {
//     print "ようこそ";
//     print $_SESSION["member_name"];
//     print "様　";
//     print "<a href='../member_login/member_logout.php'>ログアウト</a>";
//     print "<br><br>";
//     }

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>エージェント購入チェック</title>
  <link rel="stylesheet" href="../style/sass/base/reset.css">
    <link rel="stylesheet" href="../style/css/userPage.css">
</head>

<body>
<?php include "../common/user_page_header.html" ?>
  <?php
  try {
    $cart = $_SESSION["cart"];
    $quantity = $_SESSION["quantity"];
    $max = count($cart);

    $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
    $user = "root";
    $password = "password";
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    print "<h1>【申請エージェント】<br></h1>";
     


        foreach ($cart as $key => $val) {

            $sql = "SELECT * FROM agent WHERE agent_id=?";
            $stmt = $dbh->prepare($sql);
            $data[0] = $val;
            $stmt->execute($data);

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);

            $agent_id = $rec['agent_id'];
            $company_name = $rec['company_name'];
            echo $company_name;
            
                }
        $dbh = null;
    
  ?>

    <form action='user_info_multiple_forms_done.php' method='post'>
      <input type='button' onclick='history.back()' value='戻る'>
      <input type='submit' value='個人情報入力にすすめ'>
    </form>

  <?php
  } catch (Exception $e) {
    print "只今障害が発生しております。<br><br>";
    print "<a href='../boozer_login/boozer_login.php'>ログイン画面へ</a>";
  }
  ?>

</body>

</html>