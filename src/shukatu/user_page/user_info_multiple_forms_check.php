<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>エージェント購入チェック</title>
  <link rel="stylesheet" href="../style/sass/base/reset.css">
  <link rel="stylesheet" href="../style/css/userPage.css">
  <!-- ファビコン -->
  <link rel="icon" href="../style/img/favicon.ico" id="favicon">
</head>

<body>
  <?php include "../common/user_page_header.html" ?>
  <section class="user-favorites">
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

      print "<div class='user_info_multiple__wrapper'><h1 class='user_info_multiple__head'>【申請エージェント】</h1>";

      foreach ($cart as $key => $val) {

        $sql = "SELECT * FROM agent WHERE agent_id=?";
        $stmt = $dbh->prepare($sql);
        $data[0] = $val;
        $stmt->execute($data);

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        $agent_id = $rec['agent_id'];
        $company_name = $rec['company_name'];
        print "<div class='user_info_multiple__company'>";
        print "<div class='user_info_multiple__company_name'>・$company_name</div>"; ?>
        <img src="./agent_img/agent_img_<?php echo $agent_id; ?>.png" class="user_info_multiple__company_img">
      <?php
        print "</div>";
      }
      $dbh = null;
      ?>
      </div>
      <form action='user_info_multiple_forms_done.php' method='post' class="user_info_multiple_form">
        <span class="user_info_multiple_form__btn">
          <input type='button' onclick='history.back()' value='戻る' class="user_info_multiple_form__btn_back">
          <input type='submit' value='個人情報入力にすすむ' class="user_info_multiple_form__btn_go_form">
        </span>
      </form>

    <?php
    } catch (Exception $e) {
      print "只今障害が発生しております。<br><br>";
      print "<a href='../boozer_login/boozer_login.php'>ログイン画面へ</a>";
    }
    ?>
  </section>
  <footer>
    <img src="./img/boozer_logo.png" alt="" id="boozer_logo">
  </footer>
</body>

</html>