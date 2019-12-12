<?php
include_once '../include/_common.php';
if (empty($_SESSION['userpk'])) {
  fun_alertmsg ('尚未登入或閒置時間過長，請重新登入!!','index.php');
  exit;
}
if (!empty($_POST["sub_portfolio"]) && !empty($_POST["rpk"])) {
  $resume_pk = fun_testinput($_POST["rpk"]);
  $pro_title=fun_testinput($_POST['pro_title']);
  $pro_link=fun_testinput($_POST['pro_link']);
  $pro_content=fun_testinput($_POST['pro_content']);

  $pro_pk = "";
  if (!empty($_POST["pro_pk"])) {
    $pro_pk = $_POST["pro_pk"];
    $sql="select * from portfolio where user_pk ='". $_SESSION["userpk"] ."' and resume_pk = '". $resume_pk ."' and pk = '". $pro_pk ."'";
    $result=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    if ($result) {
      if (!empty($result["pic_name"])) {
        $pic_Have="1";
        $pic_show=fun_testinput($_POST['pic_show']);
      } 
    }  
  }

  $errmsg="";
  if (empty($pro_title)) {
    $errmsg .= "『作品名稱』請填寫！ \\n";
  } else {
     if (strlen($pro_title) > 200) {
      $errmsg .= "『作品名稱』格式錯誤！ \\n";
    }
  }
  if (!empty($pro_content)) {
    if (strlen($pro_content) > 500) {
     $errmsg .= "『簡單說明』格式錯誤！ \\n";
    }
  }
  if (!empty($pro_link)) {
    if (strlen($pro_link) > 300) {
     $errmsg .= "『網頁連結』格式錯誤！ \\n";
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

  if ($errmsg != "") {
    fun_alertmsg ('填寫錯誤！ \n'.$errmsg,'portfolio.php?rpk='.$resume_pk);
  } else {
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
        $imgPath = "../img/portfolio/". $_SESSION['userpk'] ."_" . $filename . "." . $filetype ;
        $imgPath_a = "../img/portfolio/". $_SESSION['userpk'] ."_" . $filename ."_a." . $filetype ;

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
    $editdata['pro_title']=$pro_title; 
    $editdata['pro_link']=$pro_link; 
    $editdata['pro_content']=$pro_content; 
    $editdata['user_pk']=$_SESSION['userpk']; 
    $editdata['resume_pk']=$resume_pk; 
    if ($uploadPic) {
      $editdata['pic_name']=$filename;
      $editdata['pic_type']=$filetype;
    }

    if (!empty($pro_pk)) {
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
      
      if (!empty($_POST["datashow"])) {
        $editdata['datashow']=1; 
      } else {
        $editdata['datashow']=0; 
      }
      $editdata['modify_time']=date("Y-m-d h:i:s"); 
    }else{
      $editdata['datashow']=1;  
      if ($uploadPic) {
        $editdata['pic_show']=1; 
      }  
    }
    // print_r($editdata);
    // exit();
    $result=fun_dbDataEdit('portfolio',$editdata,$pro_pk,"1");
    if ($result) {
      fun_alertmsg ('儲存成功！','portfolio.php?rpk='.$resume_pk);
      exit();
    }else{
      fun_alertmsg ('儲存失敗！'.$result,'portfolio.php?rpk='.$resume_pk);
      exit();
    }
  }
}
?>