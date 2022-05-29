<?php
try {

    require_once("../common/common.php");

    $post = sanitize($_POST);

    $code = $post["code"];
    $pass = $post["pass"];

    //パスワード乱数化
    // $pass = md5($pass);

    $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
    $user = "root";
    $password = "password";
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //codeとpasswordが一致する人を選択(nameカラムから)
    $sql = "SELECT name FROM staff WHERE code=? AND password=?";
    $stmt = $dbh->prepare($sql);
    $data[] = $code;
    $data[] = $pass;
    $stmt->execute($data);

    $dbh = null;

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    //databaseに情報があるかどうかチェック
    if (empty($rec["name"]) === true) {
        print "入力が間違っています。<br><br>";
        print "<a href='boozer_login.php'>戻る</a>";
        exit();
    } else {
        //一意のsessionIDを付与 ページ移動しても情報保持できる
        //テーブルに追加されるとかではなくて、サーバに保存される、ちょっと何言ってるかわかんない
        //login状態かどうかの判断＋名前とidも使える様にしておく
        session_start();
        $_SESSION["login"] = 1;
        $_SESSION["name"] = $rec["name"];
        $_SESSION["code"] = $code;
        //認証されたらこのページに飛ぶ
        header("Location:../boozer_login/boozer_login_top.php");
        exit();
    }
} catch (Exception $e) {
    echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
    print "<a href='boozer_login.php'>戻る</a>";
}
