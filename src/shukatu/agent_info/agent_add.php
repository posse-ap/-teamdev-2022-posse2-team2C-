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
    <title>エージェント追加</title>
    <link rel="stylesheet" href="../style/reset.css">
    <link  rel="stylesheet" href="../style/craft.css?<?php echo date('Ymd-Hi');?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
</head>

<body>
    <?php include "../common/boozer_page_header.php"; ?>

    <div class="boozer_top_page_container">
        <div class="side_menu_container">
            <ul class="side_menu_wrapper">
                <li class="side_menu"><a href="../boozer_login/boozer_login_top.php" class="side_menu_text">ホーム</a></li>
                <li class="side_menu"><a href="../agent_info/agent_list.php" class="side_menu_text">エージェント一覧</a></li>
                <li class="side_menu"><a href="../agent_info/agent_add.php" class="side_menu_text">新規エージェント作成</a></li>
                <li class="side_menu"><a href="" class="side_menu_text">学生情報一覧</a></li>
                <li class="side_menu"><a href="../boozer_page/boozer_staff_list.php" class="side_menu_text">boozerスタッフ管理</a></li>
                <li class="side_menu"><a href="boozer_logout.php" class="side_menu_text">ログアウト</a></li>
            </ul>
        </div>
    
    <div class="agent_add_right_page_container">
    <form action="agent_add_check.php" method="post" enctype="multipart/form-data" width="100%">
                <div class="agent_reg_form_wrapper">
                    <div class="agent_account_reg_wrapper">
                        <h2 class="agent_reg_form_tittle">アカウント情報の登録</h2>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">エージェントid</span>
                            <input type="text" name="agent_id">
                        </div>
                        <div class="agent_reg_form_box">
                            <spa class="agent_reg_form_box_text">エージェント会社名</spa>
                            <input type="text" name="company_name">
                        </div>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">エージェント担当者名</span>
                            <input type="text" name="company_staff">
                        </div>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">アカウントメールアドレス</span>
                            <input type="text" name="account_email_address">
                        </div>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">アカウントパスワード</span>
                            <input type="text" name="account_password">
                        </div>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">google account</span>
                            <input type="text" name="google_account">
                        </div>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">掲載開始日</span>
                            <input type="date" name="post_period_start">
                        </div>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">掲載終了日</span>
                            <input type="date" name="post_period_end">
                        </div>
                    </div>
                    <div class="agent_info_reg_wrapper">
                        <h2 class="agent_reg_form_tittle">掲載情報の登録</h2>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">キャッチフレーズ</span>
                            <input type="text" name="catchphrase">
                        </div>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">特徴</span>
                            <input type="text" name="feature">
                        </div>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">エリア指定</span>
                            <span>地域code</span>
                            <input type="text" name="region_code">
                        </div>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">県code</span>
                            <input type="text" name="prefecture_code">
                        </div>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">オンライン面談可否</span>
                            <input type="text" name="online_meeting">
                        </div>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">会員数</span>
                            <input type="text" name="membership">
                        </div>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">メリット</span>
                            <input type="text" name="pros">
                        </div>
                        <div class="agent_reg_form_box">
                            <span class="agent_reg_form_box_text">デメリット</span>
                            <input type="text" name="cons">
                        </div>

                    </div>
                </div>
                
                <input type="submit" value="OK" class="form_submit_btn">
            </form>
    </div>
    </div>

</body>

</html>