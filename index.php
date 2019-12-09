<?php 
include_once './include/_common.php';
$user_pk=1;
$nodata=1;
$base_name="";
$base_contactPhone="";
$base_email="";
$base_picurl="";
$sql="SELECT * FROM `resume` where resume_status = '1' and user_pk ='". $user_pk ."'";
$row = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
if (!empty($row)) {
  $row1 = fun_findDB_basedata($row["user_pk"],$row["pk"]);
  if (!empty($row1)) {
    $nodata=0;
    $resume_pk=$row["pk"];
    if (!empty($row1["ename"])) {
      $base_name = $row1["cname"]."(". $row1["ename"] .")";
    } else {
      $base_name = $row1["cname"];
    }
    if (!empty($row1["call_phone"])) {
      if (!empty($row1["call_time"])) {
        $base_contactPhone = "<p>".$row1["call_phone"]."(". $row1["call_time"] .")</p>";
      } else {
        $base_contactPhone = "<p>".$row1["call_phone"]."</p>";
      }
    }
    $base_email="<p><a href='". $row1["email"] ."' target='_blank'>". $row1["email"] ."</a></p>";
    if ($row1["pic_name"] != "") {
      if ($row1["pic_show"] == 1) {
        $base_picurl .= './img/basedata/'.$user_pk.'_'.$row1["pic_name"].'_a.'.$row1["pic_type"];
      } else {
        $base_picurl .= './img/portrait.png';
      }
    }
  }
}

