<?php
include_once '../include/_common.php';
if (empty($_SESSION['userpk'])) {
  fun_alertmsg ('尚未登入或閒置時間過長，請重新登入!!','index.php');
  exit;
}
$pic_Have="";
if (!empty($_POST["sub_jobhunting"]) ) {
  $resume_pk = fun_testinput($_POST["rpk"]);
  if (!empty($resume_pk)) {
    $result=fun_findDB_jobhunting($_SESSION['userpk'],$resume_pk);
    if ($result) {
      $job_pk=$result["pk"];     
    }
  }
  $job_name=fun_testinput($_POST['job_name']);
  $job_desc=fun_testinput($_POST['job_desc']);
  $work_area=fun_testinput($_POST['work_area']);
  $work_salary_kind=fun_testinput($_POST['work_salary_kind']);
  $work_salary_s=fun_testinput($_POST['work_salary_s']);
  $work_salary_e=fun_testinput($_POST['work_salary_e']); 

  $errmsg="";
  if (empty($job_name)) {
    $errmsg .= "『希望職務名稱』請填寫！ \\n";
  } else {
     if (strlen($job_name) > 50) {
      $errmsg .= "『希望職務名稱』格式錯誤！ \\n";
    }
  }
  if (!empty($job_desc)) {
     if (strlen($job_desc) > 300) {
      $errmsg .= "『職務內容描述』格式錯誤！ \\n";
    }
  }
  if (!empty($work_area)) {
    if (strlen($work_area) > 300) {
     $errmsg .= "『希望工作地點』格式錯誤！ \\n";
   }
 }
  if ($work_salary_kind == 3) {
    if (empty($work_salary_s) && empty($work_salary_e) ) {
      $errmsg .= "『希望薪資待遇』薪資請填寫！ \\n";
    }
  }
 
  if (empty($errmsg)) {
    $editdata=[];
    $editdata['job_name']=$job_name;
    $editdata['job_desc']=$job_desc;
    $editdata['work_area']=$work_area;
    $editdata['work_salary_kind']=$work_salary_kind;
    if ($work_salary_kind == 3) {
      $editdata['work_salary_s']=$work_salary_s;
      $editdata['work_salary_e']=$work_salary_e;
    }
    $editdata['user_pk']=$_SESSION['userpk']; 
    if (!empty($job_pk)) {     
      $editdata['modify_time']=date("Y-m-d h:i:s"); 
      $result=fun_updateDB('jobhunting',$job_pk,$editdata);
      if ($result) {
        fun_alertmsg ('修改成功！ \n','jobhunting.php?rpk='.$resume_pk);
        exit();
      }else{
        fun_alertmsg ('修改失敗！ \n','jobhunting.php?rpk='.$resume_pk);
        exit();
      }
    } else {
      $editdata['resume_pk']=$resume_pk; 
      $result=fun_insertDB('jobhunting',$editdata);
      if ($result) {
        fun_alertmsg ('新增成功！ \n','jobhunting.php?rpk='.$resume_pk);
        exit();
      }else{
        fun_alertmsg ('新增失敗！ \n','jobhunting.php?rpk='.$resume_pk);
        exit();
      }
    }
  } else {
    fun_alertmsg ('填寫錯誤！ \n'.$errmsg,'jobhunting.php?rpk='.$resume_pk);
    exit();
  }
}
?>