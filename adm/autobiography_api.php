<?php
include_once '../include/_common.php';
if (empty($_SESSION['userpk'])) {
  fun_alertmsg ('尚未登入或閒置時間過長，請重新登入!!','index.php');
  exit;
}
if (!empty($_POST["sub_autobiography"]) ) {
  $resume_pk = $_POST["rpk"];
  if (!empty($resume_pk)) {
    $result=fun_findDB_autobiography($_SESSION['userpk'],$resume_pk);
    if ($result) {
      $a_pk=$result["pk"];     
    }
  }
  $datashow=$_POST['datashow'];
  $info=$_POST['info'];
  
  $errmsg="";
  if (!empty($datashow)) {
    if (empty($info)) {
      $errmsg .= "『自傳內容』請填寫！ \\n";
    } else {
       if (strlen($info) > 4000) {
        $errmsg .= "『自傳內容』格式錯誤！ \\n";
      }
    }
  }else{
    if (!empty($info)) {
      if (strlen($info) > 4000) {
       $errmsg .= "『自傳內容』格式錯誤！ \\n";
      }
    }  
  }

  if (empty($errmsg)) {
    $editdata=[];
    $editdata['info']=$info;
    if ($datashow) {
      $editdata['datashow']=1;
    }else{
      $editdata['datashow']=0;
    }
    $editdata['user_pk']=$_SESSION['userpk']; 
    if (!empty($a_pk)) {
      // 存入DB
      $editdata['modify_time']=date("Y-m-d h:i:s"); 
      $result=fun_updateDB('autobiography',$a_pk,$editdata);
      if ($result) {
        fun_alertmsg ('修改成功！ \n','autobiography.php?rpk='.$resume_pk);
        exit();
      }else{
        fun_alertmsg ('修改失敗！ \n','autobiography.php?rpk='.$resume_pk);
        exit();
      }
    } else {
      $editdata['resume_pk']=$resume_pk; 
      $result=fun_insertDB('autobiography',$editdata);
      if ($result) {
        fun_alertmsg ('新增成功！ \n','autobiography.php?rpk='.$resume_pk);
        exit();
      }else{
        fun_alertmsg ('新增失敗！ \n','autobiography.php?rpk='.$resume_pk);
        exit();
      }
    }
  } else {
    fun_alertmsg ('填寫錯誤！ \n'.$errmsg,'autobiography.php?rpk='.$resume_pk);
    exit();
  }
}
?>