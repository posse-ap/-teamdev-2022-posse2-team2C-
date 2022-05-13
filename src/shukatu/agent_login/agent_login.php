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
    <link rel="icon" href="../style/img/favicon.ico" id="favicon">
</head>

<!-- このままじゃ動かない。agent_idで判別している。idじゃなくてそっちを使って判別したい。
スタッフはstaffとpasswordでやったと思う
→メールアドレスとpasswordで判別できるようにする
→文字変わっただけで中身変わってない。nameをcodeじゃなくてmail_addressにして。
→agent_infoはブザーからしかアクセスできない。 -->

<body class="body">

    <div class="agent-login">
        <div class="agent-login__craft-logo">CRAFT</div>
        <div class="agent-login__input-boxes">
            <form action="agent_login_check.php" method="post" class="agent-login__form_box">
                <span class="agent-login__login_text">LOGIN</span>
                <div class="agent-login__input-box">
                    <span class="agent-login__input-box_text">
                        mail address
                    </span>
                    <input type="text" name="account_email_address" class="agent-login__input-box_style" placeholder="email address">
                </div>
                <div class="agent-login__input-box">
                    <span class="agent-login__input-box_text">
                        password
                    </span>
                    <input type="password" name="pass" class="agent-login__input-box_style" placeholder="password">
                </div>
                <input type="submit" value="OK" class="agent-login__submit-btn">
                <a href="agent_login_forget.php" class="agent-login__forget-link">パスワードを忘れた方はこちら</a>
            </form>
        </div>
    </div>

</body>

</html>