<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/sass/base/reset.css">
    <link rel="stylesheet" href="../style/css/userPage.css">
    <link rel="icon" href="../style/img/favicon.ico" id="favicon">
  <script src="../js/header.js" defer></script>
  <script src="../js/user_Q&A.js" defer></script>
  <title>Q&A・お問合せページ</title>
</head>

<body>
  <?php include "../common/user_page_header.html" ?>
  <section id="Q-A">
    <h1 id="Q-A_title">Q&A</h1>
  </section>
  <?php
$name = $_POST["name"];
$email = $_POST["mail_address"];
$text = $_POST["question"];

$from = $email;
// この上のメルアドがログインしているエージェントのメルアドにしたい
$to = "onokan@gmail.com";
// この上のメルアドもログインしているスタッフの誰か（全部これだと小野に送られちゃう）にしたい
$subject =  'お問合せ';
$body = <<<EOD
    学生の{$name}さんからお問合せが来ています。
    <内容>
    {$text}

    至急対応してください。
    EOD;
$headers = "From: {$email}";
// 最終的なメール
// メールを送信する
mb_send_mail($to, $subject, $body, $headers); 
print("メールが送信されました。担当の方から該当のメールアドレスの方にお答えさせていただきます。少々お待ちください。");


$from = "onokan@gmail.com";
// この上のメルアドがログインしているエージェントのメルアドにしたい
$to = $email;
// この上のメルアドもログインしているスタッフの誰か（全部これだと小野に送られちゃう）にしたい
$subject =  '先ほどのお問合せに関しましてご案内';
$body = <<<EOD
    {$name}さんのお問合せを承りました。
    担当のものが回答いたします。もう少々お待ちください。
    EOD;
$headers = "From: onokan@gmail.com";
// 最終的なメール
// メールを送信する
mb_send_mail($to, $subject, $body, $headers); 
  ?>

</body>

</html>