$base_info="";
$skill_str="";
$edu_str="";
$exp_str="";
$graphy_str="";
$job_str='';
$port_str='';
if ($nodata==0) {
  // 簡歷
  $row=fun_findDB_description($user_pk,$resume_pk);
  if (!empty($row)) {
    if ($row["datashow"]==1) {
      $base_info=nl2br($row["info"]);
    }
  }
  // 技能
  $sql="select * from skills where 	datashow=1 and user_pk ='". $user_pk ."' and resume_pk = '". $resume_pk ."' order by sort ";
  $rows=$pdo->query($sql)->fetchAll();
  $ski_ii = 0;
  foreach ($rows as $v) {
    $ski_ii++;
    $skill_str.="<div class='col-12 col-sm-4 item'>";
    $skill_str.="<hr>";
    $skill_str.="<h1>". $v["skill_title"] ."</h1>";
    $skill_str.=nl2br($v["skill_content"]);
    $skill_str.="</div>";
  }
  if (!empty($skill_str)) {
    $skill_str='<div class="row snippet-features-003">
    <div class="col-sm-12">
      <div class="row">
        <div class="col-sm-12">
          <h1><b style="color: rgb(27, 131, 223);">技能 Skills</b></h1>
        </div>
      </div>
      <div class="row" >'. $skill_str . '
      </div>
      </div>
      </div>';
  }
  // 學歷
  $sql="select * from education where datashow=1 and user_pk ='". $user_pk ."' and resume_pk = '". $resume_pk ."' order by sort ";
  $rows=$pdo->query($sql)->fetchAll();
  foreach ($rows as $v) {
    $edu_str.='<div class="row" title="">';
    $edu_str.='<div class="col-xs-2 col-sm-1 item-bullet"></div>';
    $edu_str.='<div class="col-xs-10 col-sm-11 item">';
    $edu_str.='<h3>';
    $edu_str.=$v["school_name"];
    $edu_str.=' '.$v["major_name"];
    if (!empty($v["study_datelist"])) {
      $edu_str.='<span style="font-size: 12px; color: rgb(136, 136, 136);">'.$v["study_datelist"].'</span>';
    }
    if ($v["study_status"] == '1') {
      $edu_str.='<span style="font-size: 12px; color: rgb(100, 136, 136);">(畢業)</span>';
    } else if($v["study_status"] == '2'){
      $edu_str.='<span style="font-size: 12px; color: rgb(100, 136, 136);">(肄業)</span>';
    } else if($v["study_status"] == '3'){
      $edu_str.='<span style="font-size: 12px; color: rgb(100, 136, 136);">(就學中)</span>';
    }
    $edu_str.='</h3>';
    $edu_str.="</div>";
    $edu_str.="</div>";
  }
  if (!empty($edu_str)) {
    $edu_str='<div class="row snippet-experiences-013">
    <div class="col-xs-12">
      <div class="row">
        <div class="col-xs-12">
          <h1 style="color: rgb(27, 131, 223);"><b>學歷&nbsp;Education</b></h1>
        </div>
      </div>'. $edu_str . '
      </div>
      </div>';
  }
  // 經歷
  $sql="select * from experience where datashow=1 and user_pk ='". $user_pk ."' and resume_pk = '". $resume_pk ."' order by sort ";
  $rows=$pdo->query($sql)->fetchAll();
  foreach ($rows as $v) {
    $exp_str.='<div class="row" >';
    $exp_str.='<div class="col-xs-2 col-sm-1 item-bullet"></div>';
    $exp_str.='<div class="col-xs-10 col-sm-11 item">';
    $exp_str.='<h3>';
    $exp_str.=$v["com_name"];
    $exp_str.=' '.$v["job_name"];
    if (!empty($v["job_datelist"])) {
      $exp_str.='<span style="font-size: 12px; color: rgb(136, 136, 136);">'.$v["job_datelist"].'</span>';
    }
    if ($v["job_status"] == '1') {
      $exp_str.='<span style="font-size: 12px; color: rgb(100, 136, 136);">(仍在職)</span>';
    }
    $exp_str.='</h3>';
    $exp_str.=nl2br($v["job_content"]);
    $exp_str.="</div>";
    $exp_str.="</div>";
  }
  if (!empty($exp_str)) {
    $exp_str='<div class="row snippet-experiences-013">
    <div class="col-xs-12">
      <div class="row">
        <div class="col-xs-12">
          <h1 style="color: rgb(27, 131, 223);"><b>重要經歷 Experience</b><br></h1>
        </div>
      </div>'. $exp_str . '
      </div>
      </div>';
  }

  //自傳
  $row=fun_findDB_autobiography($user_pk,$resume_pk);
  if (!empty($row)) {
    if ($row["datashow"]==1) {
      $graphy_str='<div class="row snippet-experiences-013">
      <div class="col-xs-12">
      <div class="row">
        <div class="col-xs-12">
          <h1 style="color: rgb(27, 131, 223);"><b>自傳1</b><br></h1>
        </div>
      </div>'. nl2br($row["info"]) . '
      </div>
      </div>';
    }
  }

  // 求職條件
  $row=fun_findDB_jobhunting($user_pk,$resume_pk);
  if (!empty($row)) {
    $job_str.="<h3>職務名稱：".$row["job_name"]."</h3>";
    if (!empty($row["job_desc"])) {
      $job_str.='<p>'.nl2br($row["job_desc"]).'</p>';
    }
    if (!empty($row["job_desc"])) {
      $job_str.='<p>工作地點：'.$row["work_area"].'</p>';
    }
    if (!empty($row["work_salary_kind"]) && $row["work_salary_kind"] != 0) {
      if ($row["work_salary_kind"] == 1) {
        $job_str.='<p>薪資待遇：面議</p>';
      } else if ($row["work_salary_kind"] == 2){
        $job_str.='<p>薪資待遇：依公司規定</p>';
      } else if ($row["work_salary_kind"] == 3){
        if (!empty($row["work_salary_s"]) && !empty($row["work_salary_e"])) {
          $job_str.='<p>薪資待遇：'. $row["work_salary_s"] .'~'. $row["work_salary_e"] .'</p>';
        } else if (!empty($row["work_salary_s"]) && empty($row["work_salary_e"])){
          $job_str.='<p>薪資待遇：'. $row["work_salary_s"] .'</p>';
        } else if (!empty($row["work_salary_s"]) && !empty($row["work_salary_e"])){
          $job_str.='<p>薪資待遇：'. $row["work_salary_e"] .'</p>';
        }
      } 
    }
    $job_str='<div class="row snippet-experiences-013">
    <div class="col-xs-12">
      <div class="row">
        <div class="col-xs-12">
          <h1 style="color: rgb(27, 131, 223);"><b>求職條件 Job conditions</b><br></h1>
        </div>
      </div>'. $job_str . '
      </div>
      </div>';
  }

  // 作品集
  $port_text='';
  $port_img='';
  $port_i=0;
  $sql="select * from portfolio where datashow=1 and user_pk ='". $user_pk ."' and resume_pk = '". $resume_pk ."' order by sort ";
  $rows=$pdo->query($sql)->fetchAll();
  foreach ($rows as $v) {
    $port_i++;
    if ($v["pic_show"] == 1) {
      $port_text='<div class="col-sm-8">';
      $port_img='<div class="col-sm-4"><img src="./img/portfolio/'. $user_pk .'_'. $v["pic_name"] .'_a.'.$v["pic_type"] .'"></div>';
    } else {
      $port_text='<div class="col-sm-12">';
    }
    $port_text.='<h1><b>'. $v["pro_title"] .'</b><br></h1>';
    if (!empty($v["pro_link"])) {
      $port_text.='<p><a href="'. $v["pro_link"] .'" target="_blank" style="color: rgb(255, 14, 14);"><i class="fas"></i>&nbsp;網頁連結</a></p>';
    }
    $port_text.=nl2br($v["pro_content"]);
    $port_text.='</div>';
    
    $port_str.='<div class="row">';
    if ($port_i % 2 == 1) {
      $port_str.= $port_text;
      $port_str.= $port_img;
    } else {
      $port_str.= $port_img;
      $port_str.= $port_text;  
    } 
    $port_str.='</div>';
  }
  if (!empty($port_str)) {
    $port_str='<div class="row snippet-features-001">
    <div class="col-sm-12" id="web">
      <div class="row">
        <div class="col-sm-12">
          <h1><b style="color: rgb(27, 131, 223);">作品集&nbsp;Portfolio</b><br></h1>
        </div>
      </div>
    </div>
  </div>'.$port_str;
  }
}
?>
<!DOCTYPE html>
<html data-country="TW" data-test-group="0" lang="zh-TW">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo $base_name;?> – 履歷表</title>
  <link rel="stylesheet" media="all" href="./files/main.css" data-turbolinks-track="true" preload="true">
  <link rel="stylesheet" href="./files/a.css">

