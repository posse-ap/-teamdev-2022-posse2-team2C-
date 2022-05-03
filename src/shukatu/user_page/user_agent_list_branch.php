<?php
session_start();


if(isset($_POST["1"]) === false) {
    // header("Location:boozer_staff_ng.php");
    // exit();
} 
$tag_1 = $_POST["1"];

//ボタンがないからpostでcodeを送信できない
//getを使って遷移先のurlに乗っける(staff codeだから見えても別に大丈夫)
header("Location:user_agent_list_tag.php");
exit();


?>
