<?php
include_once '../include/_common.php';
if (empty($_SESSION['userpk'])) {
  fun_alertmsg ('尚未登入或閒置時間過長，請重新登入!!','index.php');
  exit;
}
if (!empty($_POST["sub_skills"]) && !empty($_POST["rpk"])) {
  $resume_pk = fun_testinput($_POST["rpk"]);
  $skill_title=fun_testinput($_POST['skill_title']);
  $skill_content=fun_testinput($_POST['skill_content']);

  $ski_pk = "";
  if (!empty($_POST["ski_pk"])) {
    $ski_pk = $_POST["ski_pk"];
  }

  $errmsg="";
  if (empty($skill_title)) {
    $errmsg .= "『標題』請填寫！ \\n";
  } else {
     if (strlen($skill_title) > 200) {
      $errmsg .= "『標題』格式錯誤！ \\n";
    }
  }
  if (!empty($skill_content)) {
    if (strlen($skill_content) > 1000) {
     $errmsg .= "『內容』格式錯誤！ \\n";
    }
  }
  if ($errmsg != "") {
    fun_alertmsg ('填寫錯誤！ \n'.$errmsg,'skills.php?rpk='.$resume_pk);
  } else {
    $editdata=[];
    $editdata['skill_title']=$skill_title; 
    $editdata['skill_content']=$skill_content; 
    $editdata['user_pk']=$_SESSION['userpk']; 
    $editdata['resume_pk']=$resume_pk; 

    if (!empty($ski_pk)) {
      if (!empty($_POST["datashow"])) {
        $editdata['datashow']=1; 
      } else {
        $editdata['datashow']=0; 
      }
      $editdata['modify_time']=date("Y-m-d h:i:s"); 
    }else{
      $editdata['datashow']=1;    
    }
    $result=fun_dbDataEdit('skills',$editdata,$ski_pk,"1");
    if ($result) {
      fun_alertmsg ('儲存成功！','skills.php?rpk='.$resume_pk);
      exit();
    }else{
      fun_alertmsg ('儲存失敗！'.$result,'skills.php?rpk='.$resume_pk);
      exit();
    }
  }
}
?>