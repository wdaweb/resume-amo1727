<?php
include_once '../include/_common.php';
if (empty($_SESSION['userpk'])) {
  fun_alertmsg ('尚未登入或閒置時間過長，請重新登入!!','index.php');
  exit;
}
if (!empty($_POST["sub_resumeAdd"])) {
  $resume_name=fun_testinput($_POST['resume_name']);

  $adddata=[];
  $adddata['resume_name']=$resume_name; 
  $adddata['resume_status']='0';  
  $adddata['user_pk']=$_SESSION['userpk']; 
  $result=fun_insertDB('resume',$adddata);
  if ($result) {
    fun_alertmsg ('新增成功！ \n','manage.php');
    exit();
  }else{
    fun_alertmsg ('新增失敗！ \n','manage.php');
    exit();
  }
}
?>