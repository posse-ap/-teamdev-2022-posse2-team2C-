<?php
//ログインチェック
session_start();
session_regenerate_id(true);
if (isset($_SESSION["login"]) === false) {
    print "ログインしていません。<br><br>";
    print "<a href='boozer_login.php'>ログイン画面へ</a>";
    exit();
} else {
    print $_SESSION["name"] . "さんログイン中";
    print "<br><br>";
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>エージェント内容変更チェック</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <?php

    require_once("../common/common.php");
    //いつものやつ  
    $post = sanitize($_POST);
    $agent_id = $post["agent_id"];
    $company_name = $post["company_name"];
    $company_staff = $post["company_staff"];
    $account_email_address = $post["account_email_address"];
    $account_password = $post["account_password"];
    $google_account = $post["google_account"];
    $post_period_start = $post["post_period_start"];
    $post_period_end = $post["post_period_end"];

    $catchphrase = $post["catchphrase"];
    $feature = $post["feature"];
    $region_code = $post["region_code"];
    $prefecture_code = $post["prefecture_code"];
    $online_meeting = $post["online_meeting"];
    $membership = $post["membership"];
    $pros = $post["pros"];
    $cons = $post["cons"];

    // if(empty($name) === true) {
    //     print "エージェント名が入力されていません。<br><br>";
    // } else {
    //     print $name;
    //     print "<br><br>";
    // }
    // //半角ですか？？    
    // if(preg_match("/\A[0-9]+\z/", $price) === 0) {
    //     print "正しい値を入力してください。<br><br>";
    // } else {
    //     print $price."円";
    //     print "<br><br>";
    // }

    // if($image["size"] > 0) {
    //     if($image["size"] > 1000000) {
    //         print "ファイルのサイズが大きすぎます。<br><br>";
    //     } else {
    //         move_uploaded_file($image["tmp_name"],"./image/".$image["name"]);
    //         print "<img src='./image/".$image['name']."'>";
    //         print "<br><br>";
    //     }
    // }
    // if($image["name"] === "") {if($old_image != "") {print "<img src='./image/".$old_image."'>";}}

    // if(empty($comments) === true) {
    //     print "詳細が入力されていません。";
    //     print "<br><br>";
    // } 
    // if(mb_strlen($comments) > 100) {
    //     print "文字数は100文字が上限です。";
    //     print "<br><br>";
    // } else {
    //     print $comments;
    //     print "<br><br>";
    // }

    //どれか一個でもだめだったら無理ぽ   
    if (empty($agent_id) === true or empty($company_name) === true) {
        print "<form>";
        print "<input type='button' onclick='history.back()' value='戻る'>";
        print "</form>";
    } else {
        print $company_name;
        echo "<br><br>";
        print "上記エージェントを修正しますか？<br><br>";
        print "<form action='agent_edit_done.php' method='post'>";
        print "<input type='hidden' name='agent_id' value='" . $agent_id . "'>";
        print "<input type='hidden' name='company_name' value='" . $company_name . "'>";
        print "<input type='hidden' name='company_staff' value='" . $company_staff . "'>";
        print "<input type='hidden' name='account_email_address' value='" . $account_email_address . "'>";
        print "<input type='hidden' name='account_password' value='" . $account_password . "'>";
        print "<input type='hidden' name='google_account' value='" . $google_account . "'>";
        print "<input type='hidden' name='post_period_start' value='" . $post_period_start . "'>" . "<br><br>";
        print "<input type='hidden' name='post_period_end' value='" . $post_period_end . "'>" . "<br><br>";


        print "<input type='hidden' name='catchphrase' value='" . $catchphrase . "'>";
        print "<input type='hidden' name='feature' value='" . $feature . "'>";
        print "<input type='hidden' name='region_code' value='" . $region_code . "'>";
        print "<input type='hidden' name='prefecture_code' value='" . $prefecture_code . "'>";
        print "<input type='hidden' name='online_meeting' value='" . $online_meeting . "'>";
        print "<input type='hidden' name='membership' value='" . $membership . "'>";
        print "<input type='hidden' name='pros' value='" . $pros . "'>";
        print "<input type='hidden' name='cons' value='" . $cons . "'>";
        print "<input type='button' onclick='history.back()' value='戻る'>";
        print "<input type='submit' value='OK'>";
        print "</form>";
    }
    ?>
</body>

</html>