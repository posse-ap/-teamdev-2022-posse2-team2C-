<?php
//ログインチェック
session_start();
session_regenerate_id(true);
if(isset($_SESSION["login"]) === false) {
    print "ログインしていません。<br><br>";
    print "<a href='boozer_login.html'>ログイン画面へ</a>";
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
<title>エージェント一覧</title>
<link rel="stylesheet" href="../style.css">
</head>
    
<body>

<?php
try{
    
$dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
$user = "root";
$password = "password";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//全レコード対象にcode,name,price取得
$sql = "SELECT agent_id, company_name, company_staff, account_email_address, account_password, google_account, post_period_start, post_period_end FROM agent_account WHERE1";
$stmt = $dbh -> prepare($sql);
$stmt -> execute();
    
$dbh = null;

$dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
$user = "root";
$password = "password";
$dbh_2 = new PDO($dsn, $user, $password);
$dbh_2 -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//全レコード対象にcode,name,price取得
$sql_2 = "SELECT agent_id, catchphrase, feature, region_code, prefecture_code, online_meeting, membership, pros, cons FROM agent WHERE1";
$stmt_2 = $dbh_2 -> prepare($sql_2);
$stmt_2 -> execute();
    
$dbh_2 = null;
    
print "エージェント一覧<br><br>";
print "<form action='pro_branch.php' method='post'>";
    
//ずっとループ
while(true) {
    $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
    if($rec === false) {
        break;
    }
    print "<input type='radio' name='code' value='".$rec['agent_id']."'>";
    //会社名
    print $rec["company_name"]."<br>";
    //担当者名
    print $rec["company_staff"]."<br>";
    //アカウントメールアドレス
    print $rec["account_email_address"]."<br>";
    //アカウントパスワード
    print $rec["account_password"]."<br>";
    //google account
    print $rec["google_account"]."<br>";
    //掲載開始日
    print $rec["post_period_start"]."<br>";
    print "<br>";
     //掲載終了日
     print $rec["post_period_end"]."<br>";
     print "<br>";

     $rec_2 = $stmt_2 -> fetch(PDO::FETCH_ASSOC);
     if($rec_2 === false) {
         break;
     }
     //エージェントid
     print $rec_2["agent_id"]."<br>";
     //キャッチフレーズ
     print $rec_2["catchphrase"]."<br>";
     //特徴
     print $rec_2["feature"]."<br>";
     //地域code tableできたら繋げる
     print $rec_2["region_code"]."<br>";
     //県code
     print $rec_2["prefecture_code"]."<br>";
     //オンライン面談可否
     print $rec_2["online_meeting"]."<br>";
     print "<br>";
      //会員数
      print $rec_2["membership"]."<br>";
      print "<br>";
       //メリット
     print $rec_2["pros"]."<br>";
     print "<br>";
      //デメリット
      print $rec_2["cons"]."<br>";
      print "<br>";
}
print "<br>";
print "<input type='submit' name='disp' value='詳細'>";
print "<input type='submit' name='add' value='追加'>";
print "<input type='submit' name='edit' value='修正'>";
print "<input type='submit' name='delete' value='削除'>";
}
catch(Exception $e) {
    echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
    print "<a href='../boozer_login/login.html'>ログイン画面へ</a>";
}
?>
<br><br>
<a href="../boozer_login/boozer_login_top.php">管理画面TOPへ</a>
    
</body>
</html>