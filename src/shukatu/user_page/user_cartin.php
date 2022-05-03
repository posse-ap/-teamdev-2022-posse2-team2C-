<?php
//ログインチェックはしない

session_start();
// session_regenerate_id(true);

// if(isset($_SESSION["member_login"]) === false) {
//     print "ログインしてく下さい。<br><br>";
//     print "<a href='../member_login/member_login.html'>ログイン画面へ<br><br></a>";
//     print "<a href='shop_list.php'>TOP画面へ</a>";
//     exit();
// }
//     if(isset($_SESSION["member_login"]) === true) {
//     print "ようこそ";
//     print $_SESSION["member_name"];
//     print "様　";
//     print "<a href='../member_login/member_logout.php'>ログアウト</a>";
//     print "<br><br>";
// }

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お気に入りに追加</title>
    <link rel="stylesheet" href="../style/reset.css">
    <link rel="stylesheet" href="../style/craft.css?<?php echo date('Ymd-Hi'); ?>">
</head>

<body>

    <?php
    include "../common/user_page_header.html";
    //getでcodeの情報取ってくる    
    $agent_id = $_GET["agent_id"];

    // echo $code;


    // SESSION関数は、
    // session_start後に利用できるsession IDと結びついた特別な変数で、
    // 格納した値はログアウト（セッション切れ含む）しない限り消えることなく、
    // postやgetで値を渡さなくともページ移動で値が保持されるもの 

    //cartが空っぽじゃなかったらtrue

    if (isset($_SESSION["cart"]) === true) {
        //複数選択されたら配列を渡したいから一旦任意の変数に情報を移す
        $cart = $_SESSION["cart"];
        $quantity = $_SESSION["quantity"];

        //既にお気に入りに入ってたらだめ
        if (in_array($agent_id, $cart) === true) {
            print "すでにお気に入りにあります。<br><br>";
            print "<a href='user_agent_list.php'>エージェント一覧へ戻る</a>";
        }
    }
    //どっちもクリアしてたら
    if (empty($_SESSION["cart"]) === true or in_array($agent_id, $cart) === false) {
        $cart[] = $agent_id;
        $quantity[] = 1;
        $_SESSION["cart"] = $cart;
        $_SESSION["quantity"] = $quantity;

        print "お気に入りに追加しました。<br><br>";
        print "<a href='user_agent_list.php'>エージェント一覧へ戻る</a>";
    }

    ?>
    <br><br>
    <script src="../js/header.js"></script>
</body>

</html>