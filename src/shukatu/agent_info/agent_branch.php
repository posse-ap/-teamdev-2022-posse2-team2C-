<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION["login"]) === false) {
    print "ログインしていません。<br><br>";
    print "<a href='staff_login.html'>ログイン画面へ</a>";
    exit();
}

if(isset($_POST["add"]) === true) {
    header("Location:agent_add.php");
    exit();
}

if(isset($_POST["disp"]) === true) {
    if(isset($_POST["agent_id"]) === false) {
        header("Location:agent_ng.php");
        exit();
    } 
    $agent_id = $_POST["agent_id"];
    header("Location:agent_disp.php?agent_id=".$agent_id);
    exit();
}

if(isset($_POST["edit"]) === true) {
    if(isset($_POST["agent_id"]) === false) {
        header("Location:agent_ng.php");
        exit();
    } 
    $agent_id = $_POST["agent_id"];
    //urlにつけちゃってgetで取ってくる
    header("Location:agent_edit.php?agent_id=".$agent_id);
    exit();
}

if(isset($_POST["delete"]) === true) {
    if(isset($_POST["agent_id"]) === false) {
        header("Location:agent_ng.php");
        exit();
    } 
    $agent_id = $_POST["agent_id"];
    header("Location:agent_delete.php?agent_id=".$agent_id);
    exit();
}
?>
