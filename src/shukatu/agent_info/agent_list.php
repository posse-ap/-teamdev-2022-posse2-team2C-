<?php
//ログインチェック
session_start();
session_regenerate_id(true);
if (isset($_SESSION["login"]) === false) {
    print "ログインしていません。<br><br>";
    print "<a href='../boozer_login/boozer_login.php'>ログイン画面へ</a>";
    exit();
} else {
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>エージェント一覧</title>
    <link rel="stylesheet" href="../style/reset.css">
    <link  rel="stylesheet" href="../style/craft.css?<?php echo date('Ymd-Hi');?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
</head>

<body>
    <?php include "../common/boozer_page_header.php"; ?>

    <?php
    try {
        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        $user = "root";
        $password = "password";
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //全レコード対象にcode,name,price取得
        $sql = "SELECT agent_id, company_name, company_staff, account_email_address, account_password, google_account, post_period_start, post_period_end FROM agent_account WHERE1";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        $dbh = null;

        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        $user = "root";
        $password = "password";
        $dbh_2 = new PDO($dsn, $user, $password);
        $dbh_2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //全レコード対象にcode,name,price取得
        $sql_2 = "SELECT agent_id, catchphrase, feature, region_code, prefecture_code, online_meeting, membership, pros, cons FROM agent WHERE1";
        $stmt_2 = $dbh_2->prepare($sql_2);
        $stmt_2->execute();

        $dbh_2 = null;
    ?>


       
            <div class="agent_list_right_page_container">
                <ul class="post_period_buttons">
                    <li class="post_period_button">全て</li>
                    <li class="post_period_button">掲載中</li>
                    <li class="post_period_button">未掲載</li>
                </ul>
                <div>
                    <form action='agent_branch.php' method='post'>
                    <div>
                    <input type='submit' name='disp' value='詳細・掲載状態確認'>
                    <input type='submit' name='edit' value='修正'>
                    <input type='submit' name='delete' value='削除'>
                </div>
                        <?php
                        while (true) {
                            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                            if ($rec === false) {
                                break;
                            }

                        ?>
                            <div class="agent_info_disp_btn_wrapper">
                                <div class="agent_info_wrapper">
                                    <?php print "<input type='radio' name='agent_id' value='" . $rec['agent_id'] . "'>"; ?>
                                    <div class="agent_info_text"><?php print $rec["company_name"]; ?></div>
                                    <div class="agent_info_text"><?php print $rec["company_staff"]; ?></div>
                                    <div class="agent_info_text"><?php print $rec["account_email_address"]; ?></div>
                                    <div class="agent_info_text"><?php print $rec["account_password"]; ?></div>
                                    <div class="agent_info_text"><?php print $rec["google_account"]; ?></div>
                                    <div class="agent_info_text"><?php print $rec["post_period_start"]; ?></div>
                                    <div class="agent_info_text"><?php print $rec["post_period_end"]; ?></div>
        
                                </div>
                                <!-- <div class="disp_btn">詳細 -->
                                
                                <!-- </div> -->
                            </div>
                        <?php
                        }
                        ?>
                    
                </div>
                </form>
            </div>
        </div>
    <?php

        //ずっとループ

        //  $rec_2 = $stmt_2 -> fetch(PDO::FETCH_ASSOC);
        //  if($rec_2 === false) {
        //      break;
        //  }
        //  //エージェントid
        //  print $rec_2["agent_id"]."<br>";
        //  //キャッチフレーズ
        //  print $rec_2["catchphrase"]."<br>";
        //  //特徴
        //  print $rec_2["feature"]."<br>";
        //  //地域code tableできたら繋げる
        //  print $rec_2["region_code"]."<br>";
        //  //県code
        //  print $rec_2["prefecture_code"]."<br>";
        //  //オンライン面談可否
        //  print $rec_2["online_meeting"]."<br>";
        //  print "<br>";
        //   //会員数
        //   print $rec_2["membership"]."<br>";
        //   print "<br>";
        //    //メリット
        //  print $rec_2["pros"]."<br>";
        //  print "<br>";
        //   //デメリット
        //   print $rec_2["cons"]."<br>";
        //   print "<br>";
    } catch (Exception $e) {
        echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
        print "<a href='../boozer_login/boozer_login.html'>ログイン画面へ</a>";
    }
    ?>
</body>

</html>