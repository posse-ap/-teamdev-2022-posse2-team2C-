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
        mb_language("Japanese");
        mb_internal_encoding("UTF-8");
        $to = $account_email_address;
        $subject = "TEST";
        $message = "パスワード変更のためのURLをお送りします。こちらからパスワード変更を完了させてください。";
        $headers = "From: onokan@gmail.com";
        // 最終的なメール
        // メールを送信する
        mb_send_mail($to, $subject, $message, $headers); 

        // 送信した時間を取得する


        // 二つ目のパターン
         // 以下、mail関数でパスワードリセット用メールを送信
    // mb_language("Japanese");
    // mb_internal_encoding("UTF-8");

    // // URLはご自身の環境に合わせてください
    // $url = "http://shukatu/agent_login/agent_login_forget_done.php?token={$passwordResetToken}";

    // $subject =  'パスワードリセット用URLをお送りします';

    // $body = <<<EOD
    //     24時間以内に下記URLへアクセスし、パスワードの変更を完了してください。
    //     {$url}
    //     EOD;

    // // Fromはご自身の環境に合わせてください
    // $headers = "From : onokan@gmail.com\n";
    
    // // text/htmlを指定し、html形式で送ることも可能
    // $headers .= "Content-Type : text/plain";

    // // mb_send_mailは成功したらtrue、失敗したらfalseを返す
    // $isSent = mb_send_mail($email, $subject, $body, $headers);

    // if (!$isSent) throw new \Exception('メール送信に失敗しました。');

    // // メール送信まで成功したら、password_resetsテーブルへの変更を確定
    // $pdo->commit();





        session_start();
        $_SESSION["login"] = 1;
        $_SESSION["account_email_address"] = $rec["account_email_address"];
        //認証されたらこのページに飛ぶ
        header("Location:agent_login_forget_done.php");
        exit();
    }

}
catch(Exception $e) {
    echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
    print "<a href='agent_login.html'>戻る</a>";
}



?>