<?php
include_once '../include/_common.php';
if (empty($_SESSION['userpk'])) {
  fun_alertmsg ('尚未登入或閒置時間過長，請重新登入!!','index.php');
  exit;
}
if (!empty($_POST["sub_education"]) && !empty($_POST["rpk"])) {
  $resume_pk = fun_testinput($_POST["rpk"]);
  $school_name=fun_testinput($_POST['school_name']);
  $major_name=fun_testinput($_POST['major_name']);
  $study_datelist=fun_testinput($_POST['study_datelist']);
  $study_status=fun_testinput($_POST['study_status']);

  $edu_pk = "";
  if (!empty($_POST["edu_pk"])) {
    $edu_pk = $_POST["edu_pk"];
  }

  $errmsg="";
  if (empty($school_name)) {
    $errmsg .= "『學校』請填寫！ \\n";
  } else {
     if (strlen($school_name) > 30) {
      $errmsg .= "『學校』格式錯誤！ \\n";
    }
  }
  if (empty($major_name)) {
    $errmsg .= "『科系』請填寫！ \\n";
  } else {
     if (strlen($major_name) > 30) {
      $errmsg .= "『科系』格式錯誤！ \\n";
    }
  }
  if (!empty($study_datelist)) {
     if (strlen($study_datelist) > 50) {
      $errmsg .= "『期間』格式錯誤！ \\n";
    }
  }
  if (empty($study_status)) {
    $errmsg .= "『狀態』請選取！ \\n";
  }

  if ($errmsg != "") {
    fun_alertmsg ('填寫錯誤！ \n'.$errmsg,'experience.php?rpk='.$resume_pk);
  } else {
    $editdata=[];
    $editdata['school_name']=$school_name; 
    $editdata['major_name']=$major_name; 
    $editdata['study_datelist']=$study_datelist; 
    $editdata['study_status']=$study_status; 
    $editdata['user_pk']=$_SESSION['userpk']; 
    $editdata['resume_pk']=$resume_pk; 

    if (!empty($edu_pk)) {
      if (!empty($_POST["datashow"])) {
        $editdata['datashow']=1; 
      } else {
        $editdata['datashow']=0; 
      }
      $editdata['modify_time']=date("Y-m-d h:i:s"); 
    }else{
      $editdata['datashow']=1;    
    }
    $result=fun_dbDataEdit('education',$editdata,$edu_pk,"1");
    if ($result) {
      fun_alertmsg ('儲存成功！','experience.php?rpk='.$resume_pk);
      exit();
    }else{
      fun_alertmsg ('儲存失敗！','experience.php?rpk='.$resume_pk);
      exit();
    }
  } 
}
?>