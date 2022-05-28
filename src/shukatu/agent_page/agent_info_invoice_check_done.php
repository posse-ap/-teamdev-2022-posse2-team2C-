<?php
try {
    // require_once("../common/common.php");

    //     // //agent_branch.phpでurlに乗せたやつを取ってくる 
    //     // $post = sanitize($_POST);
    //     // $account_email_address = $post["account_email_address"];
    
    //     $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
    //     $user = "root";
    //     $password = "password";
    //     $dbh = new PDO($dsn, $user, $password);
    //     $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //     // ここはdbconnectみたいなのを作ってrrequireでやれば？→やった方がいいんかな？
    //     // パスワードの乱数化も別ファイルで作ってみたら？
    //     //codeとpasswordが一致する人を選択(nameカラムから)
    
    //     // PDOは一回でオッケー
    
    //     // ネーム以外にもとってこないといけないものがある気がする。他ファイル参照。selectで検索
    //     $sql = "SELECT account_email_address FROM agent_account WHERE account_email_address =?";
    //     $stmt = $dbh -> prepare($sql);
    //     $data[] = $account_email_address;
    //     $stmt -> execute($data);
    
    } catch (Exception $e) {
        echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
        print "<a href='../boozer_login/boozer_login.php'>ログイン画面へ</a>";
    }
    ?>
    
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[agent]請求完了画面</title>
    <link rel="stylesheet" href="../style/sass/base/reset.css">
    <link rel="stylesheet" href="../style/css/agentPage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
</head>
<body>

<?php include "../common/agent_page_header.php";?>
<div class="agent-page__right-page-container">
    <!-- ブザーへの申請メール -->



<?php
$invoice_cost = "5";
$agent = "irodas";
// これは前のinvoice.phpで計算した$i＊1000の数値を出せるようにしたい。
$from = 'onokan@@icloud.com';
// この上のメルアドがログインしているエージェントのメルアドにしたい
$to = "onokan@gmail.com";
$subject =  '学生情報による請求';
$body = <<<EOD
    {$agent}からの請求金額は {$invoice_cost}円です。
    EOD;
$headers = "From: onokan@gmail.com";
// 最終的なメール
// メールを送信する
mb_send_mail($to, $subject, $body, $headers); 
$ret = mb_send_mail($to, $subject, $body, "From: {$from} \r\n");
print("メールが送信されました。確認メールも送付しております。ご確認ください。");
?>



<!-- ブザーからの確認メール -->
<?php
$invoice_cost = "4";
$agent = "irodas";
// これは前のinvoice.phpで計算した$i＊1000の数値を出せるようにしたい。

$from = "onokan@gmail.com";

$to = 'onokan@@icloud.com';
// この上のメルアドがログインしているエージェントのメルアドにしたい
$subject =  '学生情報による請求（確認メール）';
$body = <<<EOD
    {$agent}様からの請求金額は {$invoice_cost}円です。承りました。後ほどお支払いいたします。
    EOD;
$headers = "From: onokan@gmail.com";
// 最終的なメール
// メールを送信する
mb_send_mail($to, $subject, $body, $headers); 
$ret = mb_send_mail($to, $subject, $body, "From: {$from} \r\n");
// print("メールが送信されました。確認メールも送付しております。ご確認ください。");
?>

    <!-- <p>請求完了しました。メールをご確認ください。</p> -->

<!-- やりたいこと -->
<!-- 正しいテーブルからお問合せしている学生の数を数える -->
<!-- その人数を出す -->
<!-- 請求ボタンを押すと請求文面がブザーに送信 -->
<!-- 確認メールもエージェント側に送信 -->
<!-- ブザー側はメールでその通知を受け取る -->

</div>

</html>

</body>
</html>