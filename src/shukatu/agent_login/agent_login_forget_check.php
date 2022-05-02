<?php
try{

    require_once("../common/common.php");

    $post = sanitize($_POST);  
    $account_email_address = $post["account_email_address"];

    $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
    $user = "root";
    $password = "password";
    $dbh = new PDO($dsn, $user, $password);
    $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ここはdbconnectみたいなのを作ってrrequireでやれば？→やった方がいいんかな？
    // パスワードの乱数化も別ファイルで作ってみたら？
    //codeとpasswordが一致する人を選択(nameカラムから)

    // ネーム以外にもとってこないといけないものがある気がする。他ファイル参照。selectで検索
    $sql = "SELECT account_email_address FROM agent_account WHERE account_email_address =?";
    $stmt = $dbh -> prepare($sql);
    $data[] = $account_email_address;
    $stmt -> execute($data);

    $dbh = null;
    
    $rec = $stmt -> fetch(PDO::FETCH_ASSOC);

    if(empty($rec["account_email_address"]) === true) {
        print "入力が間違っています。もう一度お試しください。<br><br>";
        print "<a href='agent_login_forget.php'>戻る</a>";
        exit();
    } else {
        //一意のsessionIDを付与 ページ移動しても情報保持できる
        //テーブルに追加されるとかではなくて、サーバに保存される、ちょっと何言ってるかわかんない
        //login状態かどうかの判断＋名前とidも使える様にしておく
    
        // codeじゃなくてemailとかにすれば？
        // セッションセキュリティを調べる


        // ランダムな数を生成
            
        // メールURLを作成

        // メールを送信する

        // 送信した時間を取得する





        session_start();
        $_SESSION["login"] = 1;
        $_SESSION["account_email_address"] = $rec["account_email_address"];
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