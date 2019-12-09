<?php
include_once '../include/_common.php';
if (empty($_SESSION['userpk'])) {
  fun_alertmsg ('尚未登入或閒置時間過長，請重新登入!!','index.php');
  exit;
}
if (!empty($_POST["sub_resumeEdit"]) && !empty($_POST["upk"])) {
  $upk = fun_testinput($_POST["upk"]);
  $resume_name=fun_testinput($_POST['resume_name']);
  $resume_status=fun_testinput($_POST['resume_status']);
  if ($resume_status == 1) {
    $sql="select pk from resume where user_pk ='". $_SESSION['userpk'] ."' and resume_status=1";
    $result=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    if (!empty($result)) {
      fun_alertmsg ('請先關閉其他履歷才能開啟此筆！ \n','manage.php');
      exit();
    }
  }

  $editdata=[];
  $editdata['resume_name']=$resume_name; 
  $editdata['resume_status']=$resume_status;  
  $editdata['user_pk']=$_SESSION['userpk']; 
  $editdata['modify_time']=date("Y-m-d h:i:s"); 
  $result=fun_updateDB('resume',$upk,$editdata);
  if ($result) {
    fun_alertmsg ('修改成功！ \n','manage.php');
    exit();
  }else{
    fun_alertmsg ('修改失敗！ \n','manage.php');
    exit();
  }
}
?>