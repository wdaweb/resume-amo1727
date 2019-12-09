<?php
include_once '../include/_common.php';
if (empty($_SESSION['userpk'])) {
  fun_alertmsg ('尚未登入或閒置時間過長，請重新登入!!','index.php');
  exit;
}
$pic_Have="";
if (!empty($_POST["sub_basedata"]) ) {
  $resume_pk = fun_testinput($_POST["rpk"]);
  if (!empty($resume_pk)) {
    $result=fun_findDB_basedata($_SESSION['userpk'],$resume_pk);
    if ($result) {
      $base_pk=$result["pk"];
      if (!empty($result["pic_name"])) {
        $pic_Have="1";
        $pic_show=fun_testinput($_POST['pic_show']);
      }
      
    }
  }
  $cname=fun_testinput($_POST['cname']);
  $ename=fun_testinput($_POST['ename']);
  $gender=fun_testinput($_POST['gender']);
  $marital=fun_testinput($_POST['marital']);
  $birthdayYear=fun_testinput($_POST['birthdayYear']);
  $birthdayMonth=fun_testinput($_POST['birthdayMonth']);
  $birthdayDate=fun_testinput($_POST['birthdayDate']);
  $email=fun_testinput($_POST['email']);
  $call_phone=fun_testinput($_POST['call_phone']);
  $call_time=fun_testinput($_POST['call_time']);
  $address=fun_testinput($_POST['address']);
  

  $errmsg="";
  if (empty($cname)) {
    $errmsg .= "『中文姓名』請填寫！ \\n";
  } else {
     if (strlen($cname) > 20) {
      $errmsg .= "『中文姓名』格式錯誤！ \\n";
    }
  }
  if (!empty($ename)) {
     if (strlen($ename) > 30) {
      $errmsg .= "『英文姓名』格式錯誤！ \\n";
    }
  }
  if (empty($gender)) {
    $errmsg .= "『性別』請選擇！ \\n";
  }
  if (empty($marital)) {
    $errmsg .= "『婚姻狀況』請選擇！ \\n";
  }
  if (empty($birthdayYear) || empty($birthdayMonth) || empty($birthdayDate) ) {
    $errmsg .= "『出生日期』請選擇！ \\n";
  } else {
     if (!checkdate($birthdayMonth, $birthdayDate, $birthdayYear)) {
      $errmsg .= "『出生日期』格式錯誤！ \\n";
    }
  }
  if (empty($email)) {
    $errmsg .= "『E-mail』請填寫！ \\n";
  } else {
    if (!fun_ChkEmail($email)) {
      $errmsg .= "『E-mail』格式錯誤！ \\n";
    }
  }
  if (!empty($call_phone)) {
    if (strlen($call_phone) > 20) {
     $errmsg .= "『聯絡電話』格式錯誤！ \\n";
    }
  }
  if (!empty($call_time)) {
    if (strlen($call_time) > 50) {
      $errmsg .= "『聯絡時間』格式錯誤！ \\n";
    }
  }
  if (!empty($address)) {
    if (strlen($address) > 250) {
      $errmsg .= "『通訊地址』格式錯誤！ \\n";
    }
  }

  if (empty($errmsg)) {
    if (!empty($_FILES) && $_FILES['picfile']['error']==0) {
      if ($_FILES['picfile']['size'] > 5120000) {
        $errmsg.="『個人照片』檔案大小請勿超過5MB！ \\n";
      }
      if ($_FILES['picfile']['type'] != "image/jpeg" && $_FILES['picfile']['type'] != "image/png") {
        $errmsg.="『個人照片』格式錯誤！ \\n";
      }
    }
  }

  if (empty($errmsg)) {
    
    $uploadPic=false;
    if (!empty($_FILES) && $_FILES['picfile']['error']==0) {
      if(!empty($_FILES['picfile']['tmp_name'])){
        $filename=md5(time());  //利用時間及md5編碼來產生一個檔名
        switch($_FILES['picfile']['type']){
            case "image/jpeg":
                $filetype="jpg";
            break;
            case "image/png":
                $filetype="png";
            break;
        }
  
        // 處理圖檔
        $imgPath = "../img/basedata/". $_SESSION['userpk'] ."_" . $filename . "." . $filetype ;
        $imgPath_a = "../img/basedata/". $_SESSION['userpk'] ."_" . $filename ."_a." . $filetype ;

        // echo $_FILES['picfile']['tmp_name'];
        // echo "<br>";
        // echo $imgPath;
        // exit();

        move_uploaded_file($_FILES['picfile']['tmp_name'] , $imgPath);
        fun_reSizeImg(500,90,$imgPath,$imgPath_a);
        $uploadPic=true;
      }
    }

    $editdata=[];
    $editdata['cname']=$cname;
    $editdata['ename']=$ename;
    $editdata['gender']=$gender;
    $editdata['marital']=$marital;
    $editdata['birthday']=$birthdayYear."-".$birthdayMonth."-".$birthdayDate;
    $editdata['email']=$email;
    $editdata['call_phone']=$call_phone;
    $editdata['call_time']=$call_time;
    $editdata['address']=$address; 
    if ($uploadPic) {
      $editdata['pic_name']=$filename;
      $editdata['pic_type']=$filetype;
    }
    $editdata['user_pk']=$_SESSION['userpk']; 
    if (!empty($base_pk)) {
      // 存入DB
      if ($pic_Have == "1") {
        if ($pic_show == "1") {
          $editdata['pic_show']=1; 
        } else {
          $editdata['pic_show']=0; 
        }
      }else{
        if ($uploadPic) {
          $editdata['pic_show']=1; 
        }
      }
      
      $editdata['modify_time']=date("Y-m-d h:i:s"); 
      $result=fun_updateDB('basedata',$base_pk,$editdata);
      if ($result) {
        fun_alertmsg ('修改成功！ \n','basedata.php?rpk='.$resume_pk);
        exit();
      }else{
        fun_alertmsg ('修改失敗！ \n','basedata.php?rpk='.$resume_pk);
        exit();
      }
    } else {
      $editdata['resume_pk']=$resume_pk; 
      if ($uploadPic) {
        $editdata['pic_show']=1; 
      }
      // print_r($editdata);
      // exit();
      $result=fun_insertDB('basedata',$editdata);
      if ($result) {
        fun_alertmsg ('新增成功！ \n','basedata.php?rpk='.$resume_pk);
        exit();
      }else{
        fun_alertmsg ('新增失敗！ \n','basedata.php?rpk='.$resume_pk);
        exit();
      }
    }
  } else {
    fun_alertmsg ('填寫錯誤！ \n'.$errmsg,'basedata.php?rpk='.$resume_pk);
    exit();
  }
}
?>