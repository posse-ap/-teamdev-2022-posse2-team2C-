<?php
//ログインチェック 別にログインしてなくてもみれる
session_start();
session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ECサイトTOP</title>
<link rel="stylesheet" href="../style/reset.css">
<link  rel="stylesheet" href="../style/craft.css?<?php echo date('Ymd-Hi');?>">
</head>
    
<body>
    <!-- header -->
    <?php include "../common/user_page_header.html" ;

try{
    $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
    $user = "root";
    $password = "password";
    $dbh_2 = new PDO($dsn, $user, $password);
    $dbh_2 -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql_2 = "SELECT agent.agent_id, catchphrase, feature, region_code, prefecture_code, online_meeting, membership, pros, cons, company_name FROM agent INNER JOIN agent_account ON agent.id=agent_account.agent_id";
    $stmt_2 = $dbh_2 -> prepare($sql_2);
    $stmt_2 -> execute();
    
    $dbh_2 = null;
        
    print "エージェント一覧";
    print "<br><br>";
        
    while(true) {
        // $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
        // if($rec === false) {
        //     break;
        // }
        // $agent_id = $rec_2["agent_id"];
        //getでcodeをurlに載せる
       
        // if(empty($rec["image"]) === true) {
        //     $image = "";
        // } else {
        //     $image = "<img src='../product/image/".$rec['image']."'>";
        // }

        $rec_2 = $stmt_2 -> fetch(PDO::FETCH_ASSOC);
        if($rec_2 === false) {
            break;
        }
         $agent_id = $rec_2["agent_id"];
        print "<a href='user_cartin.php?agent_id=".$agent_id."'>♡</a><br>";
        //エージェントid
        print $rec_2["agent_id"]."<br>";
        print $rec_2["company_name"]."<br>";
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
         print "<a href='user_detail.php?agent_id=".$agent_id."'>";
        print "<div>詳しく見る</div>";
        print "</a>";
        
        print "<br>";
        print "<br><br>";
    }
    print "<br>";

    }
    catch(Exception $e) {
        print "只今障害が発生しております。<br><br>";
        echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
        print "<a href='../boozer_login/boozer_login.php'>ログイン画面へ</a>";
    }
    ?>
    <footer>
        <img src="./img/boozer_logo.png" alt="" id = "boozer_logo">
    </footer>

    <script src="../js/header.js"></script>
</body>
</html>