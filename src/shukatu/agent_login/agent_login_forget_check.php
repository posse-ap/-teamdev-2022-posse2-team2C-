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
        $url = "https://shukatu/agent_login/agent_login_forget_check.php?passreset={$passResetToken}";
        $from = 'onokan@gmail.com';
        $to = $account_email_address;
        $subject =  'パスワードリセットのご案内';

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
        echo $rec["account_email_address"];
        echo "+";
        echo $mail_send_time;
        echo "+";
        echo $passResetToken;





        
        $account_email_address = htmlspecialchars($_POST["account_email_address"], ENT_QUOTES, "UTF-8");
        // $mail_send_time = $_POST["mail_send_time"] ENT_QUOTES, "UTF-8";

        //データをカラムに追加
        $sql = "INSERT INTO password_reset(account_email_address, mail_send_time,passResetToken) VALUES(?,?,?)";
        $stmt = $dbh->prepare($sql);
        $data[] = $rec["account_email_address"];
        $data[] = $mail_send_time;
        $data[] = $passResetToken;
        $stmt->execute($data);

        $dbh = null;

        
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