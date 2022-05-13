<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[BOOZER]ログイン入力</title>
    <link rel="stylesheet" href="../style/sass/base/reset.css">
    <link rel="stylesheet" href="../style/css/boozerPage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
    <link rel="icon" href="../style/img/favicon.ico" id="favicon">

</head>

<body class="body">

    <div class="boozer-login">
        <div class="boozer-login__craft-logo">CRAFT for boozer</div>
        <div class="boozer-login__input-boxes">
            <form action="boozer_login.check.php" method="post" class="boozer-login__form_box">
            <span class="boozer-login__login_text">LOGIN</span>
            <div class="boozer-login__input-box">
                <span class="boozer-login__input-box_text">
                    staff code
                </span>
                <input type="text" name="code" class="agent-login__input-box_style" placeholder="staff code" >
            </div>
            <div class="boozer-login__input-box">
                <span class="boozer-login__input-box_text">
                    password
                </span>
                <input type="password" name="pass" class="agent-login__input-box_style" placeholder="password">
            </div>
            <input type="submit" value="OK" class="boozer-login__submit-btn">
            </form>
        </div>
    </div>

</body>

</html>