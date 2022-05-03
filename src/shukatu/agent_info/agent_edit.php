<?php
//ログインチェック
session_start();
session_regenerate_id(true);
if (isset($_SESSION["login"]) === false) {
    print "ログインしていません。<br><br>";
    print "<a href='boozer_login.php'>ログイン画面へ</a>";
    exit();
} else {
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>エージェント修正画面</title>
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
        //agent_branch.phpでurlに乗せたやつを取ってくる 
        $agent_id = $_GET["agent_id"];

        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        $user = "root";
        $password = "password";
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT agent_id, company_name, company_staff, account_email_address, account_password, google_account, post_period_start, post_period_end FROM agent_account WHERE agent_id=?";
        $stmt = $dbh->prepare($sql);
        $data[] = $agent_id;
        $stmt->execute($data);

        $dbh = null;

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
        $user = "root";
        $password = "password";
        $dbh_2 = new PDO($dsn, $user, $password);
        $dbh_2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //urlに乗ってきたcodeを元に識別
        $sql_2 = "SELECT * FROM agent WHERE agent_id=?";
        $stmt_2 = $dbh_2->prepare($sql_2);
        $data_2[] = $agent_id;
        $stmt_2->execute($data_2);

        $dbh_2 = null;

        $rec_2 = $stmt_2->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
        print "<a href='../boozer_login/boozer_login.php'>ログイン画面へ</a>";
    }
    ?>
        <div class="agent_list_right_page_container">
            <h1><?php print $rec["company_name"]; ?>の情報を修正します。</h1>
            <form action="agent_edit_check.php" method="post" enctype="multipart/form-data" width="100%">
                <div class="agent_reg_form_wrapper">
                    <div class="agent_account_reg_wrapper">
                        <h2 class="agent_reg_form_tittle">アカウント情報の登録</h2>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">エージェントid</span>
                            <input type="text" name="agent_id" value="<?php print $rec['agent_id']; ?>">
                        </div>
                        <div class="agent_reg_form_box">
                            <spa class="agent_reg_form_box_text">エージェント会社名</spa>
                            <input type="text" name="company_name" value="<?php print $rec['company_name']; ?>">
                        </div>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">エージェント担当者名</span>
                            <input type="text" name="company_staff" value="<?php print $rec['company_staff']; ?>">
                        </div>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">アカウントメールアドレス</span>
                            <input type="text" name="account_email_address" value="<?php print $rec['account_email_address']; ?>">
                        </div>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">アカウントパスワード</span>
                            <input type="text" name="account_password" value="<?php print $rec['account_password']; ?>">
                        </div>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">google account</span>
                            <input type="text" name="google_account" value="<?php print $rec['google_account']; ?>">
                        </div>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">掲載開始日</span>
                            <input type="date" name="post_period_start" value="<?php print $rec['post_period_start']; ?>">
                        </div>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">掲載終了日</span>
                            <input type="date" name="post_period_end" value="<?php print $rec['post_period_end']; ?>">
                        </div>
                    </div>
                    <div class="agent_info_reg_wrapper">
                        <h2 class="agent_reg_form_tittle">掲載情報の登録</h2>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">キャッチフレーズ</span>
                            <input type="text" name="catchphrase" value="<?php print $rec_2['catchphrase']; ?>">
                        </div>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">特徴</span>
                            <input type="text" name="feature" value="<?php print $rec_2['feature']; ?>">
                        </div>
                        <!-- <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">エリア指定</span>
                            <span>地域code</span>
                            <input type="text" name="region_code" value="<?php print $rec_2['region_code']; ?>">
                        </div>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">県code</span>
                            <input type="text" name="prefecture_code" value="<?php print $rec_2['prefecture_code']; ?>">
                        </div> -->
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">オンライン面談可否</span>
                            <input type="text" name="online_meeting" value="<?php print $rec_2['online_meeting']; ?>">
                        </div>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">会員数</span>
                            <input type="text" name="membership" value="<?php print $rec_2['membership']; ?>">
                        </div>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">メリット</span>
                            <input type="text" name="pros" value="<?php print $rec_2['pros']; ?>">
                        </div>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">デメリット</span>
                            <input type="text" name="cons" value="<?php print $rec_2['cons']; ?>">
                        </div>

                    </div>
                </div>
                <input type="hidden" name="agent_id" value="<?php print $rec['agent_id']; ?>">
                <input type="submit" value="OK" class="form_submit_btn">
            </form>
        </div>
    </div>
</body>

</html>