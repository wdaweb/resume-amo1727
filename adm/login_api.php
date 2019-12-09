<?php
include_once '../include/_common.php';
if (!empty($_POST["sub_login"])) {
  $acc = fun_testinput($_POST["acc"]);
  $pw = fun_testinput($_POST["pw"]);
  $vcode = fun_testinput($_POST["vcode"]);

  if (empty($acc) || empty($pw) || empty($vcode)) {
      fun_alertmsg ('【帳號】【密碼】【驗證碼】不可空白！ \n','index.php');
      exit();
  } else {
    if ($vcode == $_SESSION["vcode"]) {
      $data=fun_loginDB($acc,$pw);
      if (!empty($data)) {
        $_SESSION['userpk'] = $data['pk'];
        $_SESSION['username'] = $data['name'];
        fun_alertmsg ('登入成功！ \n','manage.php');
        exit();
      } else {
        fun_alertmsg ('登入失敗，請重新填寫帳密！ \n','index.php');
        exit();
      }
      $conn = null;
    } else {
      fun_alertmsg ('驗證碼錯誤！ \n'.$_SESSION["vcode"],'index.php');
    } 
  }
}
?>