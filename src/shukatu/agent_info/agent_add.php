<?php
//ログインチェック
session_start();
session_regenerate_id(true);
if(isset($_SESSION["login"]) === false) {
    print "ログインしていません。<br><br>";
    print "<a href='../boozer_login/boozer_login.html'>ログイン画面へ</a>";
    exit();
} else {
    print $_SESSION["name"]."さんログイン中";
    print "<br><br>";
}
?>
 
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>エージェント追加</title>
<link rel="stylesheet" href="../style.css">
</head>
    
<body>

<form action="agent_add_check.php" method="post" enctype="multipart/form-data">
エージェント追加<br><br>
<?php 
require_once("../common/common.php");
?>
<!-- カテゴリー<br> -->
<!-- common.phpでエージェントのpulldownの関数生成してる -->
<?php
//  print pulldown_cate();
 ?>
 アカウント情報の登録<br>
エージェントid<br>
<input type="text" name="agent_id">
<br><br>
エージェント会社名<br>
<input type="text" name="company_name">
<br><br>
エージェント会社スタッフ名<br>
<input type="text" name="company_staff">
<br><br>
アカウントのメールアドレス<br>
<input type="text" name="account_email_address">
<br><br>
アカウントのパスワード<br>
<input type="text" name="account_password">
<br><br>
google_account<br>
<input type="text" name="google_account">
<br><br>
掲載開始日<br>
<input type="text" name="post_period_start">
<br><br>
掲載終了日<br>
<input type="text" name="post_period_end">
<br><br><br><br>
掲載情報の登録<br>
エージェントid（上のagent_idと同じだから入力なし）<br>
<!-- <input type="text" name="agent_id" value=""> -->
<br><br>
キャッチフレーズ<br>
<input type="text" name="catchphrase">
<br><br>
特徴<br>
<input type="text" name="feature">
<br><br>
エリア<br>
地域code<br>
<input type="text" name="region_code">
<br><br>
県code<br>
<input type="text" name="prefecture_code">
<br><br>
オンライン面談可否<br>
<input type="text" name="online_meeting">
<br><br>
会員数<br>
<input type="text" name="membership">
<br><br>
メリット<br>
<input type="text" name="pros">
<br><br>
デメリット<br>
<input type="text" name="cons">
<br><br>

<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>    
    
</body>
</html>