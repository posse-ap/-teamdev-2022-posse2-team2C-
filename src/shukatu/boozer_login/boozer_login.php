<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン入力</title>

    <link rel="stylesheet" href="../style/reset.css">
    <!-- <link  rel="stylesheet" href="../style/craft.css?<?php echo date('Ymd-Hi');?>"> -->
    <link  rel="stylesheet" href="../style/craft.css?<?php echo date('Ymd-Hi');?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">

</head>

<body class="body">

    <div class="container">
        <div class="craft_logo">CRAFT</div>
        <div class="input_boxes_container">
            <form action="boozer_login.check.php" method="post" class="form_box">
            <span class="login_text">LOGIN</span>
            <div class="input_box_wrapper">
                <span class="input_box_text">
                    staff code
                </span>
                <input type="text" name="code" class="input_box" placeholder="staff code" >
            </div>
            <div class="input_box_wrapper">
                <span class="input_box_text">
                    password
                </span>
                <input type="password" name="pass" class="input_box" placeholder="password">
            </div>
            <input type="submit" value="OK" class="login_submit_btn">
            </form>
        </div>
    </div>

</body>

</html>