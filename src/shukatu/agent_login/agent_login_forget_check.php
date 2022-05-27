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

    // PDOは一回でオッケー

    // ネーム以外にもとってこないといけないものがある気がする。他ファイル参照。selectで検索
    $sql = "SELECT account_email_address FROM agent_account WHERE account_email_address =?";
    $stmt = $dbh -> prepare($sql);
    $data[] = $account_email_address;
    $stmt -> execute($data);

    // $dbh = null;
    
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
        // mb_language("Japanese");
        // mb_internal_encoding("UTF-8");
        $passResetToken = md5(uniqid(rand(),true));
        $url = "http://localhost:80/shukatu/agent_login/agent_login_reset_check.php?passreset={$passResetToken}";
        $from = 'onokan@gmail.com';
        $to = $account_email_address;
        $subject =  'パスワードリセットのご案内';
        
        ?>
        <form method="POST" action="/agent_login_reset_check.php">
        <input type="hidden"  value="<?=$passResetToken?>">
        </form><?php
        $body = <<<EOD
            24時間以内に下記URLへアクセスし、パスワードの変更を完了してください。
            {$url}
            EOD;

        $headers = "From: onokan@gmail.com";
        // 最終的なメール
        // メールを送信する
        mb_send_mail($to, $subject, $body, $headers); 
        $ret = mb_send_mail($to, $subject, $body, "From: {$from} \r\n");
        print("メールが送信されました。");
        date_default_timezone_set('Asia/Tokyo');
        $mail_send_time = date("Y/m/d H:i:s");

        $account_email_address = htmlspecialchars($_POST["account_email_address"], ENT_QUOTES, "UTF-8");
        // $mail_send_time = $_POST["mail_send_time"] ENT_QUOTES, "UTF-8";

        // $dataってaccount_email_address情報の取得に使ってたので違う変数名にしましょう
        $password_reset_data = [];
        //データをカラムに追加

        // password_reset -> password_resets テーブル名間違ってます
        $sql = "INSERT INTO password_resets(account_email_address, mail_send_time, pass_reset_token) VALUES(?,?,?)";
        $stmt = $dbh->prepare($sql);
        $password_reset_data[] = $rec["account_email_address"];
        $password_reset_data[] = $mail_send_time;
        $password_reset_data[] = $passResetToken;     
        // これがエラーを吐いている↓↓
        $stmt->execute($password_reset_data);

        echo $rec["account_email_address"];
        echo "+";
        echo $mail_send_time;
        echo "+";
        echo $passResetToken;

        // if(!empty($rec["account_email_address"]) === true){
        //     $sql = "INSERT INTO password_reset values()";
        //     $stmt = $dbh -> prepare($sql);
        //     $data[] = $account_email_address;
        //     $stmt -> execute($data);
            
                // }


                
        // session_start();
        // $_SESSION["login"] = 1;
        // $_SESSION["account_email_address"] = $rec["account_email_address"];
        // //認証されたらこのページに飛ぶ
        // header("Location:agent_login_reset_form.php");

        exit();
    }

}
catch(Exception $e) {
    echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
    print "<a href='agent_login.html'>戻る</a>";
}



?>