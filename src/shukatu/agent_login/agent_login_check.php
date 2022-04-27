<?php
try {

require_once("../common/common.php");

//入力された情報をpostで取得（クロスサイトスクリプティング防止）
$account_email_address = htmlspecialchars($_POST["account_email_address"], ENT_QUOTES, "UTF-8");
// 入力された情報が変なものだったとき用に入力されたものを一旦意味のない文字列に変換する
$pass = htmlspecialchars($_POST["pass"], ENT_QUOTES, "UTF-8");

//パスワード乱数化
$pass = md5($pass);
    
$dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
$user = "root";
$password = "password";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// ここはdbconnectみたいなのを作ってrrequireでやれば？→やった方がいいんかな？
// パスワードの乱数化も別ファイルで作ってみたら？
//codeとpasswordが一致する人を選択(nameカラムから)

// ネーム以外にもとってこないといけないものがある気がする。他ファイル参照。selectで検索
$sql = "SELECT account_email_address FROM agent_account WHERE account_email_address =? AND account_password=?";
$stmt = $dbh -> prepare($sql);
$data[] = $account_email_address;
$data[] = $pass;
$stmt -> execute($data);
    // 同じメールアドレスだとどうするの？
// name→account_email_address
$dbh = null;
    
$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
// テーブルで撮ってきたものをここで吐いている


    
//databaseに情報があるかどうかチェック
if(empty($rec["account_email_address"]) === true) {
    print "入力が間違っています。<br><br>";
    print "<a href='agent_login.html'>戻る</a>";
    exit();
} else {
    //一意のsessionIDを付与 ページ移動しても情報保持できる
    //テーブルに追加されるとかではなくて、サーバに保存される、ちょっと何言ってるかわかんない
    //login状態かどうかの判断＋名前とidも使える様にしておく

    // codeじゃなくてemailとかにすれば？
    // セッションセキュリティを調べる
    session_start();
    $_SESSION["login"] = 1;
    $_SESSION["account_email_address"] = $rec["account_email_address"];
    $_SESSION["code"] = $code;
    //認証されたらこのページに飛ぶ
    header("Location:agent_login_top.php");
    exit();
}
}
catch(Exception $e) {
    echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
    print "<a href='agent_login.html'>戻る</a>";
}
?>

