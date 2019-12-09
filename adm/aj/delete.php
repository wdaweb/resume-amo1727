<?php
include_once '../../include/_common.php';
if (empty($_SESSION['userpk'])) {
	fun_alertmsg ('尚未登入或閒置時間過長，請重新登入!!','index.php');
	exit;
}
//處理刪除資料的請求
$success="0";
if (!empty($_POST["tablen"]) && !empty($_POST["pk"])) {
    $result = fun_delDB($_POST["tablen"],$_POST["pk"]);
    if (!empty($result)) {
        $success="1";
    }
}
echo $success;
?>