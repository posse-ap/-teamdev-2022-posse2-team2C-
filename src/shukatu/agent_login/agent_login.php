<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[AGENT]ログイン入力</title>
    <link rel="stylesheet" href="../style/sass/base/reset.css">
    <link rel="stylesheet" href="../style/css/agentPage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
</head>

<!-- このままじゃ動かない。agent_idで判別している。idじゃなくてそっちを使って判別したい。
スタッフはstaffとpasswordでやったと思う
→メールアドレスとpasswordで判別できるようにする
→文字変わっただけで中身変わってない。nameをcodeじゃなくてmail_addressにして。
→agent_infoはブザーからしかアクセスできない。 -->

<body class="body">

    <div class="agent-login">
        <div class="agent-login__craft-logo">CRAFT</div>
        <div class="input_boxes_container">
            <form action="agent_login_check.php" method="post" class="form_box">
                <span class="login_text">LOGIN</span>
                <div class="input_box_wrapper">
                    <span class="input_box_text">
                        mail address
                    </span>
                    <input type="text" name="account_email_address" class="input_box" placeholder="email address">
                </div>
                <div class="input_box_wrapper">
                    <span class="input_box_text">
                        password
                    </span>
                    <input type="password" name="pass" class="input_box" placeholder="password">
                </div>
                <input type="submit" value="OK" class="login_submit_btn">
                <a href="agent_login_forget.php" class="agent_login_forget_link">パスワードを忘れた方はこちら</a>
            </form>
        </div>
    </div>

</body>

</html>