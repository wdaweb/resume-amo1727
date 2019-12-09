
<?php 
include_once '../include/_common.php';
$_SESSION["vcode"]=fun_VerificationCodeID(5);
fun_VerificationCodeImg($_SESSION["vcode"],"1");
?>