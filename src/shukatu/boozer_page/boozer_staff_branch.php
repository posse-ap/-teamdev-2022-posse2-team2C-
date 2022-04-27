<?php
//ログインチェック
session_start();
session_regenerate_id(true);
if(isset($_SESSION["login"]) === false) {
    print "ログインしていません。<br><br>";
    print "<a href='../boozer_login/boozer_login.php'>ログイン画面へ</a>";
    exit();
}
//それぞれのボタンを押したらlocation先に飛ぶ
//追加ぼたん
if(isset($_POST["add"]) === true) {
    header("Location:boozer_staff_add.php");
    exit();
}
//詳細ぼたん
if(isset($_POST["disp"]) === true) {
    //false=ボタンが押されていない=staffが選択されていない
    if(isset($_POST["code"]) === false) {
        header("Location:boozer_staff_ng.php");
        exit();
    } 
    $code = $_POST["code"];
    //ボタンがないからpostでcodeを送信できない
    //getを使って遷移先のurlに乗っける(staff codeだから見えても別に大丈夫)
    header("Location:boozer_staff_disp.php?code=".$code);
    exit();
}
//修正ぼたん
if(isset($_POST["edit"]) === true) {
    if(isset($_POST["code"]) === false) {
        header("Location:boozer_staff_ng.php");
        exit();
    } 
    $code = $_POST["code"];
    header("Location:boozer_staff_edit.php?code=".$code);
    exit();
}
//消去ぼたん
if(isset($_POST["delete"]) === true) {
    if(isset($_POST["code"]) === false) {
        header("Location:boozer_staff_ng.php");
        exit();
    } 
    $code = $_POST["code"];
    header("Location:boozer_staff_delete.php?code=".$code);
    exit();
}
?>