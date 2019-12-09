<?php
include_once '../include/_common.php';
if (empty($_SESSION['userpk'])) {
  fun_alertmsg ('尚未登入或閒置時間過長，請重新登入!!','index.php');
  exit;
}
if (!empty($_POST["sub_experience"]) && !empty($_POST["rpk"])) {
  $resume_pk = fun_testinput($_POST["rpk"]);
  $com_name=fun_testinput($_POST['com_name']);
  $job_name=fun_testinput($_POST['job_name']);
  $job_datelist=fun_testinput($_POST['job_datelist']);
  $job_status=fun_testinput($_POST['job_status']);
  $job_content=fun_testinput($_POST['job_content']);

  $exp_pk = "";
  if (!empty($_POST["exp_pk"])) {
    $exp_pk = $_POST["exp_pk"];
  }

  $errmsg="";
  if (empty($com_name)) {
    $errmsg .= "『公司名稱』請填寫！ \\n";
  } else {
     if (strlen($com_name) > 30) {
      $errmsg .= "『公司名稱』格式錯誤！ \\n";
    }
  }
  if (empty($job_name)) {
    $errmsg .= "『職務名稱』請填寫！ \\n";
  } else {
     if (strlen($job_name) > 30) {
      $errmsg .= "『職務名稱』格式錯誤！ \\n";
    }
  }
  if (!empty($job_datelist)) {
     if (strlen($job_datelist) > 50) {
      $errmsg .= "『任職期間』格式錯誤！ \\n";
    }
  }
  if (!empty($job_content)) {
    if (strlen($job_content) > 2000) {
     $errmsg .= "『工作內容』格式錯誤！ \\n";
    }
  }
  if ($errmsg != "") {
    fun_alertmsg ('填寫錯誤！ \n'.$errmsg,'experience.php?rpk='.$resume_pk);
  } else {
    $editdata=[];
    $editdata['com_name']=$com_name; 
    $editdata['job_name']=$job_name; 
    $editdata['job_datelist']=$job_datelist; 
    $editdata['job_status']=$job_status; 
    $editdata['job_content']=$job_content; 
    $editdata['user_pk']=$_SESSION['userpk']; 
    $editdata['resume_pk']=$resume_pk; 

    if (!empty($exp_pk)) {
      if (!empty($_POST["datashow"])) {
        $editdata['datashow']=1; 
      } else {
        $editdata['datashow']=0; 
      }
      $editdata['modify_time']=date("Y-m-d h:i:s"); 
    }else{
      $editdata['datashow']=1;    
    }
    $result=fun_dbDataEdit('experience',$editdata,$exp_pk,"1");
    if ($result) {
      fun_alertmsg ('儲存成功！','experience.php?rpk='.$resume_pk);
      exit();
    }else{
      fun_alertmsg ('儲存失敗！'.$result,'experience.php?rpk='.$resume_pk);
      exit();
    }
  }
}
?>