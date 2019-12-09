
<?php 
include_once '../include/_common.php';
header("Cache-Control: no-cache, must-revalidate");
$_SESSION["vcode"]=fun_VerificationCodeID(5,"1");
fun_VerificationCodeImg($_SESSION["vcode"]);
?>