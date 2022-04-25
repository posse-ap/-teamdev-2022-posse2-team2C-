<?php
// ちゃんとログインできてるか確認
session_start();
// セッションハイジャック防止（ページ毎にsession idをランダムに変更）
session_regenerate_id(true);
if(isset($_SESSION["login"]) === false) {
    print "パスワードの再設定が必要となります。。<br><br>";
    print "恐れ入りますが、登録されたメールアドレスをご入力いただき、受信されたメールの案内に従ってパスワードの再設定をお願いいたします。<br><br>";
    print "登録しているメールアドレス ";?>
    <form action=agent_login_check.php method=post>
    <input type="text">
    </form>
<?php
    exit();
} else {
    print "<h1>エージェント用管理画面TOP</h1><br>" . $_SESSION["name"]."様ログイン中";
    print "<br>";
}


?>




