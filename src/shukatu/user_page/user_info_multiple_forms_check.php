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
<<<<<<< HEAD
  <?php include "../common/user_page_header.html" ?>
  <section class="user-favorites">
=======
  <section class="whole-wrapper">
    <div class="whole-wrapper__background"></div>
    <?php include "../common/user_page_header.html" ?>
    <section class="user-favorites">
>>>>>>> 00f3a442a0c7f174ab43c7b34e980b2d49a07054
    <?php
    try {
      $cart = $_SESSION["cart"];
      $quantity = $_SESSION["quantity"];
      $max = count($cart);
<<<<<<< HEAD

=======
  
>>>>>>> 00f3a442a0c7f174ab43c7b34e980b2d49a07054
      $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
      $user = "root";
      $password = "password";
      $dbh = new PDO($dsn, $user, $password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
<<<<<<< HEAD

      print "<div class='user_info_multiple__wrapper'><h1 class='user_info_multiple__head'>【申請エージェント】</h1>";

      foreach ($cart as $key => $val) {

=======
  
      print "<div class='user_info_multiple__wrapper'><h1 class='user_info_multiple__head'>【申請エージェント】</h1>";
  
      foreach ($cart as $key => $val) {
  
>>>>>>> 00f3a442a0c7f174ab43c7b34e980b2d49a07054
        $sql = "SELECT * FROM agent WHERE agent_id=?";
        $stmt = $dbh->prepare($sql);
        $data[0] = $val;
        $stmt->execute($data);
<<<<<<< HEAD

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

=======
  
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  
>>>>>>> 00f3a442a0c7f174ab43c7b34e980b2d49a07054
        $agent_id = $rec['agent_id'];
        $company_name = $rec['company_name'];
        print "<div class='user_info_multiple__company'>";
        print "<div class='user_info_multiple__company_name'>・$company_name</div>"; ?>
<<<<<<< HEAD
        <img src="./agent_img/agent_img_<?php echo $agent_id; ?>.png" class="user_info_multiple__company_img">
=======
  
        <img src="./agent_img/agent_img_<?php echo $agent_id; ?>.png" class="user_info_multiple__company_img">
  
>>>>>>> 00f3a442a0c7f174ab43c7b34e980b2d49a07054
      <?php
        print "</div>";
      }
      $dbh = null;
<<<<<<< HEAD
      ?>
=======
  
      ?>
  
>>>>>>> 00f3a442a0c7f174ab43c7b34e980b2d49a07054
      </div>
      <form action='user_info_multiple_forms_done.php' method='post' class="user_info_multiple_form">
        <span class="user_info_multiple_form__btn">
          <input type='button' onclick='history.back()' value='戻る' class="user_info_multiple_form__btn_back">
          <input type='submit' value='個人情報入力にすすむ' class="user_info_multiple_form__btn_go_form">
        </span>
      </form>
<<<<<<< HEAD

=======
  
>>>>>>> 00f3a442a0c7f174ab43c7b34e980b2d49a07054
    <?php
    } catch (Exception $e) {
      print "只今障害が発生しております。<br><br>";
      print "<a href='../boozer_login/boozer_login.php'>ログイン画面へ</a>";
    }
    ?>
<<<<<<< HEAD
=======
    </section>
    <footer>
      <img src="./img/boozer_logo.png" alt="" id="boozer_logo">
    </footer>
>>>>>>> 00f3a442a0c7f174ab43c7b34e980b2d49a07054
  </section>
</body>

</html>