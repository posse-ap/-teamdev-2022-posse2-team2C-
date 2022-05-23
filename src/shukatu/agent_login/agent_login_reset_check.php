<!-- <?php ?> -->


<!-- // try{
    

//     session_start();
    


//     if (empty($rec["account_email_address"]) === true) {
//         print "入力が間違っています。<br><br>";
//         print "<a href='agent_login.php'>戻る</a>";
//         exit();
//     } else {
        //一意のsessionIDを付与 ページ移動しても情報保持できる
        //テーブルに追加されるとかではなくて、サーバに保存される、ちょっと何言ってるかわかんない
        //login状態かどうかの判断＋名前とidも使える様にしておく

        // codeじゃなくてemailとかにすれば？
        // セッションセキュリティを調べる
        // session_start();
        // $_SESSION["login"] = 1;
        // $_SESSION["agent_id"] = $rec["agent_id"];
        // $_SESSION["account_email_address"] = $rec["account_email_address"];
        // $_SESSION["company_name"] = $rec["company_name"];
        // $_SESSION["pass"] = $pass;
        // //認証されたらこのページに飛ぶ
        // header("Location:agent_login_top.php");
        // exit();
    // }

    // $account_email_address = $_POST["account_email_address"];
    // $mail_send_time = $_POST["mail_send_time"];
    // $pass_reset_token = $_POST["pass_reset_token"];


    // $get_module = 
    // // // クエリからtokenを取得
    // // $passwordResetToken = filter_input(INPUT_GET, 'pass_reset_token');
    
    // // // tokenに合致するユーザーを取得
    // $sql = "SELECT * FROM shukatu.password_resets WHERE pass_reset_token = ?";
    // $stmt = $pdo->prepare($sql);
    // $stmt->bindValue(':pass_reset_token', $passwordResetToken, \PDO::PARAM_STR);
    // $stmt->execute();
    // $passwordResetuser = $stmt->fetch(\PDO::FETCH_OBJ);
    
    // // 合致するユーザーがいなければ無効なトークンなので、処理を中断

//     if (!$passwordResetuser) exit('無効なURLです');
    
//     // // 今回はtokenの有効期間を24時間とする
//     $tokenValidPeriod = (new \DateTime())->modify("-24 hour")->format('Y-m-d H:i:s');
    
//     // // パスワードの変更リクエストが24時間以上前の場合、有効期限切れとする
//     if ($passwordResetuser->token_sent_at < $tokenValidPeriod) {
//         exit('有効期限切れです');
//     };

//     // formに埋め込むcsrf tokenの生成
//     if (empty($_SESSION['_csrf_token'])) {
//         $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));x
//     };
    
//     // // パスワードリセットフォームを読み込む
//     // require_once './views/reset_form.php';


// }catch(Exception $e) {
//     echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
//     print "<a href='agent_login.html'>戻る</a>";
// }  



?> -->