</head>

<body class=" paper-style normal-spacing connected-with-posts no-live-chat" id="items-show">
  <div class="container-main container">
    <header class="header-item a4-width">
      <div class="row">
        <div class="col-xs-12 text-right header-toolbar"><a class="text-muted "
              href="./adm/">後台管理</a></div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <hr>
        </div>
      </div>
    </header>
    <?php 
    if ($nodata==0) {
    ?>
    <div class="item-page">
      <div class="contentarea normal" id="item" notranslate="">
        <div class="row snippet-profile-001">
          <div class="col-sm-2"><img data-no-retina="true" src="<?php echo $base_picurl; ?>"
              alt="大頭照" style="border-radius: 50%;" loading="auto"></div>
          <div class="col-sm-10">
            <h1><b><?php echo $base_name; ?></b></h1>
            <div class="info"><?php echo $base_info;?></div>
            <?php echo $base_contactPhone; ?>
            <?php echo $base_email; ?>
          </div>
        </div>
        <?php echo $job_str; ?>
        <?php echo $skill_str; ?>
        <?php echo $edu_str; ?>  
        <?php echo $exp_str; ?>
        <?php echo $graphy_str; ?>
        <?php echo $port_str; ?>
      </div>
    </div>
    <?php 
    } else {
    ?>
    <div class="item-page">
      <div class="contentarea normal" id="item" style="text-align:center;height:300px;">
        目前無履歷
      </div>
    </div>
    <?php 
    }
    ?>
  </div>
</body>
</html>